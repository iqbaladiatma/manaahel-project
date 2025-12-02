<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PendingRegistrationsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $pendingCount = Registration::pending()->count();

        return [
            Stat::make('Pending Registrations', $pendingCount)
                ->description('Registrations awaiting approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }

    protected static ?int $sort = 1;
}
