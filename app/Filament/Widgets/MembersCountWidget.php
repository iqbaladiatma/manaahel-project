<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class MembersCountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Cache dashboard statistics for 5 minutes
        $membersCount = Cache::remember('dashboard.members_count', 300, function () {
            return User::members()->count();
        });

        return [
            Stat::make('Registered Members', $membersCount)
                ->description('Total members in the system')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }

    protected static ?int $sort = 3;
}
