<?php

namespace App\Filament\Resources\FavoriteHotelResource\Pages;

use App\Filament\Resources\FavoriteHotelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFavoriteHotel extends EditRecord
{
    protected static string $resource = FavoriteHotelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
