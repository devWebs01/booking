<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'capacity',
        'space',
        'category_id',
        'transmission',
        'status'
    ];

    public function getFormattedPriceAttribute()
    {
        return 'Rp. ' . number_format($this->price, 0, ',', '.');
    }
    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->description, 60, '...');
    }

    /**
     * Get all of the carImages for the Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carImages(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }

    /**
     * Get the category that owns the Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the transactions for the Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
