<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function index() {
        $user = auth()->user();
        $favorite_hotels = $user->favoriteHotels()
                                ->select('hotels.id', 'hotels.name', 'hotels.location', 'hotels.main_image')
                                ->get();
        return view('profile.favorites.index', ['favorite_hotels' => $favorite_hotels]);
    }

    public function destroy(Hotel $hotel) {
        auth()->user()->favoriteHotels()->detach($hotel->id);
        return back();
    }
}
