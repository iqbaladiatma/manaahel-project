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

        // Get all active programs for the dropdown
        $programs = Program::where('status', true)
            ->orderBy('name->en')
            ->get();

        // If a specific program is requested, validate it
        $selectedProgramId = $request->query('program');
        if ($selectedProgramId) {
            $selectedProgram = Program::find($selectedProgramId);
            if (!$selectedProgram || !$selectedProgram->status) {
                return redirect()->route('registrations.create')
                    ->with('error', 'The selected program is not available for registration.');
            }
        }

        // Get IDs of programs the user is already enrolled in
        $enrolledProgramIds = Registration::where('user_id', auth()->id())
            ->pluck('program_id')
            ->toArray();

        return view('registrations.create', compact('programs', 'enrolledProgramIds'));
    }

    /**
     * Store a new registration.
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
            'notes' => 'nullable|string|max:1000',
        ]);

        // Get the program and check if it's active
        $program = Program::findOrFail($validated['program_id']);
        if (!$program->status) {
            return back()->withErrors(['program_id' => 'Registration for this program is closed.']);
        }

        // Check if user already registered for this program
        $existingRegistration = Registration::where('user_id', auth()->id())
            ->where('program_id', $validated['program_id'])
            ->first();

        if ($existingRegistration) {
            return back()->withErrors(['program_id' => 'You have already registered for this program.']);
        }

        // Create the registration with approved status (no payment proof needed)
        $registration = Registration::create([
            'user_id' => auth()->id(),
            'program_id' => $validated['program_id'],
            'payment_proof' => null,
            'notes' => $validated['notes'] ?? null,
            'status' => 'approved', // Auto-approve since no payment needed
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Ahlan Wa Sahlan! Antum Berhasil Terdaftar di Program: ' . $program->name);
    }
}
