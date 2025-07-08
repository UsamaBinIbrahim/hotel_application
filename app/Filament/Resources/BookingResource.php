<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationGroup = 'Reservation';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

        protected static ?string $activeNavigationIcon = 'heroicon-s-bookmark';

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
                    ->label('Username')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('hotel.name')
                    ->label('Hotel')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('full_name')
                    ->label('Guest')
                    ->icon('heroicon-o-user-circle')
                    ->formatStateUsing(function ($state, $record) {
                        return <<<HTML
                            <div class="space-y-1">
                                <div class="font-medium">{$record->full_name}</div>
                                <div class="text-sm text-gray-400">
                                    {$record->email}<br>
                                    {$record->phone_number}
                                </div>
                            </div>
                        HTML;
                    })
                    ->html()
                    ->wrap()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('total_price')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'upcoming' => 'warning',
                        'active' => 'primary',
                        'completed' => 'success'
                    })
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('check_in_date')
                    ->date('Y-m-d')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('check_out_date')
                    ->date('Y-m-d')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('adults')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('children')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('check_in_date')
                    ->form([
                        DatePicker::make('check_in_date')
                            ->label('Start Date'),
                    ])
                    ->query(fn ($query, array $data)
                        => $query
                            ->when($data['check_in_date'], fn ($q, $date) => $q->whereDate('check_in_date', '>=', $date))
                    ),
                Filter::make('check_out_date')
                    ->form([
                        DatePicker::make('check_out_date')
                            ->label('End Date'),
                    ])
                    ->query(fn ($query, array $data)
                        => $query
                            ->when($data['check_out_date'], fn ($q, $date) => $q->whereDate('check_out_date', '<=', $date))
                    ),
                SelectFilter::make('status')
                    ->multiple()
                    ->options([
                        'upcoming' => 'Upcoming',
                        'active' => 'Active',
                        'completed' => 'Completed'
                    ]),
                ], layout: FiltersLayout::AboveContent)
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
            'index' => Pages\ListBookings::route('/'),
        ];
    }
}
