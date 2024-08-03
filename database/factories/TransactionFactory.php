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

        $duration = $this->faker->numberBetween(1, 14);
        $priceProduct = $this->faker->randomFloat(2, 100, 1000);
        $total = ($priceProduct * $duration);

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'duration' => $duration,
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

            'total' => $total,
        ];
    }
}
