<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory(30)->create()->each(function ($order) {

            $products = Product::inRandomOrder()->take(rand(1,5))->get();

            foreach ($products as $product) {
                $order->orderItems()->create([
                    'product_id' => $product->id,
                    'vendor_id' => $product->vendors()->first()->id ?? 1,
                    'quantity' => rand(1,4),
                    'price_at_time' => $product->price,
                ]);
            }
        });
    }
}

