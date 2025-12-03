<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Authorize that user can only update own profile
        if ($user->id !== $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validated();

        // Handle avatar upload with sanitization
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            
            // Sanitize filename: remove special characters and spaces
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $sanitizedName = preg_replace('/[^A-Za-z0-9\-_]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
            $sanitizedName = substr($sanitizedName, 0, 50); // Limit length
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $extension;
            
            // Store with sanitized filename
            $avatarPath = $file->storeAs('avatars', $filename, 'public');
            $validated['avatar_url'] = $avatarPath;
        }

        // Remove avatar from validated data as we've already handled it
        unset($validated['avatar']);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
