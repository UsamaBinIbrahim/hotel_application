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
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

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
                Forms\Components\Select::make('amenities')
                    ->multiple()
                    ->required()
                    ->relationship('amenities', 'name')
                    ->preload(),
                Forms\Components\FileUpload::make('main_image')
                    ->image()
                    ->required()
                    ->directory('hotels/main_image')
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                        return now()->format('Y_m_d_His') . '-' // timestamp
                            . str()->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' // filename
                            . $file->getClientOriginalExtension(); // extension
                    })
                    ->deleteUploadedFileUsing(function ($record, $storage, $path) {
                        $storage->delete($path);
                    }),
                Forms\Components\FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->required()
                    ->maxFiles(3)
                    ->directory('hotels/images')
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                        return now()->format('Y_m_d_His') . '-' // timestamp
                            . str()->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' // filename
                            . $file->getClientOriginalExtension(); // extension
                    })
                    ->deleteUploadedFileUsing(function ($record, $storage, $path) {
                        $storage->delete($path);
                    })
                    ->formatStateUsing(fn ($state) => is_array($state) ? $state : json_decode($state, true)),
                Forms\Components\TextInput::make('price_per_night')
                    ->required()
                    ->minValue(1)
                    ->numeric(),
                Forms\Components\TextInput::make('total_rooms')
                    ->required()
                    ->minValue(1)
                    ->numeric(),
                Forms\Components\TextInput::make('available_rooms')
                    ->required()
                    ->numeric()
                    ->visible(),
                Forms\Components\TextInput::make('max_guests')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(4),
                Forms\Components\TextInput::make('base_guest_count')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(2),
                Forms\Components\TextInput::make('extra_adult_fee')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(20),
                Forms\Components\TextInput::make('extra_child_fee')
                    ->required()
                    ->numeric()
                    ->minValue(1)
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
                Tables\Columns\TextColumn::make('amenities.name')
                    ->searchable()
                    ->badge(),
                Tables\Columns\ImageColumn::make('main_image')
                    ->disk('public') // important if stored in storage/app/public
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->main_image)) // Storage::disk()->url() failed here
                    ->visibility('visible')
                    ->size(60), // or ->square()
                Tables\Columns\ViewColumn::make('images')
                    ->label('Images')
                    ->view('admin.components.hotel_images')
                    ->wrapHeader(),
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
                Tables\Actions\DeleteAction::make()
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
