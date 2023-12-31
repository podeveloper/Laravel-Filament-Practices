<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Revenue Per Day';

    protected function getData(): array
    {
        $data = Trend::model(Payment::class)
            ->between(
                start: now()->subDays(30),
                end: now(),
            )
            ->perDay()
            ->sum('total');

        return [
            [
                'datasets' => [
                    'label' => 'Revenue ($)',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate / 100),
                ]
            ],
            'labels' =>  $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
