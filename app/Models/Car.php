<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    ];

    /**
     * Get all of the carImages for the Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carImages(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp. ' . number_format($this->price, 0, ',', '.');
    }
    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->description, 60, '...');
    }
}
