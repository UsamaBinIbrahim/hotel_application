<?php

namespace App\Filament\Resources\BookingResource\Widgets;

use App\Models\Booking;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\DB;

class BookingRevenuesPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly Booking Revenue';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Trend::model(Booking::class)
            ->between(
                start: now()->startOfYear(),
                end: now()
            )
            ->perMonth()
            ->sum('total_price'); 

        return [
            'datasets' => [
                [
                    'label' => 'Total Revenue',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59,130,246,0.2)',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
