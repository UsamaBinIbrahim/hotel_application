<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::matched(function () {
            // Block the login page if secret is missing or incorrect
            if (request()->is('admin/login') && request('secret') !== config('admin.secret')) {
                abort(403, 'Forbidden');
            }
        });

        Filament::serving(function () {
        if (request()->routeIs('filament.auth.login') && request('secret') !== config('admin.secret')) {
            abort(403, 'Forbidden');
        }

            Auth::shouldUse('admin');
        });
    }
}
