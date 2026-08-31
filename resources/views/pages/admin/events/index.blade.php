@extends('layouts.admin')

@section('title', 'Events')

@section('content')
<header class="flex justify-between items-end">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-background">Manage Events</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Publish events — they appear instantly on the public website.</p>
    </div>
    <a href="{{ route('admin.events.create') }}" class="bg-primary-container text-on-primary font-label-sm text-label-sm px-6 py-2.5 rounded-lg hover:bg-on-background transition-colors inline-flex items-center gap-2"><span class="material-symbols-outlined text-base">add</span> New Event</a>
</header>

<div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left min-w-[720px]">
            <thead>
                <tr class="bg-surface-dim/60 font-label-sm text-xs text-on-surface-variant uppercase tracking-wider border-b border-outline-variant/30">
                    <th class="px-5 py-4">Event</th>
                    <th class="px-5 py-4">When / Where</th>
                    <th class="px-5 py-4">Volunteers Needed</th>
                    <th class="px-5 py-4">Registrations</th>
                    <th class="px-5 py-4">Status</th>
                    <th class="px-5 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20">
                @forelse ($events as $event)
                    <tr class="hover:bg-surface-light transition-colors">
                        <td class="px-5 py-4 max-w-[240px]">
                            <a href="{{ route('events.show', $event) }}" target="_blank" class="font-label-sm font-semibold text-on-background hover:text-secondary">{{ $event->title }}</a>
                            <span class="block text-xs capitalize text-on-surface-variant mt-0.5">{{ str_replace('_', ' ', $event->category) }}</span>
                        </td>
                        <td class="px-5 py-4 text-sm text-on-surface-variant whitespace-nowrap">{{ $event->starts_at->format('d M Y, h:i A') }}<br><span class="text-xs">{{ Str::limit($event->location, 40) }}</span></td>
                        <td class="px-5 py-4 text-sm">{{ $event->volunteers_required ?? '—' }}<br><span class="text-xs text-on-surface-variant">{{ $event->volunteer_roles }}</span></td>
                        <td class="px-5 py-4 font-label-sm">{{ $event->registrations_count }}</td>
                        <td class="px-5 py-4">
                            <span class="inline-flex px-3 py-1 rounded-full font-label-sm text-xs border {{ ['upcoming' => 'bg-warning-amber/10 text-warning-amber border-warning-amber/20', 'ongoing' => 'bg-secondary-fixed-dim/50 text-secondary border-secondary/20', 'completed' => 'bg-success-green/10 text-success-green border-success-green/20'][$event->status] }}">{{ ucfirst($event->status) }}</span>
                        </td>
                        <td class="px-5 py-4 text-right whitespace-nowrap">
                            <a href="{{ route('admin.events.edit', $event) }}" class="text-primary-container hover:text-secondary inline-flex p-1.5"><span class="material-symbols-outlined">edit</span></a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Delete event?')">@csrf @method('DELETE')<button class="text-error hover:opacity-70 p-1.5"><span class="material-symbols-outlined">delete</span></button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-12 text-center text-on-surface-variant">No events yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $events->links() }}</div>
</div>
@endsection
