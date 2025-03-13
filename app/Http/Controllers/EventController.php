<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return Inertia::render('Home', ['events' => $events]);
    }

    public function show($id)
    {
        $event = Event::with('participants')->findOrFail($id);
        return Inertia::render('Events/Subscribe', ['event' => $event]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'location' => 'required|string',
            'subscriptionFee' => 'required|numeric',
        ]);

        Event::create($validated);
        return redirect()->route('admin.events.index');
    }
}
