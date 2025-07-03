<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class FavoriteHotelController extends Controller
{
    public function toggle(Hotel $hotel) {
        $user = auth()->user();
        if($user->favoriteHotels()->where('hotel_id', $hotel->id)->exists()) {
            $user->favoriteHotels()->detach($hotel->id);
            return back();
        } else {
            $user->favoriteHotels()->attach($hotel->id);
            return back();
        }
    }

    public function index() {
        $user = auth()->user();
        return view('profile.favorites.index');
    }
}
