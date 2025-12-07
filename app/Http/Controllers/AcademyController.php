<?php

namespace App\Http\Controllers;

use App\Models\AcademyProgram;
use App\Models\AcademyRegistration;
use Illuminate\Http\Request;

class AcademyController extends Controller
{
    public function index()
    {
        $programs = AcademyProgram::active()
            ->orderBy('start_date', 'desc')
            ->get();

        return view('academy.index', compact('programs'));
    }

    public function show($slug)
    {
        $program = AcademyProgram::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Check if user already registered
        $alreadyRegistered = false;
        if (auth()->check()) {
            $alreadyRegistered = AcademyRegistration::where('academy_program_id', $program->id)
                ->where('user_id', auth()->id())
                ->exists();
        }

        return view('academy.show', compact('program', 'alreadyRegistered'));
    }

    public function register(Request $request, $slug)
    {
        // Require authentication
        if (!auth()->check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk mendaftar program Academy.');
        }

        $program = AcademyProgram::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $user = auth()->user();

        // Check if profile is complete
        if (!$user->hasCompleteProfileForAcademy()) {
            return redirect()
                ->route('profile.edit')
                ->with('error', 'Silakan lengkapi profil Anda terlebih dahulu (Nama, Email, dan No. WhatsApp) untuk mendaftar program Academy.');
        }

        // Check if already registered
        $existingRegistration = AcademyRegistration::where('academy_program_id', $program->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingRegistration) {
            return redirect()
                ->route('academy.success', ['registration' => $existingRegistration->id])
                ->with('info', 'Anda sudah terdaftar di program ini.');
        }

        // Create registration using user data
        $registration = AcademyRegistration::create([
            'academy_program_id' => $program->id,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'notes' => $request->input('notes'),
            'status' => 'approved',
            'whatsapp_group_link' => $program->whatsapp_group_link,
        ]);

        return redirect()
            ->route('academy.success', ['registration' => $registration->id])
            ->with('success', 'Pendaftaran berhasil!');
    }

    public function success($registrationId)
    {
        $registration = AcademyRegistration::with('academyProgram')->findOrFail($registrationId);

        return view('academy.success', compact('registration'));
    }
}
