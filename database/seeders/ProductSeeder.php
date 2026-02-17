<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

            // many-to-many categories
            $product->categories()->attach(
                $categories->random(rand(1,3))->pluck('id')
            );

            // vendor_products pivot with extra fields
            foreach ($vendors->random(rand(1,2)) as $vendor) {
                $product->vendors()->attach($vendor->id, [
                    'price' => rand(10,300),
                    
                ]);
            }
        });
    }
}
