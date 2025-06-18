<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

        self::deleted(function ($hotel) {
            if(is_array($hotel->images)) {
                foreach($hotel->images as $imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            if($hotel->main_image) {
                Storage::disk('public')->delete($hotel->main_image);
            }
        });
    }

    public function amenities() {
        return $this->belongsToMany(Amenity::class, 'amenity_hotel');
    }

    public function booking() {
        return $this->hasMany(Booking::class);
    }
}
