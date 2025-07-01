<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HotelController::class, 'homepage'])->name('homepage');
Route::get('/hotels/index', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}/show', [HotelController::class, 'show'])->name('hotels.show');

Route::middleware('auth')->group(function() {
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/hotels/{hotel}/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/hotels/{hotel}/booking/store', [BookingController::class, 'store'])->name('booking.store');
});
