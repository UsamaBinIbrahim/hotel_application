<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FavoriteHotelResource\Pages;
use App\Models\FavoriteHotel;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FavoriteHotelResource extends Resource
{
    protected static ?string $model = FavoriteHotel::class;

    protected static ?string $navigationGroup = 'User';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

        protected static ?string $activeNavigationIcon = 'heroicon-s-heart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('hotel.name')
                    ->label('Hotel')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Favorite At')
                    ->date('Y-m-d')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ])->recordUrl(null);;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFavoriteHotels::route('/'),
        ];
    }
}
