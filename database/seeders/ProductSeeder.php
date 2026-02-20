<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::factory(10)->create();
        $vendors = Vendor::factory(5)->create();

        Product::factory(50)->create()->each(function ($product) use ($categories, $vendors) {
            // تعيين تصنيف واحد عشوائي
            $product->category_id = $categories->random()->id;
            $product->save();

            // إرفاق البائعين (يبقى كما هو)
            foreach ($vendors->random(rand(1,2)) as $vendor) {
                $product->vendors()->attach($vendor->id, [
                    'price' => rand(10,300),
                ]);
            }
        });
    }
}
