<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
//use App\Mail\RegistrationMail;

class ParticipantController extends Controller
{
    public function store(Request $request, Event $id)
    {
        $event = $id;
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'dateBorn' => 'required|date',
            'sizeTshirt' => 'required|string',
        ]);
        $participant = $event->participants()->create($validated);

        Payment::create([
            'participant_id' => $participant->id,
            'event_id' => $event->id,
            'paymentMethod' => 'cash',
            'status' => 'pending',
            'value' => $event->subscriptionFee,
        ]);

        //Mail::to($participant->email)->send(new RegistrationMail($participant));

        return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }
}
