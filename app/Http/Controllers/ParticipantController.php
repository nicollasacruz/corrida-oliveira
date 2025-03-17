<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use App\Models\Payment;
use App\Models\RunnerKit;
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
            'paymentMethod' => 'cash',
            'value' => $event->subscriptionFee,
        ]);

        RunnerKit::create([
            'participant_id' => $participant->id,
            'size' => $validated['sizeTshirt'],
        ]);

        //Mail::to($participant->email)->send(new RegistrationMail($participant));

        return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }
}
