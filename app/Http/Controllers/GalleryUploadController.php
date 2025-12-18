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
            'category' => 'nullable|string|max:100',
            'folder' => 'nullable|string|max:100',
            'media' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov,wmv,flv,webm,mkv|max:51200', // 50MB max for videos
            'member_id' => 'nullable|exists:users,id', // For admin to assign to member
        ]);

        // Determine user_id: if admin assigns to member, use member_id, otherwise use current user
        $userId = Auth::user()->isAdmin() && $request->filled('member_id') 
            ? $validated['member_id'] 
            : Auth::id();

        // Get user's batch year for batch_filter
        $user = $userId ? \App\Models\User::find($userId) : null;
        $batchFilter = $user && $user->batch_year ? $user->batch_year : null;

        // Get uploaded file
        $file = $request->file('media');
        
        // Determine file type
        $mimeType = $file->getMimeType();
        $fileType = str_starts_with($mimeType, 'video/') ? 'video' : 'image';
        
        // Generate unique filename
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filename = $originalName . '_' . time() . '_' . uniqid() . '.' . $extension;
        
        // Store file locally as backup
        $localPath = $file->storeAs('gallery', $filename, 'public');

        // Create gallery entry - file_path akan diisi manual dengan URL Cloudinary
        $gallery = Gallery::create([
            'user_id' => $userId,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'folder' => $validated['folder'],
            'file_path' => $localPath, // Sementara pakai local, nanti bisa diganti manual
            'cloudinary_public_id' => null,
            'file_type' => $fileType,
            'batch_filter' => $batchFilter,
            'visibility' => 'public',
        ]);

        $mediaType = $fileType === 'video' ? 'Video' : 'Foto';
        return redirect()->route('gallery.index')
            ->with('success', $mediaType . ' berhasil diupload! Media akan muncul di galeri.');
    }
}
