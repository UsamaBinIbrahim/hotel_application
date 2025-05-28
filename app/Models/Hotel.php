<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'location',
        'description',
        'image',
        'price_per_night',
        'total_rooms',
        'available_rooms',
    ];
}
