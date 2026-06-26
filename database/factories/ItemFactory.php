<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(1000, 50000),
            // Hubungkan otomatis dengan Factory Category yang sudah dibuat sebelumnya
            'category_id' => Category::factory(), 
        ];
    }
}