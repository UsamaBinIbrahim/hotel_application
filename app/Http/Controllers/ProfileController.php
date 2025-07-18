<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
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
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|max:255|email|string|unique:users,email,' . $user->id
        ]);
        
        $user->fill($validated);

        if($user->isDirty()) {
            $updater->update($user, $validated);
            return response()->json([
                'status' => 'success'
            ]);
        }

        return response()->json([
            'status' => 'no changes'
        ]);
    }

    public function editPassword() {
        return view('profile.password');
    }

    public function destroy() {
        $user = auth()->user();
        auth()->logout();
        $user->delete();
        $account_delete = 'success';

        if($user->exists) {
            return back()->with('account_delete', 'fail');
        }

        return to_route('homepage.index')->with(compact('account_delete'));

    }
}
