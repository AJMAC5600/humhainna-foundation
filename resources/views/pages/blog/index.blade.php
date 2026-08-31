@extends('layouts.app')

@section('title', 'Blog & News | Hum Hain Na Foundation')

@section('content')
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pb-section-gap-lg">
    <div class="mb-10">
        <h1 class="font-display-lg text-display-lg text-on-background mb-3">News & <span class="text-secondary">Stories</span></h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant">Announcements, field reports and press releases from the Foundation.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
        @forelse ($posts as $post)
            <a href="{{ route('blog.show', $post) }}" class="group bg-surface rounded-xl overflow-hidden shadow-[0_2px_8px_rgba(9,22,74,0.06)] border border-outline-variant/20 hover:shadow-[0_8px_24px_rgba(9,22,74,0.12)] transition-all duration-300 flex flex-col">
                <div class="h-44 bg-gradient-to-br from-primary-container to-surface-tint relative overflow-hidden">
                    @if ($post->cover_path)
                        <img src="{{ asset('storage/'.$post->cover_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <p class="font-label-sm text-label-sm text-secondary font-semibold mb-1">{{ $post->published_at->format('d M Y') }}</p>
                    <h2 class="font-headline-md !text-xl text-on-background mb-2">{{ $post->title }}</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant text-sm flex-grow">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 110) }}</p>
                    <span class="mt-4 inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container font-semibold group-hover:text-secondary transition-colors w-fit">Read more <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span></span>
                </div>
            </a>
        @empty
            <div class="col-span-full bg-surface-container-low rounded-xl p-10 text-center border border-outline-variant/30">
                <span class="material-symbols-outlined text-4xl text-outline-variant">article</span>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-3">No posts published yet.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">{{ $posts->links() }}</div>
</section>
@endsection
