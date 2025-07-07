<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelResource\Pages;
use App\Models\Hotel;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()->tabs([
                    Tab::make('General Info')->schema([
                        Section::make('Hotel Info')->schema([
                            TextInput::make('name')->required()->maxLength(255),
                            TextInput::make('location')->required()->maxLength(255),
                            TextInput::make('description')->required()->maxLength(255),
                            Select::make('amenities')
                                ->multiple()
                                ->required()
                                ->relationship('amenities', 'name')
                                ->preload(),
                        ])->columnSpan(1)->columns(1),

                        Group::make()->schema([
                            Section::make('Pricing & Room Details')->schema([
                                TextInput::make('price_per_night')->required()->minValue(1)->numeric(),
                                TextInput::make('total_rooms')->required()->minValue(1)->numeric(),
                            ])->columns(2),

                            Section::make('Guests Rules')->schema([
                                TextInput::make('max_guests')->required()->numeric()->minValue(1)->default(4),
                                TextInput::make('base_guest_count')->required()->numeric()->minValue(1)->default(2),
                                TextInput::make('extra_adult_fee')->required()->numeric()->minValue(1)->default(20),
                                TextInput::make('extra_child_fee')->required()->numeric()->minValue(1)->default(10),
                            ])->columns(2),
                        ])->columnSpan(1),
                    ])->icon('heroicon-o-document-text'),

                    Tab::make('Hotel Pictures')->schema([
                        Section::make('Images')->schema([
                            FileUpload::make('main_image')
                                ->label('Main Picture')
                                ->image()
                                ->required()
                                ->directory('hotels/main_image')
                                ->getUploadedFileNameForStorageUsing(
                                    fn (TemporaryUploadedFile $file) => self::getUploadedFileNameFromStorage($file)
                                ),
                                // ->deleteUploadedFileUsing(fn ($file) => Storage::disk('public')->delete($file)),
                            FileUpload::make('images')
                                ->label('Secondary Pictures')
                                ->multiple()
                                ->image()
                                ->required()
                                ->maxFiles(3)
                                ->directory('hotels/images')
                                ->getUploadedFileNameForStorageUsing(
                                    fn (TemporaryUploadedFile $file) => self::getUploadedFileNameFromStorage($file)
                                )
                                // ->deleteUploadedFileUsing(fn ($file) => Storage::disk('public')->delete($file))
                                ->formatStateUsing(fn ($state) => is_array($state) ? $state : json_decode($state, true)),
                        ])->collapsible(),
                    ])->icon('heroicon-o-photo'),
                ])->columnSpanFull()->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('location')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('description')
                    ->searchable()
                    ->toggleable()
                    ->wrap(),
                TextColumn::make('amenities.name')
                    ->searchable()
                    ->badge()
                    ->toggleable(),
                ImageColumn::make('main_image')
                    ->disk('public') // important if stored in storage/app/public
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->main_image)) // Storage::disk()->url() failed here
                    ->visibility('visible')
                    ->size(60) // or ->square()
                    ->toggleable(),
                ViewColumn::make('images')
                    ->label('Images')
                    ->view('admin.components.hotel_images')
                    ->wrapHeader()
                    ->toggleable(),
                TextColumn::make('price_per_night')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('total_rooms')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('max_guests')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('base_guest_count')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('extra_adult_fee')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('extra_child_fee')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Published at')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Modified at')
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
            ])
            ->recordUrl(null);
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

    private static function getUploadedFileNameFromStorage(TemporaryUploadedFile $file) {
        return now()->format('Y_m_d_His') . '-' // timestamp
            . str()->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' // filename
            . $file->getClientOriginalExtension(); // extension
    }
}
