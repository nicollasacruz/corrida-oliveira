<?php

namespace App\Filament\Resources\ParticipantResource\Widgets;

use App\Models\RunnerKit;
use Filament\Widgets\ChartWidget;

class KitsStatus extends ChartWidget
{
    protected static ?string $heading = 'Status dos Kits';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = RunnerKit::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return [
            'datasets' => [
                [
                    'data' => array_values($data),
                    'backgroundColor' => ['#3b82f6', '#f97316'],
                ],
            ],
            'labels' => array_map('ucfirst', array_keys($data)),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
