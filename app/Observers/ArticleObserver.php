<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
        Cache::forget('dashboard.published_articles');
        Cache::forget('home.featured_articles');
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
        Cache::forget("article.{$article->id}");
        Cache::forget('dashboard.published_articles');
        Cache::forget('home.featured_articles');
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        Cache::forget("article.{$article->id}");
        Cache::forget('dashboard.published_articles');
        Cache::forget('home.featured_articles');
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
        Cache::forget("article.{$article->id}");
        Cache::forget('dashboard.published_articles');
        Cache::forget('home.featured_articles');
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $article): void
    {
        Cache::forget("article.{$article->id}");
        Cache::forget('dashboard.published_articles');
        Cache::forget('home.featured_articles');
    }
}
