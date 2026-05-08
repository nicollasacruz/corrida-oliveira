<?php

namespace App\Services;

use App\Mail\CheckInEmail;
use App\Models\Participant;
use Illuminate\Support\Facades\Mail;

class SendCheckInEmailToParticipants
{
    public function sendToAll(): int
    {
        $sent = 0;

        Participant::query()
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->with('event')
            ->chunkById(100, function ($participants) use (&$sent): void {
                foreach ($participants as $participant) {
                    Mail::to($participant->email)->send(new CheckInEmail($participant));
                    $sent++;
                }
            });

        return $sent;
    }

    public function recipientsCount(): int
    {
        return Participant::query()
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->count();
    }
}
