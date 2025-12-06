<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryUploadController extends Controller
{
    /**
     * Show the form for creating a new gallery item (Member Angkatan only).
     */
    public function create()
    {
        // Check if user is member_angkatan
        if (!Auth::user()->isMemberAngkatan()) {
            abort(403, 'Only Member Angkatan can upload to gallery.');
        }

        return view('gallery.create');
    }

    /**
     * Store a newly created gallery item (Member Angkatan only).
     */
    public function store(Request $request)
    {
        // Check if user is member_angkatan
        if (!Auth::user()->isMemberAngkatan()) {
            abort(403, 'Only Member Angkatan can upload to gallery.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'event_date' => 'nullable|date',
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('gallery', 'public');

        // Create gallery entry
        $gallery = Gallery::create([
            'user_id' => Auth::id(),
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
