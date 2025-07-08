<?php

namespace App\Filament\Resources\FavoriteHotelResource\Widgets;

use App\Models\FavoriteHotel;
use App\Models\Hotel;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FavoriteHotelStatsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = '2';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Favorites', FavoriteHotel::count())
                ->icon('heroicon-s-heart'),
            Stat::make('Favorite Hotels Count', Hotel::whereHas('favorites')->count())
                ->icon('heroicon-s-heart')
        ];
    }
}
