<?php

namespace App\Filament\Resources\ParticipantResource\Widgets;

use App\Models\Participant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalParticipants extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de Participantes', Participant::count())
        ];
    }
}
