<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'name' => $this->faker->words(3, true),
                'brand' => $this->faker->slug(),
                'description' => $this->faker->paragraph(),
                'attributes' => [
                    'color' => $this->faker->safeColorName(),
                    'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
                ],
                'images' => [
                    $this->faker->imageUrl(640, 480, 'products', true),
                    $this->faker->imageUrl(640, 480, 'products', true),
                ],  

        ];
    }
}
