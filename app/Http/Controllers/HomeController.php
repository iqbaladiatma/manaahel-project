<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Program;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page with featured programs and articles.
     * Cache featured content for 30 minutes.
     */
    public function index(): View
    {
        // Cache featured programs for 30 minutes
        $featuredPrograms = Cache::remember('home.featured_programs', 1800, function () {
            return Program::where('status', true)
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get();
        });

        // Cache featured articles for 1 hour
        $featuredArticles = Cache::remember('home.featured_articles', 3600, function () {
            return Article::with('category')
                ->where('is_featured', true)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        });

        // Get statistics
        $totalMembers = Cache::remember('stats.total_members', 3600, function () {
            return User::where('role', 'member')->count();
        });

        $totalPrograms = Cache::remember('stats.total_programs', 3600, function () {
            return Program::where('status', true)->count();
        });

        $totalCities = Cache::remember('stats.total_cities', 3600, function () {
            return User::whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->distinct('latitude', 'longitude')
                ->count();
        });

        // Get top achievers (members with most registrations)
        $topAchievers = Cache::remember('home.top_achievers', 3600, function () {
            return User::where('role', 'member')
                ->withCount('registrations')
                ->having('registrations_count', '>', 0)
                ->orderBy('registrations_count', 'desc')
                ->take(6)
                ->get();
        });

        return view('welcome', compact(
            'featuredPrograms',
            'featuredArticles',
            'totalMembers',
            'totalPrograms',
            'totalCities',
            'topAchievers'
        ));
    }
}
