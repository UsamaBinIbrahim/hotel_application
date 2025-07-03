<?php

namespace App\Http\Controllers;

use App\Models\Hotel;

class HotelController extends Controller
{
    public function homepage() {
        $hotels = Hotel::select('id', 'name', 'location', 'price_per_night', 'main_image')->take(3)->get();
        
        return view('homepage', ['hotels' => $hotels]);
    }

    public function index() {
        $hotels = Hotel::select('id', 'name', 'location', 'price_per_night')->get();

        return view('hotels.index', ['hotels' => $hotels]);
    }

    public function show(Hotel $hotel) {
        return view('hotels.show', ['hotel' => $hotel]);
    }
}
