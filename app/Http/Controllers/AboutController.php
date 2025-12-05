<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Display the about page with organization structure.
     */
    public function index(): View
    {
        // Get organization leaders (you can customize this based on your needs)
        $leaders = Cache::remember('about.leaders', 3600, function () {
            return User::where('role', 'admin')
                ->orWhere('role', 'leader')
                ->orderBy('created_at', 'asc')
                ->get();
        });

        return view('about', compact('leaders'));
    }
}
