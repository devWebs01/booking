<?php

namespace Database\Factories;

use App\Models\Rental;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rental_id' => Rental::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'image' => $this->faker->imageUrl(640, 480, 'cars', true, 'rental'),
            'description' => $this->faker->paragraph,
        ];
    }
}
