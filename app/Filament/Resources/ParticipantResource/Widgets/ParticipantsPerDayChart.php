<?php

namespace App\Filament\Resources\ParticipantResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Participant;

class ParticipantsPerDayChart extends ChartWidget
{
    protected static ?string $heading = 'Inscrições por Dia';

    protected function getData(): array
    {
        $data = Participant::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Inscrições',
                    'data' => array_values($data),
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

