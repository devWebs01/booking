<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dating>
 */
class DatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transaction = Transaction::inRandomOrder()->first();
        $dateOfTransaction = $transaction->rent_date;
        $status = $transaction->status;

        return [
            'transaction_id' => $transaction->id,
            'dateOfTransaction' => $dateOfTransaction,
            'status' => $status,
        ];
    }
}
