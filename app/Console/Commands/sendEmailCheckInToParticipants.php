<?php

namespace App\Console\Commands;

use App\Mail\CheckInEmail;
use App\Mail\ParticipantConfirmEmail;
use App\Models\Participant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendEmailCheckInToParticipants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email-check-in-to-participants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Participant::all()->each(function (Participant $participant) {
            $this->sendEmailCheckIn($participant);
            $this->info('Email de check-in enviado para ' . $participant->fullName);
            sleep(2);
        });
    }

    private function sendEmailCheckIn(Participant $participant)
    {
        Mail::to($participant->email)->send(new CheckInEmail($participant));
    }
}
