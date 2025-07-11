<?php

namespace App\Providers\Filament;

use App\Filament\Resources\BookingResource\Widgets\BookingRevenuesPerMonthChart;
use App\Filament\Resources\BookingResource\Widgets\BookingsPerMonthChart;
use App\Filament\Resources\FavoriteHotelResource\Widgets\FavoriteHotelStatsWidget;
use App\Filament\Resources\UserResource\Widgets\UsersPerMonthChart;
use App\Filament\Resources\UserResource\Widgets\UsersStatsWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\LegacyComponents\Widget;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path(config('filament.path'))
            ->authGuard('admin')
            ->login()
            ->brandName('Admin Panel')
            ->colors([
                'primary' => Color::Indigo,
                'gray' => Color::Slate,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                UsersStatsWidget::class,
                UsersPerMonthChart::class,
                FavoriteHotelStatsWidget::class,
                BookingsPerMonthChart::class,
                BookingRevenuesPerMonthChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                // AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                // ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                // DisableBladeIconComponents::class,
                // DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
