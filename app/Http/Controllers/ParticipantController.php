<?php

namespace App\Http\Controllers;

use App\Mail\ParticipantConfirmEmail;
use App\Mail\ParticipantCreatedEmail;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Payment;
use App\Models\RunnerKit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Log;

//use App\Mail\RegistrationMail;

class ParticipantController extends Controller
{
    public function store(Request $request, Event $id)
    {
        $event = $id;
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('participants')->where(function ($query) use ($request) {
                    return $query->where('event_id', $request->input('event_id'))
                        ->where('fullName', $request->input('fullName'));
                }),
            ],
            'phone' => 'required|string',
            'dateBorn' => 'required|date',
            'sizeTshirt' => 'required|string',
        ]);
        $participant = $event->participants()->create($validated);

        $participant->runnerKit()->create([
            'size' => $validated['sizeTshirt'],
        ]);
        $participant->payment()->create([
            'paymentMethod' => 'cash',
            'value' => $event->subscriptionFee,
        ]);

        try {
            Mail::to($participant->email)->send(new ParticipantConfirmEmail($participant->load('event')));
            Mail::to('elisabetesilvabm@gmail.com')->send(new ParticipantCreatedEmail($participant));
        } catch (\Exception $e) {
            Log::error('Erro ao enviar email de confirmação!');
            Log::error($e->getMessage());
        }

        Log::info("Inscrição realizada com sucesso! - ID: {$participant->id}");

        return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }
}
