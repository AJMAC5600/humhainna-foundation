@extends('layouts.app')

@section('title', 'FAQ | Hum Hain Na Foundation')

@section('content')
<section class="max-w-3xl mx-auto px-margin-mobile md:px-margin-desktop pb-section-gap-lg">
    <div class="text-center mb-12">
        <span class="material-symbols-outlined text-primary-container text-4xl">quiz</span>
        <h1 class="font-display-lg text-display-lg text-on-background mt-3 mb-3">Frequently Asked <span class="text-secondary">Questions</span></h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Everything about volunteering, donating and our work.</p>
    </div>

    <div class="space-y-3">
        @forelse ($faqs as $faq)
            <details class="group bg-surface rounded-xl border border-outline-variant/30 shadow-sm overflow-hidden open:border-primary-container/40">
                <summary class="flex items-center justify-between gap-4 p-5 cursor-pointer font-label-sm text-label-sm font-semibold text-on-background list-none [&::-webkit-details-marker]:hidden hover:bg-surface-container-low transition-colors">
                    {{ $faq->question }}
                    <span class="material-symbols-outlined text-primary-container group-open:rotate-45 transition-transform shrink-0">add_circle</span>
                </summary>
                <p class="px-5 pb-5 font-body-md text-body-md text-on-surface-variant">{!! nl2br(e($faq->answer)) !!}</p>
            </details>
        @empty
            <p class="text-center font-body-md text-body-md text-on-surface-variant bg-surface-container-low rounded-xl p-8 border border-outline-variant/30">FAQs coming soon. Meanwhile, <a href="{{ route('contact.show') }}" class="text-primary-container underline">drop us a message</a>.</p>
        @endforelse
    </div>
</section>
@endsection
