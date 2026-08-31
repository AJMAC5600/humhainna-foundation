@extends('layouts.app')

@section('title', $event->title.' | Events')
@section('meta_description', Str::limit(strip_tags($event->description), 160))

@section('content')
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <a href="{{ route('events.index') }}" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container hover:text-secondary transition-colors mb-6"><span class="material-symbols-outlined text-sm">arrow_back</span> All events</a>

    <div class="rounded-[2rem] overflow-hidden border border-outline-variant/30 shadow-[0_8px_24px_rgba(9,22,74,0.08)] relative h-[320px] md:h-[420px] bg-gradient-to-br from-primary-container via-surface-tint to-secondary">
        @if ($event->banner_path)
            <img src="{{ asset('storage/'.$event->banner_path) }}" alt="{{ $event->title }}" class="absolute inset-0 w-full h-full object-cover">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-primary-container/90 via-transparent"></div>
        <div class="absolute bottom-0 p-8 md:p-12">
            <span class="capitalize bg-surface/90 backdrop-blur-sm px-3 py-1 rounded-full border border-outline-variant/30 font-label-sm text-label-sm text-xs text-on-background">{{ str_replace('_', ' ', $event->category) }}</span>
            <h1 class="font-display-lg text-display-lg text-on-primary mt-4 !text-3xl md:!text-display-lg">{{ $event->title }}</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter mt-gutter">
        <div class="lg:col-span-2 space-y-gutter">
            <div class="bg-surface rounded-xl p-8 border border-outline-variant/30 shadow-sm">
                <h2 class="font-headline-lg text-headline-lg !text-2xl text-on-background mb-4">About this event</h2>
                <div class="font-body-md text-body-md text-on-surface-variant leading-relaxed">{!! nl2br(e($event->description)) !!}</div>
            </div>
        </div>
        <aside class="space-y-gutter">
            <div class="bg-surface-container-lowest p-6 rounded-[16px] shadow-sm border border-surface-container space-y-4">
                <p class="font-label-sm text-label-sm text-on-surface-variant flex items-start gap-2"><span class="material-symbols-outlined text-primary-container">calendar_month</span><span>{{ $event->starts_at->format('D, d M Y · h:i A') }}@if ($event->ends_at)<br>until {{ $event->ends_at->format('D, d M Y · h:i A') }}@endif</span></p>
                <p class="font-label-sm text-label-sm text-on-surface-variant flex items-start gap-2"><span class="material-symbols-outlined text-primary-container">location_on</span><span>{{ $event->location }}</span></p>
                @if ($event->volunteers_required)
                    <p class="font-label-sm text-label-sm text-on-surface-variant flex items-start gap-2"><span class="material-symbols-outlined text-primary-container">group_add</span><span>{{ $event->volunteers_required }} volunteers required<br>@if($event->volunteer_roles) Roles: {{ $event->volunteer_roles }}@endif</span></p>
                @endif
                @if ($event->map_link)
                    <a href="{{ $event->map_link }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-secondary hover:underline"><span class="material-symbols-outlined text-base">map</span> Open in Google Maps</a>
                @endif
            </div>

            <div class="bg-surface rounded-xl p-6 border border-outline-variant/30 shadow-sm" id="register">
                <h3 class="font-headline-md text-headline-md !text-xl text-on-background mb-1">{{ $event->status === 'completed' ? 'This event has concluded' : 'Register for this event' }}</h3>
                @if ($event->registration_open && $event->status !== 'completed')
                    @if (session('success'))
                        <p class="font-body-md text-body-md text-success-green font-medium py-2">{{ session('success') }}</p>
                    @else
                        <form action="{{ route('events.register', $event) }}" method="POST" class="space-y-3 pt-3">
                            @csrf
                            <input type="text" name="name" placeholder="Full name *" required value="{{ old('name', auth()->user()?->name) }}" class="w-full rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-2.5 text-sm">
                            <input type="tel" name="mobile" placeholder="Mobile number *" required value="{{ old('mobile') }}" class="w-full rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-2.5 text-sm">
                            <input type="email" name="email" placeholder="Email (optional)" value="{{ old('email') }}" class="w-full rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-2.5 text-sm">
                            <select name="people_count" class="w-full rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-2.5 text-sm">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'person' : 'people' }}</option>
                                @endfor
                            </select>
                            @error('registration')<p class="text-danger-red text-xs">{{ $message }}</p>@enderror
                            <button class="w-full bg-primary-container text-on-primary font-label-sm text-label-sm py-3 rounded-lg hover:bg-on-background transition-colors flex items-center justify-center gap-2">Confirm Registration <span class="material-symbols-outlined text-base">how_to_reg</span></button>
                        </form>
                    @endif
                @else
                    <p class="font-body-md text-body-md text-on-surface-variant pt-2">Registrations are closed for this event.</p>
                @endif
            </div>
        </aside>
    </div>
</section>
@endsection
