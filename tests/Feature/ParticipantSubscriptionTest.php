<?php

use App\Mail\ParticipantConfirmEmail;
use App\Mail\ParticipantCreatedEmail;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Support\Facades\Mail;

it('creates a participant and redirects to the homepage after subscribing', function () {
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

    $response = $this->post(route('event.subscribe', ['id' => $event->id]), [
        'fullName' => 'Maria Silva',
        'email' => 'maria@example.com',
        'phone' => '912345678',
        'dateBorn' => '1990-01-01',
        'sizeTshirt' => 'M',
    ]);

    $response
        ->assertRedirect(route('home'))
        ->assertSessionHas('success', 'Inscrição realizada com sucesso!');

    $this->assertDatabaseHas('participants', [
        'event_id' => $event->id,
        'fullName' => 'Maria Silva',
        'email' => 'maria@example.com',
    ]);

    $participant = Participant::where('email', 'maria@example.com')->firstOrFail();

    $this->assertDatabaseHas('runner_kits', [
        'participant_id' => $participant->id,
        'size' => 'M',
    ]);

    $this->assertDatabaseHas('payments', [
        'participant_id' => $participant->id,
        'paymentMethod' => 'cash',
        'value' => 10,
    ]);

    Mail::assertSent(ParticipantConfirmEmail::class);
    Mail::assertSent(ParticipantCreatedEmail::class);
});

it('does not create a duplicate participant for the same event', function () {
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

    $payload = [
        'fullName' => 'Maria Silva',
        'email' => 'maria@example.com',
        'phone' => '912345678',
        'dateBorn' => '1990-01-01',
        'sizeTshirt' => 'M',
    ];

    $this->post(route('event.subscribe', ['id' => $event->id]), $payload);

    $response = $this
        ->from(route('event.show', ['id' => $event->id]))
        ->post(route('event.subscribe', ['id' => $event->id]), $payload);

    $response
        ->assertRedirect(route('event.show', ['id' => $event->id]))
        ->assertSessionHas('error', 'Você já está inscrito neste evento!');

    expect(Participant::where('event_id', $event->id)
        ->where('fullName', 'Maria Silva')
        ->where('email', 'maria@example.com')
        ->count())->toBe(1);
});
