<?php

namespace App\Console\Commands;

use App\Services\SendCheckInEmailToParticipants;
use Illuminate\Console\Command;

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
    public function handle(SendCheckInEmailToParticipants $sender): int
    {
        $sent = $sender->sendToAll();

        $this->info("Emails de check-in enviados: {$sent}");

        return self::SUCCESS;
    }
}
