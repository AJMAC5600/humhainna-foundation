@extends('layouts.admin')

@section('title', 'Blog / News')

@section('content')
<header class="flex justify-between items-end">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-background">Blog / News</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Stories, announcements and press releases.</p>
    </div>
    <a href="{{ route('admin.blog.create') }}" class="bg-primary-container text-on-primary font-label-sm text-label-sm px-6 py-2.5 rounded-lg hover:bg-on-background transition-colors inline-flex items-center gap-2"><span class="material-symbols-outlined text-base">add</span> New Post</a>
</header>

<div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 overflow-hidden">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-surface-dim/60 font-label-sm text-xs text-on-surface-variant uppercase tracking-wider border-b border-outline-variant/30">
                <th class="px-5 py-4">Title</th>
                <th class="px-5 py-4">Status</th>
                <th class="px-5 py-4">Published</th>
                <th class="px-5 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline-variant/20">
            @forelse ($posts as $post)
                <tr class="hover:bg-surface-light transition-colors">
                    <td class="px-5 py-4 font-label-sm font-semibold text-on-background">{{ $post->title }}</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex px-3 py-1 rounded-full font-label-sm text-xs border {{ $post->published_at ? 'bg-success-green/10 text-success-green border-success-green/30' : 'bg-surface-container-low text-on-surface-variant border-outline-variant/40' }}">{{ $post->published_at ? 'Published' : 'Draft' }}</span>
                    </td>
                    <td class="px-5 py-4 text-xs text-on-surface-variant">{{ optional($post->published_at)->format('d M Y') ?? '—' }}</td>
                    <td class="px-5 py-4 text-right whitespace-nowrap">
                        @if ($post->published_at)
                            <a href="{{ route('blog.show', $post) }}" target="_blank" class="text-on-surface-variant hover:text-secondary p-1.5"><span class="material-symbols-outlined">open_in_new</span></a>
                        @endif
                        <a href="{{ route('admin.blog.edit', $post) }}" class="text-primary-container hover:text-secondary p-1.5"><span class="material-symbols-outlined">edit</span></a>
                        <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Delete post?')">@csrf @method('DELETE')<button class="text-error hover:opacity-70 p-1.5"><span class="material-symbols-outlined">delete</span></button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-12 text-center text-on-surface-variant">No posts yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $posts->links() }}</div>
</div>
@endsection
