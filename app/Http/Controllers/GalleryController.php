<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display galleries visible to the current user.
     * Paginate gallery items for better performance.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        
        // Get galleries visible to the current user with pagination
        $galleries = Gallery::visibleForUser($user)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('gallery.index', [
            'galleries' => $galleries,
        ]);
    }
}
