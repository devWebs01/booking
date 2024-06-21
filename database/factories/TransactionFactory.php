<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rentDate = Carbon::now()->subDays(rand(0, 30));
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'car_id' => Car::inRandomOrder()->first()->id,
            'rent_date' => $rentDate,
            'duration' => $this->faker->numberBetween(1, 14),
            'penalty' => $this->faker->randomFloat(2, 0, 100),
            'with_driver' => $this->faker->boolean,
            'description' => $this->faker->sentence,
        ];
    }
}
