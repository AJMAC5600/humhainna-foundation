@extends('layouts.admin')

@section('title', $album->exists ? 'Edit Album' : 'New Album')

@section('content')
<a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container hover:text-secondary mb-6"><span class="material-symbols-outlined text-sm">arrow_back</span> All albums</a>

<div class="grid grid-cols-1 lg:grid-cols-5 gap-gutter items-start">
    <form method="POST" action="{{ $album->exists ? route('admin.gallery.update', $album) : route('admin.gallery.store') }}" enctype="multipart/form-data" class="lg:col-span-2 bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-6 space-y-gutter">
        @csrf
        @if ($album->exists) @method('PUT') @endif

        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="title">Album Title *</label>
            <input id="title" name="title" required value="{{ old('title', $album->title) }}" placeholder='e.g. "Winter Blanket Distribution 2025"' class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>

        <div class="grid grid-cols-2 gap-gutter">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="category">Category</label>
                <select id="category" name="category" class="rounded-lg border-outline-variant/50 bg-surface px-4 py-3 capitalize">
                    <option value="">—</option>
                    @foreach (['events','campaigns','education','health','environment','relief','women','other'] as $cat)
                        <option value="{{ $cat }}" @selected(old('category', $album->category) === $cat)>{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="date">Date of Activity</label>
                <input type="date" id="date" name="date" value="{{ old('date', optional($album->date)?->format('Y-m-d')) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
            </div>
        </div>

        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="description">Description</label>
            <textarea id="description" name="description" rows="3" class="rounded-lg border-outline-variant/50 px-4 py-3">{{ old('description', $album->description) }}</textarea>
        </div>

        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="video_url">YouTube Video Embed URL (optional)</label>
            <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $album->video_url) }}" placeholder="https://www.youtube.com/embed/…" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>

        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="cover">Cover Photo {{ $album->exists ? '' : '*' }}</label>
            <input type="file" id="cover" name="cover" accept="image/*" {{ $album->exists ? '' : 'required' }} class="text-sm file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-surface-container-low file:text-primary-container file:font-semibold"/>
            @if ($album->cover_path)<img src="{{ asset('storage/'.$album->cover_path) }}" alt="" class="mt-2 h-20 w-32 object-cover rounded-md border border-outline-variant/40"/>@endif
        </div>

        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="photos">Photos (multi-select, 5–30 recommended)</label>
            <input type="file" id="photos" name="photos[]" accept="image/*" multiple class="text-sm file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-surface-container-low file:text-primary-container file:font-semibold"/>
        </div>

        <button class="w-full bg-primary-container text-on-primary font-label-sm text-label-sm py-3 rounded-lg hover:bg-on-background transition-colors">{{ $album->exists ? 'Save Album' : 'Create Album' }}</button>
    </form>

    @if ($album->exists)
        <div class="lg:col-span-3 bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-6">
            <h2 class="font-headline-md !text-lg text-on-background mb-4">Photos in this album ({{ $album->photos->count() }})</h2>
            @if ($album->photos->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach ($album->photos as $photo)
                        <div class="relative group rounded-lg overflow-hidden border border-outline-variant/30 aspect-square">
                            <img src="{{ asset('storage/'.$photo->path) }}" alt="" class="w-full h-full object-cover"/>
                            <form action="{{ route('admin.photos.destroy', $photo) }}" method="POST" class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Remove photo?')">
                                @csrf @method('DELETE')
                                <button class="bg-error text-white rounded-md p-1"><span class="material-symbols-outlined text-sm">close</span></button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-on-surface-variant font-label-sm text-label-sm">No photos yet — save the album with photos selected, or upload more above.</p>
            @endif
        </div>
    @endif
</div>
@endsection
