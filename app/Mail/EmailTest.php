<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailTest extends Mailable
{
    use Queueable, SerializesModels;

    private string $token;

    /**
     * Create a new message instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('Email Test Token')
            ->view('mail.email-test')
            ->with([
                'token' => $this->token,
            ]);
    }

}
