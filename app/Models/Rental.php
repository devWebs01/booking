<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rental extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'thumbnail',
        'url_maps',
        'phone_number',
        'address',
        'latitude',
        'longitude',
        'user_id',
        'description',
    ];

    /**
     * Get the user that owns the Rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the categories for the Rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Get all of the cars for the Rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
