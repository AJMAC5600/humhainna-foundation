@extends('layouts.app')

@section('title', 'Events | Hum Hain Na Foundation')

@section('content')
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <h1 class="font-display-lg text-display-lg text-on-background mb-4">Events & <span class="text-secondary">Campaigns</span></h1>
    <p class="font-body-lg text-body-lg text-on-surface-variant mb-8 max-w-3xl">Join an upcoming event or browse the impact of our past drives.</p>
    <div class="flex gap-2">
        <a href="{{ route('events.index', ['filter' => 'upcoming']) }}" class="font-label-sm text-label-sm px-6 py-2.5 rounded-lg transition-all {{ $filter !== 'past' ? 'bg-primary-container text-on-primary shadow-sm font-semibold' : 'border border-outline bg-surface text-on-surface-variant hover:bg-surface-container-low' }}">Upcoming</a>
        <a href="{{ route('events.index', ['filter' => 'past']) }}" class="font-label-sm text-label-sm px-6 py-2.5 rounded-lg transition-all {{ $filter === 'past' ? 'bg-primary-container text-on-primary shadow-sm font-semibold' : 'border border-outline bg-surface text-on-surface-variant hover:bg-surface-container-low' }}">Past</a>
    </div>
</section>

<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
        @forelse ($events as $event)
            <a href="{{ route('events.show', $event) }}" class="group bg-surface rounded-xl overflow-hidden shadow-[0_2px_8px_rgba(9,22,74,0.06)] border border-outline-variant/20 hover:shadow-[0_8px_24px_rgba(9,22,74,0.12)] transition-all duration-300 flex flex-col">
                <div class="h-48 relative overflow-hidden bg-gradient-to-br from-primary-container to-surface-tint">
                    @if ($event->banner_path)
                        <img src="{{ asset('storage/'.$event->banner_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                    @endif
                    <span class="absolute top-4 left-4 capitalize bg-surface/90 backdrop-blur-sm px-3 py-1 rounded-full border border-outline-variant/30 font-label-sm text-label-sm text-xs">{{ str_replace('_', ' ', $event->category) }}</span>
                    @if ($event->status === 'completed')
                        <span class="absolute top-4 right-4 bg-outline/80 text-white px-3 py-1 rounded-full font-label-sm text-label-sm text-xs">Completed</span>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="font-headline-md text-headline-md !text-xl text-on-background mb-3">{{ $event->title }}</h2>
                    <p class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-2 mb-1"><span class="material-symbols-outlined text-base">calendar_month</span>{{ $event->starts_at->format('D, d M Y') }}{{ $event->ends_at ? ' – '.$event->ends_at->format('d M Y') : '' }}</p>
                    <p class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-2 flex-grow"><span class="material-symbols-outlined text-base">location_on</span>{{ Str::limit($event->location, 60) }}</p>
                    @if ($event->volunteers_required)
                        <p class="mt-4 inline-flex w-fit items-center gap-1.5 bg-secondary-fixed-dim/40 text-secondary font-label-sm text-label-sm px-3 py-1 rounded-full"><span class="material-symbols-outlined text-base">group_add</span>{{ $event->volunteers_required }} volunteers needed</p>
                    @endif
                </div>
            </a>
        @empty
            <div class="col-span-full bg-surface-container-low rounded-xl p-10 text-center border border-outline-variant/30">
                <span class="material-symbols-outlined text-4xl text-outline-variant">event_busy</span>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-3">{{ $filter === 'past' ? 'No past events published yet.' : 'No upcoming events right now — follow us on social media for announcements.' }}</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">{{ $events->links() }}</div>
</section>
@endsection
