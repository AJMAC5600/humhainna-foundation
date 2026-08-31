@extends('layouts.app')

@section('title', 'Our Work — Photo Gallery | Hum Hain Na Foundation')

@section('content')
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <h1 class="font-display-lg text-display-lg text-on-background mb-4">Our Work</h1>
    <p class="font-body-lg text-body-lg text-on-surface-variant mb-8 max-w-3xl">Albums from our events, campaigns and drives — proof of every hour our community puts in.</p>

    <form method="GET" class="flex flex-wrap gap-3 items-center bg-surface-container-low rounded-xl p-4 border border-outline-variant/30">
        <select name="category" class="rounded-lg border-outline-variant/50 bg-surface px-4 py-2.5 font-label-sm text-label-sm focus:border-primary-container focus:ring-primary-container/20 capitalize">
            <option value="">All categories</option>
            @foreach ($categories as $cat)
                @if ($cat)
                    <option value="{{ $cat }}" @selected($activeCategory === $cat)>{{ ucfirst(str_replace('_', ' ', $cat)) }}</option>
                @endif
            @endforeach
        </select>
        <select name="year" class="rounded-lg border-outline-variant/50 bg-surface px-4 py-2.5 font-label-sm text-label-sm focus:border-primary-container focus:ring-primary-container/20">
            <option value="">All years</option>
            @foreach ($years as $y)
                <option value="{{ $y }}" @selected(request('year') == $y)>{{ $y }}</option>
            @endforeach
        </select>
        <button class="bg-primary-container text-on-primary font-label-sm text-label-sm px-6 py-2.5 rounded-lg hover:bg-on-background transition-colors">Filter</button>
        @if (request()->hasAny(['category', 'year']))
            <a href="{{ route('gallery.index') }}" class="font-label-sm text-label-sm text-on-surface-variant hover:text-secondary underline ml-1">Reset</a>
        @endif
    </form>
</section>

<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter">
        @forelse ($albums as $album)
            <a href="{{ route('gallery.show', $album) }}" class="group bg-surface rounded-xl overflow-hidden shadow-[0_2px_8px_rgba(9,22,74,0.06)] border border-outline-variant/20 hover:shadow-[0_8px_24px_rgba(9,22,74,0.12)] transition-all duration-300 flex flex-col">
                <div class="h-52 relative overflow-hidden bg-surface-variant">
                    @if ($album->cover_path)
                        <img src="{{ asset('storage/'.$album->cover_path) }}" alt="{{ $album->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                    @endif
                    @if ($album->category)
                        <div class="absolute top-4 left-4 bg-surface/90 backdrop-blur-sm px-3 py-1 rounded-full border border-outline-variant/30 font-label-sm text-label-sm text-xs capitalize">{{ str_replace('_', ' ', $album->category) }}</div>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="font-headline-md text-headline-md !text-xl text-on-background mb-1">{{ $album->title }}</h2>
                    <p class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-1.5 mb-3">
                        <span class="material-symbols-outlined text-base">calendar_month</span>{{ optional($album->date)->format('d M Y') }}
                        <span class="mx-1">·</span>
                        <span class="material-symbols-outlined text-base">photo_library</span>{{ $album->photos_count }} photos
                    </p>
                    <p class="font-body-md text-body-md text-on-surface-variant text-sm flex-grow">{{ Str::limit($album->description, 120) }}</p>
                </div>
            </a>
        @empty
            <div class="col-span-full bg-surface-container-low rounded-xl p-10 text-center border border-outline-variant/30">
                <span class="material-symbols-outlined text-4xl text-outline-variant">photo_library</span>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-3">No albums published yet. Check back soon!</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">{{ $albums->links() }}</div>
</section>
@endsection
