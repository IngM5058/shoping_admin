<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 orders
        for ($i = 0; $i < 10; $i++) {
            $order = Order::create([
                'status' => 'pending',
                'total_price' => 0, // We'll update this later
            ]);

            // Add 1-5 products to each order
            $numberOfProducts = rand(1, 5);
            $totalPrice = 0;

            for ($j = 0; $j < $numberOfProducts; $j++) {
                $product = Product::inRandomOrder()->first();
                $quantity = rand(1, 5);
                $price = $product->price;

                $order->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                $totalPrice += $price * $quantity;
            }

            // Update the total price of the order
            $order->update(['total_price' => $totalPrice]);
        }
    }
}
