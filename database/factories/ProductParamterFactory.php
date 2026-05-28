<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductParameterFactory extends Factory
{

    public function definition(): array
    {
        return [
          'product_id' => Product::factory(),
          'name' => fake()->randomElement(['rozmer', 'farba', 'material']),
          'value' => fake()->word(),
        ];
    }
}
