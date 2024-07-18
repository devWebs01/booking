<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'car_id',
        'rent_date',
        'return_date',
        'duration',
        'penalty',
        'with_driver',
        'description',
        'status',
        'price_car',
        'price_driver',
        'total',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function car(): BelongsTo
    {
        return $this->belongsTo(car::class);
    }
    public function formatRupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
