<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\ImageProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'capacity',
        'space',
        'category_id',
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
     * Get all of the imageProduct for the product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imageProducts(): HasMany
    {
        return $this->hasMany(imageProduct::class);
    }

    /**
     * Get the category that owns the product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the transactions for the product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
