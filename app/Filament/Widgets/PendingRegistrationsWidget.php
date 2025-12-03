<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class PendingRegistrationsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Cache dashboard statistics for 5 minutes
        $pendingCount = Cache::remember('dashboard.pending_registrations', 300, function () {
            return Registration::pending()->count();
        });

        return [
            Stat::make('Pending Registrations', $pendingCount)
                ->description('Registrations awaiting approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }

    protected static ?int $sort = 1;
}
