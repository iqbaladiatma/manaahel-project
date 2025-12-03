<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Program;
use App\Models\Registration;
use App\Models\User;
use App\Observers\ArticleObserver;
use App\Observers\CategoryObserver;
use App\Observers\ProgramObserver;
use App\Observers\RegistrationObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register model observers for cache invalidation
        Article::observe(ArticleObserver::class);
        Category::observe(CategoryObserver::class);
        Program::observe(ProgramObserver::class);
        Registration::observe(RegistrationObserver::class);
        User::observe(UserObserver::class);
    }
}
