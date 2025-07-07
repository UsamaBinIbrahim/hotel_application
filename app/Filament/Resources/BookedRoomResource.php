<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookedRoomResource\Pages;
use App\Filament\Resources\BookedRoomResource\RelationManagers;
use App\Models\BookedRoom;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookedRoomResource extends Resource
{
    protected static ?string $model = BookedRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $modelLabel = 'Rooms Booked Per Day';

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
                TextColumn::make('hotel.name')
                    ->searchable()
                    ->toggleable()
                    ->label('Hotel'),
                TextColumn::make('date')
                    ->date('Y-m-d')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('rooms_booked')
                    ->sortable()
                    ->toggleable() 
            ])
            ->filters([
                Filter::make('date')
                    ->form([
                        DatePicker::make('date')
                    ])
                    ->query(fn ($query, array $data) 
                        => $query
                            ->when($data['date'], fn ($q, $date) => $q->whereDate('date', $date))
                ),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
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
            'index' => Pages\ListBookedRooms::route('/'),
        ];
    }
}
