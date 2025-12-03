<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    /**
     * Show the registration form for a specific program.
     */
    public function create(Request $request): View
    {
        // Ensure user is authenticated
        if (!auth()->check()) {
            abort(403, 'You must be logged in to register for a program.');
        }

        $programId = $request->query('program');
        $program = Program::findOrFail($programId);

        // Check if program is active
        if (!$program->status) {
            abort(403, 'Registration for this program is closed.');
        }

        return view('registrations.create', compact('program'));
    }

    /**
     * Store a new registration with payment proof.
     */
    public function store(Request $request): RedirectResponse
    {
        // Ensure user is authenticated
        if (!auth()->check()) {
            abort(403, 'You must be logged in to register for a program.');
        }

        // Validate the request
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'payment_proof' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp',
                'max:2048', // 2MB max
                new \App\Rules\SecureImageUpload(),
            ],
        ]);

        // Get the program and check if it's active
        $program = Program::findOrFail($validated['program_id']);
        if (!$program->status) {
            return back()->withErrors(['program_id' => 'Registration for this program is closed.']);
        }

        // Handle file upload with sanitization
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            
            // Sanitize filename: remove special characters and spaces
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $sanitizedName = preg_replace('/[^A-Za-z0-9\-_]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
            $sanitizedName = substr($sanitizedName, 0, 50); // Limit length
            $filename = $sanitizedName . '_' . time() . '.' . $extension;
            
            // Store with sanitized filename
            $paymentProofPath = $file->storeAs('payment-proofs', $filename, 'private');
        }

        // Create the registration with pending status
        $registration = Registration::create([
            'user_id' => auth()->id(),
            'program_id' => $validated['program_id'],
            'payment_proof' => $paymentProofPath,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Your registration has been submitted successfully. Please wait for admin approval.');
    }
}
