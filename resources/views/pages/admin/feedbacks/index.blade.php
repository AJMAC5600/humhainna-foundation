@extends('layouts.admin')

@section('title', 'Feedback')

@section('content')
<header>
    <h1 class="font-headline-lg text-headline-lg text-on-background">Feedback & Testimonials</h1>
    <p class="font-body-md text-body-md text-on-surface-variant mt-1">Average rating: <strong class="text-warning-amber">{{ $avgRating }} ★</strong> across {{ $feedbacks->total() }} submissions. Toggle "show as testimonial" to feature feedback on the homepage.</p>
</header>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
    @forelse ($feedbacks as $fb)
        <div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-5 flex flex-col">
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <p class="font-label-sm font-semibold text-on-background">{{ $fb->name }}</p>
                    <p class="text-xs text-on-surface-variant capitalize">{{ $fb->person_type }} · about {{ str_replace('_',' ', $fb->related_to) }} · {{ $fb->created_at->format('d M Y') }}</p>
                    <div class="flex text-warning-amber mt-1.5">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-base {{ $i <= $fb->rating ? '' : 'opacity-25' }}">star</span>
                        @endfor
                    </div>
                </div>
                <form action="{{ route('admin.feedbacks.destroy', $fb) }}" method="POST" onsubmit="return confirm('Delete this feedback?')">@csrf @method('DELETE')<button class="text-error hover:opacity-70 p-1"><span class="material-symbols-outlined text-lg">delete</span></button></form>
            </div>
            <p class="font-body-md text-sm text-on-background mt-3 flex-grow">{!! nl2br(e($fb->comments)) !!}</p>
            <form action="{{ route('admin.feedbacks.update', $fb) }}" method="POST" class="mt-4 pt-3 border-t border-outline-variant/20 flex items-center justify-between gap-3">
                @csrf @method('PATCH')
                <label class="flex items-center gap-2 cursor-pointer text-xs {{ $fb->testimonial_consent ? 'text-success-green' : 'text-on-surface-variant italic' }}">
                    {{ $fb->testimonial_consent ? '✓ consent given by submitter' : 'no consent for public display' }}
                </label>
                <input type="hidden" name="show_as_testimonial" value="{{ $fb->show_as_testimonial ? 0 : 1 }}"/>
                <button class="font-label-sm text-xs px-4 py-2 rounded-lg transition-colors {{ $fb->show_as_testimonial ? 'bg-success-green text-white' : 'border border-outline bg-surface text-on-surface-variant hover:bg-surface-container-low' }}">
                    {{ $fb->show_as_testimonial ? '★ Shown on homepage — click to hide' : 'Show as testimonial' }}
                </button>
            </form>
        </div>
    @empty
        <div class="lg:col-span-2 bg-surface-container-low rounded-xl p-10 text-center border border-outline-variant/30">
            <span class="material-symbols-outlined text-4xl text-outline-variant">reviews</span>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-3">No feedback received yet.</p>
        </div>
    @endforelse
</div>

<div>{{ $feedbacks->links() }}</div>
@endsection
