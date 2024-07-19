<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $table = 'shops';
    protected $fillable = [
        'name',
        'thumbnail',
        'url_maps',
        'phone_number',
        'address',
        'latitude',
        'longitude',
    ];
}
