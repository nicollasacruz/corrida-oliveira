<?php

namespace App\Filament\Resources\ParticipantResource\Widgets;

use App\Models\Participant;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalPaid extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pago', Payment::where('status', 'paid')->sum('value'))
                ->description('Total de Pagamentos recebidos')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success')
                ->icon('heroicon-o-check-circle'),
        ];
    }
}
