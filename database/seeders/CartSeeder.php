<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {

            $cart = Cart::create([
                'user_id' => $user->id,
                'status' => 'active'
            ]);

            $products = Product::inRandomOrder()->take(rand(1,4))->get();

            foreach ($products as $product) {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'vendor_id' => $product->vendors()->first()->id ?? 1,
                    'quantity' => rand(1,3),
                ]);
            }
        });
    }
}

