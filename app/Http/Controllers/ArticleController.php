<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles with optional category filter.
     */
    public function index(Request $request)
    {
        $query = Article::with('category');

        // Apply category filter if present
        if ($request->has('category') && $request->category) {
            $query->byCategory($request->category);
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(12);
        
        // Get all categories for the filter dropdown
        $categories = Category::all();

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Display the specified article in the selected language.
     */
    public function show(Article $article)
    {
        // Load the category relationship
        $article->load('category');

        return view('articles.show', compact('article'));
    }
}
