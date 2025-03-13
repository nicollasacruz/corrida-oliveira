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
                'name' => 'Laravel Day',
                'startDate' => '2025-03-12',
                'endDate' => '2025-03-13',
                'location' => 'Online',
                'description' => 'The Laravel Day is a conference that brings together the best developers in the Laravel community.',
                'subscriptionFee' => 100.00,
            ],
            [
                'name' => 'PHP Conference',
                'startDate' => '2025-03-14',
                'endDate' => '2025-03-15',
                'location' => 'Online',
                'description' => 'The PHP Conference is a conference that brings together the best developers in the PHP community.',
                'subscriptionFee' => 150.00,
            ],
            [
                'name' => 'JavaScript Summit',
                'startDate' => '2025-03-16',
                'endDate' => '2025-03-17',
                'location' => 'Online',
                'description' => 'The JavaScript Summit is a conference that brings together the best developers in the JavaScript community.',
                'subscriptionFee' => 200.00,
                'isChildEvent' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
