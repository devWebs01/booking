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
        $duration = $this->faker->numberBetween(1, 14);
        $withDriver = $this->faker->boolean;
        $priceCar = $this->faker->randomFloat(2, 100, 1000);
        $priceDriver = $withDriver ? $this->faker->randomFloat(2, 50, 200) : 0;
        $penalty = $this->faker->randomFloat(2, 0, 100);
        $total = ($priceCar * $duration) + ($priceDriver * $duration) + $penalty;

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'car_id' => Car::inRandomOrder()->first()->id,
            'rent_date' => $rentDate,
            'duration' => $duration,
            'penalty' => $penalty,
            'with_driver' => $withDriver,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['DIPESAN', 'DIGUNAKAN', 'SELESAI', 'TERLAMBAT', 'BATAL']),
            'price_car' => $priceCar,
            'price_driver' => $priceDriver,
            'total' => $total,
        ];
    }
}
