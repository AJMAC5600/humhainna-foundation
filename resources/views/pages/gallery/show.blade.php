@extends('layouts.app')

@section('title', $album->title.' | Gallery')

@section('content')
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container hover:text-secondary transition-colors mb-6"><span class="material-symbols-outlined text-sm">arrow_back</span> All albums</a>
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="font-display-lg text-display-lg text-on-background">{{ $album->title }}</h1>
            <p class="font-label-sm text-label-sm text-on-surface-variant mt-2 flex items-center gap-2">
                @if ($album->category)<span class="capitalize bg-surface-container-low px-3 py-1 rounded-full border border-outline-variant/30">{{ str_replace('_', ' ', $album->category) }}</span>@endif
                @if ($album->date)<span class="flex items-center gap-1"><span class="material-symbols-outlined text-base">calendar_month</span>{{ $album->date->format('d M Y') }}</span>@endif
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-base">photo_library</span>{{ $album->photos->count() }} photos</span>
            </p>
        </div>
    </div>
    @if ($album->description)
        <p class="font-body-md text-body-md text-on-surface-variant mt-6 max-w-3xl">{!! nl2br(e($album->description)) !!}</p>
    @endif
</section>

<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <div class="columns-1 sm:columns-2 lg:columns-3 gap-gutter [&>*]:mb-gutter">
        @foreach ($album->photos as $i => $photo)
            <button type="button" onclick="openLightbox({{ $i }})" class="group relative w-full block rounded-xl overflow-hidden border border-outline-variant/20 break-inside-avoid">
                <img src="{{ asset('storage/'.$photo->path) }}" alt="{{ $photo->caption ?? $album->title }}" loading="lazy" class="w-full group-hover:scale-[1.02] transition-transform duration-500">
                @if ($photo->caption)
                    <span class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-primary-container/90 to-transparent text-white text-left p-4 pt-10 font-label-sm text-label-sm opacity-0 group-hover:opacity-100 transition-opacity">{{ $photo->caption }}</span>
                @endif
            </button>
        @endforeach
    </div>

    @if ($album->video_url)
        <div class="mt-section-gap-sm aspect-video rounded-xl overflow-hidden border border-outline-variant/30 shadow-sm">
            <iframe src="{{ $album->video_url }}" title="Video" class="w-full h-full" allowfullscreen></iframe>
        </div>
    @endif
</section>

{{-- Lightbox --}}
<div id="lightbox" class="hidden fixed inset-0 z-[100] bg-primary-container/95 backdrop-blur-sm p-4 md:p-12 items-center justify-center" onclick="closeLightbox(event)">
    <img id="lightbox-img" src="" alt="" class="max-h-[85vh] max-w-full object-contain rounded-lg shadow-2xl mx-auto">
    <button aria-label="Close" class="absolute top-4 right-4 text-white/80 hover:text-white"><span class="material-symbols-outlined text-4xl">close</span></button>
</div>

@push('scripts')
<script>
    const photos = {!! Js::from($album->photos->map(fn ($p) => ['src' => asset('storage/'.$p->path), 'caption' => $p->caption])) !!};
    function openLightbox(i) {
        const lb = document.getElementById('lightbox');
        document.getElementById('lightbox-img').src = photos[i].src;
        lb.classList.remove('hidden'); lb.classList.add('flex');
    }
    function closeLightbox(e) {
        if (e.target.tagName === 'IMG') return;
        const lb = document.getElementById('lightbox');
        lb.classList.add('hidden'); lb.classList.remove('flex');
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox({ target: null }); });
</script>
@endpush
@endsection
