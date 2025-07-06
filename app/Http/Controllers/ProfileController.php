<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Hotel;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request) {
        $booking_removed = $request->booking_removed;
        $user = auth()->user();
        $recent_favorite_hotels = $user->favoriteHotels()
            ->withPivot('created_at')
            ->select('hotels.id', 'hotels.name', 'hotels.location', 'hotels.price_per_night', 'hotels.main_image')
            ->orderByDesc('pivot_created_at')
            ->take(3)
            ->get();
        return view('profile.index', compact('recent_favorite_hotels', 'booking_removed'));
    }

    public function edit() {
        $user = auth()->user();
        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request, UpdateUserProfileInformation $updater) {
        $updater->update(auth()->user(), $request->only('name', 'email'));
        return response()->json([
            'status' => 'success'
        ]);
    }
}
