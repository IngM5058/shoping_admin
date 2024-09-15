<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order = new Order();
        $order->status = 'pending';
        $order->total_price = 0;
        $order->save();

        $totalPrice = 0;
        foreach ($request->products as $item) {
            $product = Product::findOrFail($item['id']);
            $order->products()->attach($product->id, [
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
            $totalPrice += $product->price * $item['quantity'];
        }

        $order->total_price = $totalPrice;
        $order->save();

        return response()->json($order->load('products'), 201);
    }

    public function index()
    {
        $orders = Order::with('products')->get();
        return response()->json($orders);
    }
}
