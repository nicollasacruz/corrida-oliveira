<?php

use App\Mail\CheckInEmail;
use App\Models\Event;
use App\Models\Participant;
use App\Services\SendCheckInEmailToParticipants;
use Illuminate\Support\Facades\Mail;

it('sends the check-in email to every participant with an email address', function () {
    Mail::fake();

    $event = Event::create([
        'name' => 'Corrida Teste',
        'runnerDate' => now()->addMonth()->toDateString(),
        'startDate' => now()->toDateString(),
        'endDate' => now()->addWeek()->toDateString(),
        'location' => 'Oliveira',
        'description' => 'Evento de teste',
        'subscriptionFee' => 10,
        'isChildEvent' => false,
    ]);

    $participants = collect([
        Participant::create([
            'event_id' => $event->id,
            'fullName' => 'Maria Silva',
            'email' => 'maria@example.com',
            'phone' => '912345678',
            'dateBorn' => '1990-01-01',
            'sizeTshirt' => 'M',
        ]),
        Participant::create([
            'event_id' => $event->id,
            'fullName' => 'Joao Costa',
            'email' => 'joao@example.com',
            'phone' => '913456789',
            'dateBorn' => '1992-02-02',
            'sizeTshirt' => 'L',
        ]),
    ]);

    $sent = app(SendCheckInEmailToParticipants::class)->sendToAll();

    expect($sent)->toBe(2);

    Mail::assertSent(CheckInEmail::class, 2);

    $participants->each(function (Participant $participant): void {
        Mail::assertSent(CheckInEmail::class, function (CheckInEmail $mail) use ($participant) {
            return $mail->hasTo($participant->email);
        });
    });
});
