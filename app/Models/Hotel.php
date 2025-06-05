<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'location',
        'description',
        'main_image',
        'images',
        'price_per_night',
        'total_rooms',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    protected static function booted(): void {
        static::creating(function ($hotel) {
            $hotel->available_rooms = $hotel->total_rooms;
        });
    }

    public function amenities() {
        return $this->belongsToMany(Amenity::class);
    }

    public function booking() {
        return $this->hasMany(Booking::class);
    }
}
