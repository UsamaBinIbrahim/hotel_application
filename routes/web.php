<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FavoriteHotelController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('homepage.index');

Route::prefix('/hotels')->group(function() {
    Route::get('/', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('/filter', [HotelController::class, 'filter'])->name('hotels.filter');
    Route::get('/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
});

Route::middleware('auth')->group(function() {
    
    Route::prefix('/profile')->group(function() {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::prefix('/favorites')->group(function() {
        Route::post('/{hotel}', [FavoriteHotelController::class, 'toggle'])->name('favorites.toggle');
        Route::get('/{hotel}', [FavoriteHotelController::class, 'check'])->name('favorites.check');
        Route::get('/', [FavoriteHotelController::class, 'index'])->name('favorites.index');
        Route::delete('/{hotel}', [FavoriteHotelController::class, 'destroy'])->name('favorites.destroy');
    });
    
    // booking routes tied to hotel
    Route::prefix('/hotels')->group(function() {
        Route::get('/{hotel}/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/{hotel}/bookings', [BookingController::class, 'store'])->name('bookings.store');
    });
    // booking management standalone
    Route::prefix('/bookings')->group(function() {
        Route::get('/', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('/{booking}', [BookingController::class, 'show'])->name('bookings.show');
        Route::delete('/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });
});
