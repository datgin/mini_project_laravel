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
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->numberBetween(100, 1000),
            'discount' => $this->faker->randomFloat(1, 0.1, 0.9),
            'quantity' => $this->faker->numberBetween(100, 1000),
            'description' => $this->faker->text(),
            'category_id' =>  $this->faker->numberBetween(1, 10),
            'status' => $this->faker->boolean(),
        ];
    }
}
