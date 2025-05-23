<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/hotels', function () {
    $hotels = [
        [
            'name' => "Sunrise Resort",
            'location' => "Beirut",
            'price' => 120,
            'image' => "hotel.h"
        ],
        [
            'name' => "Mountain Inn",
            'location' => "Ehden",
            'price' => 90,
            'image' => "hotel.h"
        ],
        [
            'name' => "Sunrise Resort",
            'location' => "Beirut",
            'price' => 120,
            'image' => "hotel.h"
        ],
        [
            'name' => "Mountain Inn",
            'location' => "Ehden",
            'price' => 90,
            'image' => "hotel.h"
        ],
        [
            'name' => "Sunrise Resort",
            'location' => "Beirut",
            'price' => 120,
            'image' => "hotel.h"
        ],
        [
            'name' => "Mountain Inn",
            'location' => "Ehden",
            'price' => 90,
            'image' => "hotel.h"
        ],
        [
            'name' => "Sunrise Resort",
            'location' => "Beirut",
            'price' => 120,
            'image' => "hotel.h"
        ],
        [
            'name' => "Mountain Inn",
            'location' => "Ehden",
            'price' => 90,
            'image' => "hotel.h"
        ],
        [
            'name' => "Sunrise Resort",
            'location' => "Beirut",
            'price' => 120,
            'image' => "hotel.h"
        ],
        [
            'name' => "Mountain Inn",
            'location' => "Ehden",
            'price' => 90,
            'image' => "hotel.h"
        ],
    ];
    
    return view('hotels', ['hotels' => $hotels]);
})->name('hotels.index');

Route::get('/hotel_details', function () {
    $hotel_info = [
        'name' => 'Sunrise Resort',
        'location' => 'Beirut, Lebanon',
        'price' => 120,
        'image' => 'hotel.h',
        'amenities' => [
          'Free Wi-Fi',
          'Outdoor Pool',
          'Restaurant & Bar',
          '24/7 Reception',
          'Spa Services',
        ],
        'description' => 'Sunrise Resort offers a luxury stay with world-class amenities and breathtaking views. Whether you are here for business or leisure, we provide everything to make your stay comfortable and memorable.',
    ];

    return view('hotel_details', ['hotel' => $hotel_info]);
})->name('hotels.show');
