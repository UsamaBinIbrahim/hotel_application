<?php

namespace App\Filament\Resources\FavoriteHotelResource\Pages;

use App\Filament\Resources\FavoriteHotelResource;
use App\Filament\Resources\FavoriteHotelResource\Widgets\FavoriteHotelStatsWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFavoriteHotels extends ListRecords
{
    protected static string $resource = FavoriteHotelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            FavoriteHotelStatsWidget::class
        ];
    }
}
