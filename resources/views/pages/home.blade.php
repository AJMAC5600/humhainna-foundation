@extends('layouts.app')

@section('title', 'Hum Hain Na Foundation — Volunteer. Donate. Create Change.')

@section('content')
{{-- Hero --}}
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center min-h-[560px] bg-surface-container-low rounded-[2rem] overflow-hidden relative shadow-sm border border-outline-variant/30">
        <div class="lg:col-span-5 p-8 md:p-12 flex flex-col justify-center z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container-high rounded-full w-fit mb-6 border border-outline-variant/50">
                <span class="w-2 h-2 rounded-full bg-success-green"></span>
                <span class="font-label-sm text-label-sm text-on-surface-variant">Registered NGO · 5,000+ lives touched</span>
            </div>
            <h1 class="font-display-lg text-display-lg text-on-background mb-6">Together We <span class="text-secondary">Rise</span></h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-8">
                Hum Hain Na Foundation works across education, health, environment and relief — powered by volunteers and transparent giving.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('volunteer.apply.form') }}" class="bg-primary-container text-on-primary font-label-sm text-label-sm px-8 py-3 rounded-lg shadow-[0_4px_12px_rgba(9,22,74,0.15)] hover:bg-on-background transition-all flex items-center gap-2 hover:-translate-y-0.5">
                    Become a Volunteer <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
                <a href="{{ route('donate.show') }}" class="border border-outline bg-surface/50 backdrop-blur-sm text-on-background font-label-sm text-label-sm px-8 py-3 rounded-lg hover:bg-surface-variant transition-colors">
                    Donate
                </a>
            </div>
        </div>
        <div class="lg:col-span-7 h-full min-h-[320px] relative bg-gradient-to-br from-primary-container via-surface-tint to-secondary">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 18px 18px;"></div>
            @if ($albums->first()?->cover_path)
                <img src="{{ asset('storage/'.$albums->first()->cover_path) }}" alt="Our work" class="absolute inset-0 w-full h-full object-cover rounded-l-3xl lg:rounded-l-[4rem] shadow-[-10px_0_30px_rgba(9,22,74,0.05)]">
            @endif
        </div>
    </div>
</section>

{{-- Impact Counters --}}
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-gutter" id="counters">
        @forelse (\App\Models\Achievement::counters()->get() as $c)
            <div class="bg-surface-container-lowest p-6 md:p-8 rounded-[16px] shadow-sm border border-outline-variant/30 text-center hover:shadow-md transition-shadow">
                <span class="material-symbols-outlined text-3xl text-secondary-container">{{ $c->icon ?? 'favorite' }}</span>
                <div class="font-display-lg text-display-lg text-primary-container mt-2 counter-value" data-target="{{ preg_replace('/[^0-9]/', '', $c->value ?? '0') }}">{{ $c->value }}</div>
                <span class="font-label-sm text-label-sm uppercase tracking-wider block mt-1 text-on-surface-variant">{{ $c->title }}</span>
            </div>
        @empty
            <div class="col-span-4 text-center font-body-md text-body-md text-on-surface-variant">Impact statistics coming soon.</div>
        @endforelse
    </div>
</section>

{{-- Areas of Work --}}
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
    <div class="flex justify-between items-end mb-8 border-b border-outline-variant/30 pb-4">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-background">What We Do</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2">Focused programs creating measurable community impact.</p>
        </div>
        <a href="{{ route('about') }}" class="hidden sm:inline-flex font-label-sm text-label-sm text-primary-container font-semibold items-center gap-1 hover:text-secondary transition-colors">Learn more <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
        @foreach ([['menu_book', 'Education Drives', 'Weekend teaching programs, digital literacy workshops and school-supply distribution for marginalized youth.', route('volunteer.apply.form')], ['medical_services', 'Health Camps', 'Free check-up camps with doctors, patient registration support and community health awareness.', route('events.index')], ['local_shipping', 'Distribution Drives', 'Food rations, clothing and disaster relief materials delivered where they are needed most.', route('gallery.index')], ['forest', 'Environment', 'Tree plantation drives, urban clean-ups and sustainability awareness campaigns.', route('blog.index')]] as [$icon, $title, $desc, $link])
            <a href="{{ $link }}" class="bg-surface rounded-xl overflow-hidden shadow-[0_2px_8px_rgba(9,22,74,0.06)] border border-outline-variant/20 hover:shadow-[0_8px_24px_rgba(9,22,74,0.12)] transition-all duration-300 group p-6 flex flex-col">
                <div class="w-12 h-12 rounded-full bg-surface-container-low flex items-center justify-center mb-4 text-primary-container group-hover:bg-secondary-container group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined">{{ $icon }}</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-background !text-xl mb-2">{{ $title }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant text-sm flex-grow">{{ $desc }}</p>
            </a>
        @endforeach
    </div>
</section>

