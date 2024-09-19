<?php

namespace Database\Factories\Master;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master\Product>
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
            'categorie_id' => \App\Models\Master\Categorie::factory(),
            'name' => 'product - ' . rand(),
            'description' => fake()->paragraph(6),
            'price' => rand(5000, 20000),
            'image_thumb' => fake()->url(),
            'qtys' => rand(5, 20)
        ];
    }
}
