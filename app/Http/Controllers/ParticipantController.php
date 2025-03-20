<?php

namespace App\Http\Controllers;

use App\Mail\ParticipantConfirmEmail;
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

        $participant->runnerKit()->create([
            'size' => $validated['sizeTshirt'],
        ]);
        $participant->payment()->create([
            'paymentMethod' => 'cash',
            'value' => $event->subscriptionFee,
        ]);

        Mail::to($participant->email)->send(new ParticipantConfirmEmail($participant));

        return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }
}
