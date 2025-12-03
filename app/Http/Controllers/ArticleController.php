<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        
        // Cache categories for 1 hour
        $categories = Cache::remember('categories.all', 3600, function () {
            return Category::all();
        });

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Display the specified article in the selected language.
     * Cache article content for 1 hour.
     */
    public function show(Article $article)
    {
        // Cache the article with its category for 1 hour
        $cachedArticle = Cache::remember("article.{$article->id}", 3600, function () use ($article) {
            return $article->load('category');
        });

        return view('articles.show', ['article' => $cachedArticle]);
    }
}
