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
        'max_guests',
        'base_guest_count',
        'extra_adult_fee',
        'extra_child_fee',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function amenities() {
        return $this->belongsToMany(Amenity::class, 'amenity_hotel');
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function bookedRooms() {
        return $this->hasMany(BookedRoom::class);
    }

    public function favoritedBy() {
        return $this->belognsToMany(User::class, 'favorite_hotels')->withTimestamps();
    }

    public function favorites() {
        return $this->hasMany(FavoriteHotel::class);
    }

    protected static function booted(): void {
        static::updating(function ($hotel) {
            self::updateImages($hotel);
            self::updateMainImage($hotel);
        });

        static::deleted(function ($hotel) {
            self::deleteImages($hotel);
            self::deleteMainImage($hotel);
        });
    }

    private static function updateImages($hotel) {
        $originalImages = $hotel->getOriginal('images') ?? [];
        $originalImages = is_array($originalImages) ? $originalImages : json_decode($originalImages, true); // getOriginal() might return a json
        $currentImages = $hotel->images ?? [];
        $removedImages = array_diff($originalImages, $currentImages);

        foreach ($removedImages as $imagePath) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    private static function updateMainImage($hotel) {
        $originalMain = $hotel->getOriginal('main_image') ?: null;
        $currentMain = $hotel->main_image ?: null;

        if ($originalMain && $originalMain !== $currentMain) {
            Storage::disk('public')->delete($originalMain);
        }
    }

    private static function deleteImages($hotel) {
        if(is_array($hotel->images)) {
            foreach($hotel->images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    }

    private static function deleteMainImage($hotel) {
        if($hotel->main_image) {
            Storage::disk('public')->delete($hotel->main_image);
        }
    }
}
