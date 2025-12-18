<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DebugController extends Controller
{
    public function gallery()
    {
        $data = [
            'galleries' => Gallery::orderBy('created_at', 'desc')->take(10)->get(),
            'total_galleries' => Gallery::count(),
            'admin_count' => User::where('role', 'admin')->count(),
            'current_user' => Auth::user(),
            'is_admin' => Auth::check() && Auth::user()->isAdmin(),
        ];
        
        return view('debug.gallery', $data);
    }
    
    public function testCloudinary(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        try {
            $gallery = Gallery::create([
                'title' => 'Test Cloudinary - ' . now()->format('H:i:s'),
                'description' => 'Test otomatis dari debug controller',
                'file_path' => 'https://res.cloudinary.com/demo/image/upload/sample.jpg',
                'file_type' => 'image',
                'visibility' => 'public',
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Gallery item berhasil dibuat!',
                'id' => $gallery->id,
                'redirect' => route('gallery.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
