<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelResource\Pages;
use App\Filament\Resources\HotelResource\RelationManagers;
use App\Models\Hotel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required()
                    ->directory('hotels')
                    ->getUploadedFileNameUsing(function ($file) {
                        return (string) str()->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                            . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                    })
                    ->deleteUploadedFileUsing(function ($record, $storage, $path) {
                        $storage->delete($path);
                    }),
                Forms\Components\TextInput::make('price_per_night')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_rooms')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('available_rooms')
                    ->required()
                    ->numeric()
                    ->hiddenOn('create', 'edit'),
                Forms\Components\TextInput::make('max_guests')
                    ->required()
                    ->numeric()
                    ->default(4),
                Forms\Components\TextInput::make('base_guest_count')
                    ->required()
                    ->numeric()
                    ->default(2),
                Forms\Components\TextInput::make('extra_adult_fee')
                    ->required()
                    ->numeric()
                    ->default(20),
                Forms\Components\TextInput::make('extra_child_fee')
                    ->required()
                    ->numeric()
                    ->default(10),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('price_per_night')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_rooms')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('available_rooms')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_guests')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('base_guest_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('extra_adult_fee')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('extra_child_fee')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}
