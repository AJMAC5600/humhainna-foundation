<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Volunteer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->string('filter', 'upcoming');

        return view('pages.events.index', [
            'events' => $filter === 'past'
                ? Event::past()->paginate(9)
                : Event::upcoming()->paginate(9),
            'filter' => (string) $filter,
        ]);
    }

    public function show(Event $event): View
    {
        return view('pages.events.show', compact('event'));
    }

    public function register(Request $request, Event $event)
    {
        if (! $event->registration_open) {
            return back()->withErrors(['registration' => 'Registrations are closed for this event.']);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'mobile' => ['required', 'string', 'max:20'],
            'people_count' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $volunteerId = auth()->user()?->volunteer?->id;
        if ($volunteerId && ! Volunteer::find($volunteerId)) {
            $volunteerId = null;
        }

        $event->registrations()->create([...$data, 'volunteer_id' => $volunteerId]);

        return back()->with('success', "You're registered for {$event->title}! We'll contact you with details.");
    }
}
