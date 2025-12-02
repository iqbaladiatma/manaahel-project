<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PublishedArticlesWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $publishedCount = Article::count();

        return [
            Stat::make('Published Articles', $publishedCount)
                ->description('Total articles in the system')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
        ];
    }

    protected static ?int $sort = 2;
}
