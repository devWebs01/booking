<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use App\Models\Product;
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
        $priceProduct = $this->faker->randomFloat(2, 100, 1000);
        $priceDriver = $withDriver ? $this->faker->randomFloat(2, 50, 200) : 0;
        $penalty = $this->faker->randomFloat(2, 0, 100);
        $total = ($priceProduct * $duration) + ($priceDriver * $duration) + $penalty;

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'rent_date' => $rentDate,
            'duration' => $duration,
            'penalty' => $penalty,
            'with_driver' => $withDriver,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement([
                'MENUNGGU_KONFIRMASI',
                'DIKONFIRMASI',
                'DALAM_PENGGUNAAN',
                'SELESAI',
                'BATAL',
                'TERLAMBAT',
            ]),
            'price_product' => $priceProduct,
            'price_driver' => $priceDriver,
            'total' => $total,
        ];
    }
}
