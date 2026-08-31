<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.events.index', [
            'events' => Event::withCount('registrations')->orderByDesc('starts_at')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.events.form', ['event' => new Event]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($request);

        if ($request->hasFile('banner')) {
            $data['banner_path'] = $request->file('banner')->store('events/banners', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event published.');
    }

    public function edit(Event $event): View
    {
        return view('pages.admin.events.form', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($request, $event->id);

        if ($request->hasFile('banner')) {
            $data['banner_path'] = $request->file('banner')->store('events/banners', 'public');
        } else {
            unset($data['banner_path']);
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return back()->with('success', 'Event deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'banner' => ['nullable', 'image', 'max:5120'],
            'category' => ['required', 'in:education,health,environment,relief,fundraising,women,other'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'location' => ['required', 'string', 'max:500'],
            'map_link' => ['nullable', 'url'],
            'description' => ['required', 'string', 'max:10000'],
            'volunteers_required' => ['nullable', 'integer', 'min:1', 'max:9999'],
            'volunteer_roles' => ['nullable', 'string', 'max:500'],
            'registration_open' => ['sometimes', 'boolean'],
            'status' => ['required', 'in:upcoming,ongoing,completed'],
        ]);

        $data['registration_open'] = $request->boolean('registration_open');

        return $data;
    }

    private function uniqueSlug(Request $request, ?int $ignoreId = null): string
    {
        $base = Str::slug($request->input('title'));
        $slug = $base;
        $i = 2;

        while (Event::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$base}-".$i++;
        }

        return $slug;
    }
}
