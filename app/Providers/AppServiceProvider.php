<?php

namespace App\Providers;

use App\Http\Responses\AuthRedirectResponse;
use App\Http\Responses\LoginRedirectResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Http\Responses\LoginResponse as CustomLoginResponse;
use App\Http\Responses\RegisterResponse as CustomRegisterResponse;
use App\Http\Responses\LogoutResponse;
use App\Http\Responses\RegisterRedirectResponse;
use Laravel\Fortify\Contracts\LogoutResponse as FortifyLogoutResponse;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as FilamentLogoutResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FilamentLogoutResponse::class, LogoutResponse::class);
        $this->app->singleton(FortifyLogoutResponse::class, LogoutResponse::class);

        $this->app->when(CustomLoginResponse::class)
            ->needs(AuthRedirectResponse::class)
            ->give(LoginRedirectResponse::class);
            
        $this->app->when(CustomRegisterResponse::class)
            ->needs(AuthRedirectResponse::class)
            ->give(RegisterRedirectResponse::class);
        

        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
        $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();
    }
}
