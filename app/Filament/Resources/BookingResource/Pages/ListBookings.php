<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use App\Filament\Resources\BookingResource\Widgets\BookingRevenuesPerMonthChart;
use App\Filament\Resources\BookingResource\Widgets\BookingsPerMonthChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            BookingsPerMonthChart::class,
            BookingRevenuesPerMonthChart::class
        ];
    }
}
