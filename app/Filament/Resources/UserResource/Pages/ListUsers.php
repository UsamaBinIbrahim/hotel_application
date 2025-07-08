<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Widgets\UsersPerMonthChart;
use App\Filament\Resources\UserResource\Widgets\UsersStatsWidget;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            UsersStatsWidget::class
        ];
    }   

    protected function getFooterWidgets(): array
    {
        return [
            UsersPerMonthChart::class
        ];
    }
}
