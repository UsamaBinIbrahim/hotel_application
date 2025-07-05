<?php

namespace App\Http\Controllers;

use App\Models\Hotel;

class FavoriteHotelController extends Controller
{
    public function toggle(Hotel $hotel) {
        $user = auth()->user();
        if($user->favoriteHotels()->where('hotel_id', $hotel->id)->exists()) {
            $user->favoriteHotels()->detach($hotel->id);
            $class = 'unfav-btn';
            $data_lucide = 'heart-off';
        } else {
            $user->favoriteHotels()->attach($hotel->id);
            $class = 'fav-btn';
            $data_lucide = 'heart';
        }
        return response()->json(['class' => $class, 'data_lucide' => $data_lucide]);
    }

    public function check(Hotel $hotel) {
        return response()->json([
            'is_favorite' => auth()->user()->favoriteHotels()->where('hotel_id', $hotel->id)->exists()
        ]);
    }

    public function index() {
        $user = auth()->user();
        $favorite_hotels = $user->favoriteHotels()
                                ->select('hotels.id', 'hotels.name', 'hotels.location', 'hotels.main_image')
                                ->get();
        return view('profile.favorites.index', ['favorite_hotels' => $favorite_hotels]);
    }

    public function destroy(Hotel $hotel) {
        $user = auth()->user();
        if(!$user->favoriteHotels()->where('hotel_id', $hotel->id)->exists()) {
            return response()->json(['message' => 'hotel isn\'t favorited']);
        }
        $user->favoriteHotels()->detach($hotel->id);
        return response()->json([
            'message' => 'removed from favorites',
            'favorites_left' => $user->favoriteHotels()->count()
        ]);
    }
}
