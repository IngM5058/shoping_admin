<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\OrderResource\Widgets\OrderOverview;
use App\Filament\Resources\OrderResource\Widgets\CategorySaleChart;
use App\Filament\Resources\OrderResource\Widgets\TopProductsChart;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderOverview::class,
            CategorySaleChart::class,
            TopProductsChart::class,
        ];
    }
}
