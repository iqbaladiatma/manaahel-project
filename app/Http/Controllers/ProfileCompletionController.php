<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileCompletionController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        
        // Check which fields are missing
        $missingFields = [];
        if (empty($user->name)) $missingFields[] = 'name';
        if (empty($user->email)) $missingFields[] = 'email';
        if (empty($user->phone)) $missingFields[] = 'phone';

        // Get the intended URL (where they were trying to go)
        $intendedUrl = session('url.intended', route('academy.index'));

        return view('profile.complete', compact('user', 'missingFields', 'intendedUrl'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
        ]);

        $user->update($validated);

        return redirect()
            ->intended(route('academy.index'))
            ->with('success', 'Profil berhasil dilengkapi! Silakan lanjutkan pendaftaran.');
    }
}
