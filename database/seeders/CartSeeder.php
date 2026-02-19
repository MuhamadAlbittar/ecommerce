<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\VendorProduct;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        User::take(5)->get()->each(function ($user) {

            $cart = Cart::create([
                'user_id' => $user->id,
                'status'  => 'active',
            ]);

            $products = Product::inRandomOrder()->take(rand(1, 4))->get();

            foreach ($products as $product) {

                // جيب أول بائع عنده هاد المنتج
                $vendorProduct = VendorProduct::where('product_id', $product->id)->first();

                // لو ما في بائع للمنتج، تخطاه
                if (!$vendorProduct) {
                    continue;
                }

                $cart->cartItems()->create([
                    'product_id'    => $product->id,
                    'vendor_id'     => $vendorProduct->vendor_id,
                    'quantity'      => rand(1, 3),
                    'price_at_time' => $vendorProduct->price,
                ]);
            }
        });
    }
}
