<?php

namespace App\Providers;

use App\Http\Responses\AuthRedirectResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Http\Responses\LoginResponse as CustomLoginResponse;
use App\Http\Responses\RegisterResponse as CustomRegisterResponse;
use App\Http\Responses\LogoutResponse;
use Laravel\Fortify\Contracts\LogoutResponse as FortifyLogoutResponse;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as FilamentLogoutResponse;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FilamentLogoutResponse::class, LogoutResponse::class);
        
        $this->app->singleton(FortifyLogoutResponse::class, LogoutResponse::class);
        $this->app->singleton(AuthRedirectResponse::class, fn () => new AuthRedirectResponse());
        $this->app->singleton(LoginResponse::class, fn ($app) => new CustomLoginResponse($app->make(AuthRedirectResponse::class)));
        $this->app->singleton(RegisterResponse::class, fn ($app) => new CustomRegisterResponse($app->make(AuthRedirectResponse::class)));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::matched(function () {
            // Block the login page if secret is missing or incorrect
            if (request()->is(Filament::getPanel('admin')->getPath() . '/login') && request('secret') !== config('admin.secret')) {
                abort(403, 'Forbidden');
            }
        });

        Filament::serving(function () {
            if (request()->is(Filament::getPanel('admin')->getPath() . '/login') && request('secret') !== config('admin.secret')) {
                abort(403, 'Forbidden');
            }

            Auth::shouldUse('admin');
        });
    }
}
