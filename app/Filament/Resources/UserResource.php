<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

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
                TextColumn::make('name')
                    ->label('Username')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->date('Y-m-d')
                    ->label('Member Since')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_at')
                            ->label('Member Since')
                    ])
                    ->query(fn ($query, array $data)
                        => $query
                            ->when($data['created_at'], fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                    )
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
            'index' => Pages\ListUsers::route('/')
        ];
    }
}
