@extends('layouts.admin')

@section('title', 'Gallery')

@section('content')
<header class="flex justify-between items-end">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-background">Manage Gallery</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Upload albums and photos — shown on the public gallery.</p>
    </div>
    <a href="{{ route('admin.gallery.create') }}" class="bg-primary-container text-on-primary font-label-sm text-label-sm px-6 py-2.5 rounded-lg hover:bg-on-background transition-colors inline-flex items-center gap-2"><span class="material-symbols-outlined text-base">add</span> New Album</a>
</header>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-gutter">
    @forelse ($albums as $album)
        <div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 overflow-hidden flex flex-col">
            <a href="{{ route('admin.gallery.edit', $album) }}" class="block h-40 bg-surface-variant relative">
                @if ($album->cover_path)
                    <img src="{{ asset('storage/'.$album->cover_path) }}" alt="" class="w-full h-full object-cover"/>
                @else
                    <span class="material-symbols-outlined absolute inset-0 m-auto w-fit h-fit text-4xl text-outline-variant">image</span>
                @endif
                <span class="absolute bottom-2 left-2 bg-surface/90 px-2.5 py-1 rounded-full font-label-sm text-xs">{{ $album->photos_count }} photos</span>
            </a>
            <div class="p-4 flex-grow">
                <h2 class="font-label-sm font-semibold text-on-background truncate">{{ $album->title }}</h2>
                <p class="text-xs capitalize text-on-surface-variant mt-0.5">{{ str_replace('_', ' ', $album->category ?? '') }} {{ $album->date ? '· '.$album->date->format('M Y') : '' }}</p>
            </div>
            <div class="px-4 pb-4 flex justify-between items-center">
                <a href="{{ route('admin.gallery.edit', $album) }}" class="text-primary-container text-xs font-semibold inline-flex items-center gap-1 hover:text-secondary"><span class="material-symbols-outlined text-sm">edit</span> Manage</a>
                <form action="{{ route('admin.gallery.destroy', $album) }}" method="POST" onsubmit="return confirm('Delete album and all its photos?')">@csrf @method('DELETE')<button class="text-error hover:opacity-70"><span class="material-symbols-outlined text-lg">delete</span></button></form>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-surface-container-low rounded-xl p-10 text-center border border-outline-variant/30">
            <span class="material-symbols-outlined text-4xl text-outline-variant">photo_library</span>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-3">No albums yet.</p>
        </div>
    @endforelse
</div>

<div>{{ $albums->links() }}</div>
@endsection
