<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'rental_id'
    ];

    /**
     * Get the rental that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class);
    }

    /**
     * Get all of the cars for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