{{-- Upcoming Events --}}
@if ($upcomingEvents->count())
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
        <div class="flex justify-between items-end mb-8 border-b border-outline-variant/30 pb-4">
            <h2 class="font-headline-lg text-headline-lg text-on-background">Upcoming Events</h2>
            <a href="{{ route('events.index') }}" class="font-label-sm text-label-sm text-primary-container font-semibold inline-flex items-center gap-1 hover:text-secondary transition-colors">All events <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
            @foreach ($upcomingEvents as $event)
                <a href="{{ route('events.show', $event) }}" class="bg-surface rounded-xl overflow-hidden shadow-[0_2px_8px_rgba(9,22,74,0.06)] border border-outline-variant/20 hover:shadow-[0_8px_24px_rgba(9,22,74,0.12)] transition-all duration-300 group flex flex-col">
                    <div class="h-44 relative overflow-hidden bg-surface-variant">
                        @if ($event->banner_path)
                            <img src="{{ asset('storage/'.$event->banner_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                        @endif
                        <div class="absolute top-4 left-4 bg-surface/90 backdrop-blur-sm px-3 py-1 rounded-full border border-outline-variant/30 font-label-sm text-label-sm text-xs capitalize">{{ str_replace('_', ' ', $event->category) }}</div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="font-headline-md text-headline-md text-on-background !text-xl mb-2">{{ $event->title }}</h3>
                        <p class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-2 mb-1"><span class="material-symbols-outlined text-base">calendar_month</span>{{ $event->starts_at->format('D, d M Y · h:i A') }}</p>
                        <p class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-2 flex-grow"><span class="material-symbols-outlined text-base">location_on</span>{{ Str::limit($event->location, 60) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endif

{{-- Gallery Preview --}}
@if ($albums->count())
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
        <div class="flex justify-between items-end mb-8 border-b border-outline-variant/30 pb-4">
            <h2 class="font-headline-lg text-headline-lg text-on-background">Our Work in Pictures</h2>
            <a href="{{ route('gallery.index') }}" class="font-label-sm text-label-sm text-primary-container font-semibold inline-flex items-center gap-1 hover:text-secondary transition-colors">Full gallery <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-gutter">
            @foreach ($albums as $album)
                <a href="{{ route('gallery.show', $album) }}" class="group relative aspect-square rounded-xl overflow-hidden border border-outline-variant/20 bg-surface-variant">
                    @if ($album->cover_path)
                        <img src="{{ asset('storage/'.$album->cover_path) }}" alt="{{ $album->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @endif
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-primary-container/90 to-transparent p-3 pt-8">
                        <p class="text-white font-label-sm text-label-sm leading-tight">{{ Str::limit($album->title, 34) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endif

{{-- Testimonials --}}
@if ($testimonials->count())
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
        <h2 class="font-headline-lg text-headline-lg text-on-background text-center mb-10">Voices From Our Community</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
            @foreach ($testimonials as $t)
                <figure class="bg-surface rounded-xl p-6 border border-outline-variant/30 shadow-sm flex flex-col">
                    <div class="flex text-warning-amber mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined {{ $i <= $t->rating ? '' : 'opacity-25' }} text-lg">star</span>
                        @endfor
                    </div>
                    <blockquote class="font-body-md text-body-md text-on-surface-variant italic flex-grow">“{{ Str::limit($t->comments, 220) }}”</blockquote>
                    <figcaption class="mt-4 pt-4 border-t border-outline-variant/30">
                        <p class="font-label-sm text-label-sm font-semibold text-on-background">{{ $t->name }}</p>
                        <p class="font-label-sm text-label-sm text-on-surface-variant capitalize">{{ $t->person_type }}</p>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </section>
@endif

{{-- Final CTA --}}
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
    <div class="bg-primary-container rounded-[2rem] p-8 md:p-14 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1.5px, transparent 1.5px); background-size: 22px 22px;"></div>
        <h2 class="font-display-lg text-display-lg text-on-primary mb-4 relative">Your Time. Their Future.</h2>
        <p class="font-body-lg text-body-lg text-on-primary/80 max-w-2xl mx-auto mb-8 relative">Every hour volunteered and every rupee donated goes directly into verified, on-ground impact.</p>
        <div class="flex flex-wrap justify-center gap-4 relative">
            <a href="{{ route('volunteer.apply.form') }}" class="bg-surface text-primary-container font-label-sm text-label-sm px-8 py-3 rounded-lg hover:bg-surface-variant transition-all font-semibold">Join as Volunteer</a>
            <a href="{{ route('donate.show') }}" class="bg-secondary text-on-secondary font-label-sm text-label-sm px-8 py-3 rounded-lg hover:opacity-90 transition-all">Donate Now</a>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.querySelectorAll('.counter-value').forEach(el => {
        const target = parseInt(el.dataset.target || '0');
        if (!target) return;
        const suffix = el.textContent.trim().replace(/^[^A-Za-z+]*/, '');
        const dur = 1200; const start = performance.now();
        const step = now => {
            const p = Math.min((now - start) / dur, 1);
            el.textContent = Math.floor(target * (1 - Math.pow(1 - p, 3))).toLocaleString('en-IN') + (suffix && /\D/.test(suffix) ? '' : '');
            if (p < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    });
</script>
@endpush
@endsection
