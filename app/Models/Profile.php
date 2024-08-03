<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
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
    ];
}
