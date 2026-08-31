@extends('layouts.app')

@section('title', 'Achievements | Hum Hain Na Foundation')

@section('content')
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <h1 class="font-display-lg text-display-lg text-on-background mb-4">Our <span class="text-secondary">Impact</span></h1>
    <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl mb-10">Numbers, awards and stories that show what our volunteers and donors make possible.</p>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-gutter">
        @forelse ($counters as $c)
            <div class="bg-surface-container-lowest p-8 rounded-[16px] shadow-sm border border-outline-variant/30 text-center">
                <span class="material-symbols-outlined text-3xl text-secondary-container">{{ $c->icon ?? 'favorite' }}</span>
                <div class="font-display-lg text-display-lg text-primary-container mt-2">{{ $c->value }}</div>
                <span class="font-label-sm text-label-sm uppercase tracking-wider block mt-1 text-on-surface-variant">{{ $c->title }}</span>
            </div>
        @empty
            <div class="col-span-4 text-center font-body-md text-body-md text-on-surface-variant bg-surface-container-low rounded-xl p-8 border border-outline-variant/30">Impact statistics coming soon.</div>
        @endforelse
    </div>
</section>

@if ($milestones->count())
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <h2 class="font-headline-lg text-headline-lg text-on-background mb-8">Milestones Timeline</h2>
    <div class="relative pl-6 border-l-4 border-primary-container/20 space-y-8 max-w-3xl">
        @foreach ($milestones as $m)
            <div class="relative">
                <span class="absolute -left-[35px] top-1 w-5 h-5 rounded-full bg-secondary border-4 border-background shadow"></span>
                <p class="font-label-sm text-label-sm text-secondary font-semibold">{{ optional($m->date)->format('M Y') }}</p>
                <h3 class="font-headline-md text-headline-md !text-xl text-on-background mt-1">{{ $m->title }}</h3>
                @if ($m->description)<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ $m->description }}</p>@endif
            </div>
        @endforeach
    </div>
</section>
@endif

@if ($awards->count())
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <h2 class="font-headline-lg text-headline-lg text-on-background mb-8">Awards & Recognitions</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter">
        @foreach ($awards as $a)
            <div class="bg-surface rounded-xl overflow-hidden border border-outline-variant/30 shadow-sm hover:-translate-y-1 transition-transform flex flex-col">
                @if ($a->image_path)<img src="{{ asset('storage/'.$a->image_path) }}" alt="{{ $a->title }}" class="w-full h-44 object-cover">@endif
                <div class="p-6 flex flex-col gap-1">
                    <span class="material-symbols-outlined text-warning-amber">emoji_events</span>
                    <h3 class="font-headline-md text-headline-md !text-lg text-on-background">{{ $a->title }}</h3>
                    <p class="font-label-sm text-label-sm text-on-surface-variant">{{ optional($a->date)->format('Y') }}</p>
                    @if ($a->description)<p class="font-body-md text-body-md text-on-surface-variant text-sm mt-1">{{ $a->description }}</p>@endif
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

@if ($media->count())
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <h2 class="font-headline-lg text-headline-lg text-on-background mb-8">Media Coverage</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter">
        @foreach ($media as $m)
            <a href="{{ $m->link ?: '#' }}" target="{{ $m->link ? '_blank' : '_self' }}" rel="noopener" class="bg-surface rounded-xl p-6 border border-outline-variant/30 shadow-sm hover:border-secondary transition-colors block">
                <span class="material-symbols-outlined text-primary-container">newspaper</span>
                <h3 class="font-headline-md text-headline-md !text-lg text-on-background mt-2">{{ $m->title }}</h3>
                @if ($m->description)<p class="font-body-md text-body-md text-on-surface-variant text-sm mt-1">{{ $m->description }}</p>@endif
                @if ($m->link)<span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-secondary mt-3">Read coverage <span class="material-symbols-outlined text-sm">open_in_new</span></span>@endif
            </a>
        @endforeach
    </div>
</section>
@endif

@if ($stories->count())
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
    <h2 class="font-headline-lg text-headline-lg text-on-background mb-8">Success Stories</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
        @foreach ($stories as $s)
            <article class="bg-surface rounded-xl overflow-hidden border border-outline-variant/30 shadow-sm flex flex-col sm:flex-row">
                @if ($s->image_path)<img src="{{ asset('storage/'.$s->image_path) }}" alt="{{ $s->title }}" class="sm:w-48 h-48 sm:h-auto object-cover">@endif
                <div class="p-6 flex flex-col">
                    <h3 class="font-headline-md text-headline-md !text-lg text-on-background mb-2">{{ $s->title }}</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant text-sm flex-grow">{{ Str::limit($s->description, 260) }}</p>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endif
@endsection
