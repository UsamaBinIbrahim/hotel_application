<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HotelController::class, 'homepage'])->name('homepage');
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}/show', [HotelController::class, 'show'])->name('hotels.show');

Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    
    Route::get('/hotels/{hotel}/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/hotels/{hotel}/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index'); // BookingController
    Route::get('/bookings/show', fn () => view('bookings.show'))->name('bookings.show'); // BookingController
});
