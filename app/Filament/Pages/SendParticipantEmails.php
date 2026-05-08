<?php

namespace App\Filament\Pages;

use App\Services\SendCheckInEmailToParticipants;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SendParticipantEmails extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Enviar Emails';

    protected static ?string $title = 'Enviar emails aos participantes';

    protected static ?string $navigationGroup = 'Comunicação';

    protected static string $view = 'filament.pages.send-participant-emails';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sendCheckInEmails')
                ->label('Enviar email para todos')
                ->icon('heroicon-o-paper-airplane')
                ->color('primary')
                ->requiresConfirmation()
                ->modalHeading('Enviar email para todos os participantes')
                ->modalDescription('Esta ação vai disparar o email de check-in para todos os participantes com email registado.')
                ->action('sendCheckInEmails')
                ->disabled(fn (): bool => $this->participantCount === 0),
        ];
    }

    public function sendCheckInEmails(SendCheckInEmailToParticipants $sender): void
    {
        $sent = $sender->sendToAll();

        Notification::make()
            ->title('Envio concluído')
            ->body("Foram enviados {$sent} emails de check-in.")
            ->success()
            ->send();
    }

    public function getParticipantCountProperty(): int
    {
        return app(SendCheckInEmailToParticipants::class)->recipientsCount();
    }
}
