<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
public function definition(): array
{
    return [
        'name'        => $this->faker->words(3, true),
        'description' => $this->faker->paragraph(),
        'price'       => $this->faker->randomFloat(2, 10, 500),
        'sale_price'  => $this->faker->optional()->randomFloat(2, 5, 400),
        'sku'         => strtoupper($this->faker->unique()->bothify('SKU-####')),
        'status'      => $this->faker->randomElement(['Active', 'Inactive']),
        'tags'        => $this->faker->words(3, true),
        'category_id' => \App\Models\Category::factory(), // أو null
    ];
}
}
