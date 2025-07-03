<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FavoriteHotelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HotelController::class, 'homepage'])->name('homepage');
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::post('/favorties/{hotel}', [FavoriteHotelController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteHotelController::class, 'index'])->name('favorites.index');
    Route::delete('/favorites/{hotel}', [FavoriteHotelController::class, 'destroy'])->name('favorites.destroy');
    
    // booking routes tied to hotel
    Route::get('/hotels/{hotel}/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/hotels/{hotel}/bookings', [BookingController::class, 'store'])->name('bookings.store');
    // booking management standalone
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});
