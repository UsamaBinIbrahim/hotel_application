<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index() {
        $hotels = Hotel::select('id', 'name', 'location', 'price_per_night', 'main_image')
            ->withCount('bookings')
            ->orderByDesc('bookings_count')
            ->take(3)
            ->get();
        return view('homepage.index', compact('hotels'));
    }
}
