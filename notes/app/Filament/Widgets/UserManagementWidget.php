<?php

namespace App\Filament\Widgets;

use App\Models\Roles;
use App\Models\Stocks;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserManagementWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::count())
                ->color('success')
                ->description('Number of active users.'),
            Stat::make('User Roles', Roles::count())
                ->color('primary')
                ->description('Number of roles (admin, staff, etc.)'),
            Stat::make('Total Stocks',
                    Stocks::count()." items."
                )
                ->color('warning')
                ->description('In warehouse.')
        ];
    }
}
