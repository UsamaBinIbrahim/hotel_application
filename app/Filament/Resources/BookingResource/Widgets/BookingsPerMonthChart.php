<?php

namespace App\Filament\Resources\BookingResource\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class BookingsPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Bookings Count';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Trend::model(Booking::class)
            ->between(
                start: now()->startOfYear(),
                end: now()
            )
            ->perMonth()
            ->count();
        
        return [
            'datasets' => [
                [
                    'label' => 'Bookings Count Per Month',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate)
                ]
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
