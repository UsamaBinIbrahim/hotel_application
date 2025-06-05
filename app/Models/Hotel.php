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
    ];

    protected static function booted(): void {
        static::creating(function ($hotel) {
            $hotel->available_rooms = $hotel->total_rooms;
        });
    }

}
