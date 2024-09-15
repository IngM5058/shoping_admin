<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TopProductsChart extends ChartWidget
{
    protected static ?string $heading = 'Top 10 Products';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $topProducts = Product::select('products.name', DB::raw('SUM(order_product.quantity) as total_quantity'))
            ->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Quantity Sold',
                    'data' => $topProducts->pluck('total_quantity')->toArray(),
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                        '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
                    ],
                ],
            ],
            'labels' => $topProducts->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
