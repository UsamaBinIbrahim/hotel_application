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
        $amenities = [
            'Free Wi-Fi',
            'Outdoor Pool',
            'Restaurant & Bar',
            '24/7 Reception',
            'Spa Services',
        ];
        // $hotel = [
        //     'name' => 'Sunrise Resort',
        //     'location' => 'Beirut, Lebanon',
        //     'price' => 120,
        //     'image' => 'hotel.h',
        //     'amenities' => [
        //     'Free Wi-Fi',
        //     'Outdoor Pool',
        //     'Restaurant & Bar',
        //     '24/7 Reception',
        //     'Spa Services',
        //     ],
        //     'description' => 'Sunrise Resort offers a luxury stay with world-class amenities and breathtaking views. Whether you are here for business or leisure, we provide everything to make your stay comfortable and memorable.',
        // ];

        return view('hotels.show', ['hotel' => $hotel, 'amenities' => $amenities]);
    }
}
