<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailTest extends Mailable
{
    use Queueable, SerializesModels;

    public string $token;

    /**
     * Cria uma nova instância da mensagem.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Constrói o e-mail com assunto e view.
     */
    public function build()
    {
        return $this->subject('Email Test Token')
            ->view('mail.email-test') // resources/views/mail/email-test.blade.php
            ->with([
                'token' => $this->token,
            ]);
    }
}
