<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Faker\Factory as Faker;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Latest gadgets and electronic devices',
                'products' => [
                    ['name' => 'Smartphone X', 'description' => 'Latest flagship smartphone', 'price' => 999.99, 'stock' => 100],
                    ['name' => 'Laptop Pro', 'description' => 'High-performance laptop', 'price' => 1499.99, 'stock' => 50],
                    ['name' => 'Wireless Earbuds', 'description' => 'True wireless earbuds with noise cancellation', 'price' => 199.99, 'stock' => 200],
                    ['name' => 'Smart Watch', 'description' => 'Fitness tracker and smartwatch', 'price' => 249.99, 'stock' => 75],
                    ['name' => 'Tablet Ultra', 'description' => 'Lightweight and powerful tablet', 'price' => 599.99, 'stock' => 60],
                ],
            ],
            [
                'name' => 'Home & Kitchen',
                'description' => 'Essential appliances and kitchenware',
                'products' => [
                    ['name' => 'Smart Refrigerator', 'description' => 'Wi-Fi enabled refrigerator with touchscreen', 'price' => 2499.99, 'stock' => 30],
                    ['name' => 'Robot Vacuum Cleaner', 'description' => 'Autonomous vacuum with mapping technology', 'price' => 399.99, 'stock' => 80],
                    ['name' => 'Air Fryer Deluxe', 'description' => 'Large capacity air fryer for healthy cooking', 'price' => 129.99, 'stock' => 150],
                    ['name' => 'Coffee Maker Pro', 'description' => 'Programmable coffee maker with built-in grinder', 'price' => 199.99, 'stock' => 100],
                    ['name' => 'Smart Thermostat', 'description' => 'Energy-saving smart thermostat', 'price' => 179.99, 'stock' => 120],
                ],
            ],
            [
                'name' => 'Fashion',
                'description' => 'Trendy clothing and accessories',
                'products' => [
                    ['name' => 'Designer Sunglasses', 'description' => 'Luxury sunglasses with UV protection', 'price' => 199.99, 'stock' => 50],
                    ['name' => 'Leather Wallet', 'description' => 'Genuine leather wallet with RFID protection', 'price' => 79.99, 'stock' => 200],
                    ['name' => 'Running Shoes', 'description' => 'Lightweight running shoes with cushioned soles', 'price' => 129.99, 'stock' => 150],
                    ['name' => 'Denim Jacket', 'description' => 'Classic denim jacket for all seasons', 'price' => 89.99, 'stock' => 100],
                    ['name' => 'Crossbody Bag', 'description' => 'Stylish and functional crossbody bag', 'price' => 59.99, 'stock' => 80],
                ],
            ],
            [
                'name' => 'Sports & Outdoors',
                'description' => 'Equipment for sports and outdoor activities',
                'products' => [
                    ['name' => 'Mountain Bike', 'description' => 'All-terrain mountain bike with 21 speeds', 'price' => 799.99, 'stock' => 40],
                    ['name' => 'Yoga Mat', 'description' => 'Non-slip yoga mat with carrying strap', 'price' => 29.99, 'stock' => 200],
                    ['name' => 'Camping Tent', 'description' => '4-person waterproof camping tent', 'price' => 149.99, 'stock' => 60],
                    ['name' => 'Fitness Tracker', 'description' => 'Water-resistant fitness tracker with heart rate monitor', 'price' => 79.99, 'stock' => 150],
                    ['name' => 'Tennis Racket', 'description' => 'Professional-grade tennis racket', 'price' => 119.99, 'stock' => 80],
                ],
            ],
            [
                'name' => 'Books',
                'description' => 'Bestselling books across various genres',
                'products' => [
                    ['name' => 'The Great Gatsby', 'description' => 'Classic novel by F. Scott Fitzgerald', 'price' => 12.99, 'stock' => 200],
                    ['name' => 'To Kill a Mockingbird', 'description' => 'Pulitzer Prize-winning novel by Harper Lee', 'price' => 14.99, 'stock' => 180],
                    ['name' => '1984', 'description' => 'Dystopian novel by George Orwell', 'price' => 11.99, 'stock' => 150],
                    ['name' => 'The Catcher in the Rye', 'description' => 'Coming-of-age novel by J.D. Salinger', 'price' => 13.99, 'stock' => 120],
                    ['name' => 'Pride and Prejudice', 'description' => 'Romantic novel by Jane Austen', 'price' => 10.99, 'stock' => 160],
                ],
            ],
        ];  

        foreach ($categories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['name'],
                'description' => $categoryData['description'],
            ]);

            foreach ($categoryData['products'] as $productData) {
                $product = new Product($productData);
                $product->image_url = $faker->imageUrl(640, 480, 'products', true);
                $category->products()->save($product);
            }
        }
    }
}
