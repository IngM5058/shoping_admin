<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Orders', Order::count()),
            Stat::make('Total Revenue', Order::sum('total_price')),
            Stat::make('Average Order Value', number_format(Order::avg('total_price'), 2)),
            Stat::make('รายการทั้งหมด', Order::count())
                ->description('รายการทั้งหมดในระบบ')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
        ];
    }
}
