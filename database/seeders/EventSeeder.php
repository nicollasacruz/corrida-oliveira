<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => 'Corrida 14km (Masculina) - 2025',
                'startDate' => '2025-03-12',
                'endDate' => '2025-05-13',
                'location' => 'Oliveira',
                'description' => 'Evento de corrida de 14km, para as pessoas se divertirem.',
                'subscriptionFee' => 12,
            ],
            [
                'name' => 'Corrida 14km (Feminina) - 2025',
                'startDate' => '2025-03-13',
                'endDate' => '2025-05-14',
                'location' => 'Oliveira',
                'description' => 'Evento de corrida de 14km, para as pessoas se divertirem.',
                'subscriptionFee' => 12,
            ],
            [
                'name' => 'Caminhada a partir dos 13 anos - 2025',
                'startDate' => '2025-03-14',
                'endDate' => '2025-05-15',
                'location' => 'Oliveira',
                'description' => 'Evento de caminhada, para as pessoas se divertirem.',
                'subscriptionFee' => 6,
            ],
            [
                'name' => 'Caminhada até aos 12 anos - 2025',
                'startDate' => '2025-03-16',
                'endDate' => '2025-05-17',
                'location' => 'Oliveira',
                'description' => 'Evento de caminhada infantil, para as crianças se divertirem.',
                'subscriptionFee' => 2,
                'isChildEvent' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
