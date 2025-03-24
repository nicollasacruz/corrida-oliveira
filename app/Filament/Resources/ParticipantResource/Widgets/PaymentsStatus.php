<?php

namespace App\Filament\Resources\ParticipantResource\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;

class PaymentsStatus extends ChartWidget
{
    protected static ?string $heading = 'Status dos Pagamentos';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Payment::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return [
            'datasets' => [
                [
                    'data' => array_values($data),
                    'backgroundColor' => ['#eab308', '#16a34a', '#dc2626'],
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
