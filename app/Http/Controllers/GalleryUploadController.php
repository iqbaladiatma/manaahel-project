<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryUploadController extends Controller
{
    /**
     * Show the form for creating a new gallery item (Member Angkatan & Admin).
     */
    public function create()
    {
        // Check if user is member_angkatan or admin
        if (!Auth::user()->isMemberAngkatan() && !Auth::user()->isAdmin()) {
            abort(403, 'Only Member Angkatan and Admin can upload to gallery.');
        }

        return view('gallery.create');
    }

    /**
     * Store a newly created gallery item (Member Angkatan & Admin).
     */
    public function store(Request $request)
    {
        // Check if user is member_angkatan or admin
        if (!Auth::user()->isMemberAngkatan() && !Auth::user()->isAdmin()) {
            abort(403, 'Only Member Angkatan and Admin can upload to gallery.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'event_date' => 'nullable|date',
            'member_id' => 'nullable|exists:users,id', // For admin to assign to member
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('gallery', 'public');

        // Determine user_id: if admin assigns to member, use member_id, otherwise use current user
        $userId = Auth::user()->isAdmin() && $request->filled('member_id') 
            ? $validated['member_id'] 
            : Auth::id();

        // Create gallery entry
        $gallery = Gallery::create([
            'user_id' => $userId,
            'title' => [
                'en' => $validated['title'],
                'id' => $validated['title'],
                'ar' => $validated['title'],
            ],
            'description' => $validated['description'],
            'type' => 'image',
            'media_url' => Storage::url($imagePath),
            'event_date' => $validated['event_date'] ?? now(),
            'is_featured' => false,
        ]);

        return redirect()->route('gallery.index')
            ->with('success', 'Photo uploaded successfully! It will appear in the gallery.');
    }
}
