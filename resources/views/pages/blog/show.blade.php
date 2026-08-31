@extends('layouts.app')

@section('title', $post->title.' | Blog')

@section('content')
<article class="max-w-3xl mx-auto px-margin-mobile md:px-margin-desktop pb-section-gap-lg">
    <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container hover:text-secondary transition-colors mb-8"><span class="material-symbols-outlined text-sm">arrow_back</span> All posts</a>

    <p class="font-label-sm text-label-sm text-secondary font-semibold">{{ $post->published_at->format('d M Y') }}</p>
    <h1 class="font-display-lg text-display-lg text-on-background mt-2 mb-6 !text-4xl">{{ $post->title }}</h1>

    @if ($post->cover_path)
        <img src="{{ asset('storage/'.$post->cover_path) }}" alt="{{ $post->title }}" class="w-full rounded-xl border border-outline-variant/30 shadow-sm mb-8"/>
    @endif

    @if ($post->excerpt)
        <p class="font-body-lg text-body-lg text-on-surface-variant italic border-l-4 border-secondary pl-5 mb-8">{{ $post->excerpt }}</p>
    @endif

    <div class="font-body-md text-body-md text-on-surface leading-relaxed space-y-4">{!! nl2br(e($post->content)) !!}</div>
</article>
@endsection
