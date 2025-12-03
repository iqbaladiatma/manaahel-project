<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Program;
use Illuminate\Support\Facades\Cache;
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
                ->take(3)
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

        return view('welcome', compact('featuredPrograms', 'featuredArticles'));
    }
}
