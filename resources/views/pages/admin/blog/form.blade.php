@extends('layouts.admin')

@section('title', $post->exists ? 'Edit Post' : 'New Post')

@section('content')
<a href="{{ route('admin.blog.index') }}" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container hover:text-secondary mb-6"><span class="material-symbols-outlined text-sm">arrow_back</span> All posts</a>

<form method="POST" action="{{ $post->exists ? route('admin.blog.update', $post) : route('admin.blog.store') }}" enctype="multipart/form-data" class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-6 md:p-8 space-y-gutter max-w-3xl">
    @csrf
    @if ($post->exists) @method('PUT') @endif

    <div class="flex flex-col gap-1.5">
        <label class="font-label-sm text-label-sm text-on-background" for="title">Title *</label>
        <input id="title" name="title" required value="{{ old('title', $post->title) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
    </div>

    <div class="flex flex-col gap-1.5">
        <label class="font-label-sm text-label-sm text-on-background" for="excerpt">Excerpt (shown on cards)</label>
        <textarea id="excerpt" name="excerpt" rows="2" class="rounded-lg border-outline-variant/50 px-4 py-3">{{ old('excerpt', $post->excerpt) }}</textarea>
    </div>

    <div class="flex flex-col gap-1.5">
        <label class="font-label-sm text-label-sm text-on-background" for="content">Content *</label>
        <textarea id="content" name="content" rows="12" required class="rounded-lg border-outline-variant/50 px-4 py-3 font-body-md">{{ old('content', $post->content) }}</textarea>
    </div>

    <div class="flex flex-col gap-1.5">
        <label class="font-label-sm text-label-sm text-on-background" for="cover">Cover Image</label>
        <input type="file" id="cover" name="cover" accept="image/*" class="text-sm file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-surface-container-low file:text-primary-container file:font-semibold"/>
        @if ($post->cover_path)<img src="{{ asset('storage/'.$post->cover_path) }}" alt="" class="mt-2 h-24 w-40 object-cover rounded-md border border-outline-variant/40"/>@endif
    </div>

    <label class="inline-flex items-center gap-2 cursor-pointer">
        <input type="hidden" name="publish" value="0"/>
        <input type="checkbox" name="publish" value="1" @checked($post->published_at !== null || old('publish')) class="rounded border-outline-variant text-primary-container focus:ring-primary-container/30"/>
        <span class="font-label-sm text-label-sm">Publish immediately</span>
    </label>

    <button class="block bg-primary-container text-on-primary font-label-sm text-label-sm px-8 py-3 rounded-lg hover:bg-on-background transition-colors">{{ $post->exists ? 'Update Post' : 'Save Post' }}</button>
</form>
@endsection
