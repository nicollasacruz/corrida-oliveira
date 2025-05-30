<?php

namespace App\Http\Controllers;

use App\Mail\ParticipantConfirmEmail;
use App\Mail\ParticipantCreatedEmail;
use App\Models\Event;
use App\Models\Participant;
use Exception;
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
        if (Participant::where([
            'event_id' => $event->id,
            'email' => $request->input('email'),
            'fullName' => $request->input('fullName'),
        ])->first()) {
            return redirect()->back()->with('error', 'Participante já inscrito!');
        }
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
            'responsibleName' => 'required_if:dateBorn,>=,' . now()->subYears(13)->format('Y-m-d'),
        ]);

        /**
         * @var Participant $participant
         */
        $participant = $event->participants()->create($validated);

        $participant->runnerKit()->create([
            'size' => $validated['sizeTshirt'],
        ]);

        $participant->payment()->create([
            'paymentMethod' => 'cash',
            'value' => $event->subscriptionFee,
        ]);

        try {
            Mail::to($participant->email)->send(new ParticipantConfirmEmail($participant));
            Mail::to('elisabetesilvabm@gmail.com')->send(new ParticipantCreatedEmail($participant));
            Mail::to('nicollasacruz@gmail.com')->send(new ParticipantCreatedEmail($participant));
        } catch (Exception $e) {
            Log::error('Error ao enviar email de confirmação!');
            Log::error($e->getMessage());
        }

        Log::info("Inscrição realizada com sucesso! - ID: $participant->id");

        return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }
}
