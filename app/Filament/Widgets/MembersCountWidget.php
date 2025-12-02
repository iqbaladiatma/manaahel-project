<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MembersCountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $membersCount = User::members()->count();

        return [
            Stat::make('Registered Members', $membersCount)
                ->description('Total members in the system')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }

    protected static ?int $sort = 3;
}
