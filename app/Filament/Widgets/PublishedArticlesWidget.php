<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class PublishedArticlesWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Cache dashboard statistics for 5 minutes
        $publishedCount = Cache::remember('dashboard.published_articles', 300, function () {
            return Article::count();
        });

        return [
            Stat::make('Published Articles', $publishedCount)
                ->description('Total articles in the system')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
        ];
    }

    protected static ?int $sort = 2;
}
