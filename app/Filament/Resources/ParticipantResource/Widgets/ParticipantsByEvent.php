<?php

namespace App\Filament\Resources\ParticipantResource\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Event;

class ParticipantsByEvent extends BarChartWidget
{
    protected static ?string $heading = 'Participantes por Evento';
    protected static ?int $sort = 1; // ordem de exibição

    protected function getData(): array
    {
        $eventData = Event::withCount('participants')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Participantes',
                    'data' => $eventData->pluck('participants_count')->toArray(),
                    'backgroundColor' => '#3b82f6', // azul
                ],
            ],
            'labels' => $eventData->pluck('name')->toArray(),
        ];
    }
}
