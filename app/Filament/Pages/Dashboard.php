<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ParticipantResource\Widgets\KitsStatus;
use App\Filament\Resources\ParticipantResource\Widgets\ParticipantsByEvent;
use App\Filament\Resources\ParticipantResource\Widgets\ParticipantsPerDayChart;
use App\Filament\Resources\ParticipantResource\Widgets\PaymentsStatus;
use App\Filament\Resources\ParticipantResource\Widgets\TotalParticipants;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected function getHeaderWidgets(): array
    {
        return [
            TotalParticipants::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            ParticipantsPerDayChart::class,
            ParticipantsByEvent::class,
            PaymentsStatus::class,
            KitsStatus::class,
        ];
    }
}
