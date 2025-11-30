<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display galleries visible to the current user.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        
        // Get galleries visible to the current user
        $galleries = Gallery::visibleForUser($user)->get();
        
        return view('gallery.index', [
            'galleries' => $galleries,
        ]);
    }
}
