@extends('layouts.app')

@section('title', 'Feedback | Hum Hain Na Foundation')

@section('content')
<section class="max-w-3xl mx-auto px-margin-mobile md:px-margin-desktop pb-section-gap-lg">
    <div class="text-center mb-10">
        <span class="material-symbols-outlined text-primary-container text-4xl">reviews</span>
        <h1 class="font-display-lg text-display-lg text-on-background mt-3 mb-3">Share Your <span class="text-secondary">Feedback</span></h1>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto">Volunteer, donor, beneficiary or visitor — your voice helps us improve. Ratings and comments go straight to the Foundation team.</p>
    </div>

    @if (session('success'))
        <div data-autodismiss class="mb-8 p-5 rounded-lg bg-success-green/10 border border-success-green/40 text-success-green font-body-md text-body-md flex items-start gap-3">
            <span class="material-symbols-outlined">check_circle</span>{{ session('success') }}
        </div>
    @endif

    <div class="bg-surface rounded-2xl shadow-[0_8px_30px_rgba(9,22,74,0.08)] border border-outline-variant/20 overflow-hidden">
        <div class="h-2 w-full bg-gradient-to-r from-primary-container via-surface-tint to-secondary"></div>
        <form action="{{ route('feedback.store') }}" method="POST" class="p-6 md:p-10 space-y-6">
            @csrf
            @if ($errors->any())
                <div class="p-4 rounded-lg bg-error-container border border-error/30 font-label-sm text-label-sm space-y-1">
                    @foreach ($errors->all() as $err)<p>• {{ $err }}</p>@endforeach
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm text-label-sm text-on-background" for="name">Name *</label>
                    <input id="name" name="name" required value="{{ old('name') }}" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm"/>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm text-label-sm text-on-background" for="contact">Email or Mobile *</label>
                    <input id="contact" name="contact" required value="{{ old('contact') }}" placeholder="So we can follow up if needed" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm"/>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm text-label-sm text-on-background" for="person_type">I am a… *</label>
                    <select id="person_type" name="person_type" required class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 capitalize">
                        <option value="">Select…</option>
                        @foreach (['volunteer' => 'Volunteer', 'donor' => 'Donor', 'beneficiary' => 'Beneficiary', 'visitor' => 'Visitor', 'partner' => 'Partner Organization'] as $v => $l)
                            <option value="{{ $v }}" @selected(old('person_type') === $v)>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm text-label-sm text-on-background" for="related_to">Related to *</label>
                    <select id="related_to" name="related_to" required class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 capitalize">
                        <option value="">Select…</option>
                        @foreach (['event' => 'An Event', 'volunteering' => 'Volunteering Experience', 'donation' => 'Donation Process', 'website' => 'Website', 'general' => 'General'] as $v => $l)
                            <option value="{{ $v }}" @selected(old('related_to') === $v)>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <span class="font-label-sm text-label-sm text-on-background font-semibold">Your rating *</span>
                <div class="flex gap-1" id="rating-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button" data-value="{{ $i }}" onclick="setRating({{ $i }})" aria-label="{{ $i }} star" class="star-btn p-1">
                            <span class="material-symbols-outlined text-3xl {{ old('rating') >= $i ? 'text-warning-amber' : 'text-outline-variant/50' }}">{{ old('rating') >= $i ? 'star' : 'star_rate' }}</span>
                        </button>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating-input" required value="{{ old('rating') }}"/>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="comments">Comments / Suggestions *</label>
                <textarea id="comments" name="comments" rows="5" required minlength="5" placeholder="Tell us what we're doing well, and where we can do better…" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3">{{ old('comments') }}</textarea>
            </div>

            <label class="flex items-start gap-3 cursor-pointer">
                <input type="checkbox" name="testimonial_consent" value="1" class="mt-1 rounded border-outline-variant text-primary-container focus:ring-primary-container/30" @checked(old('testimonial_consent'))/>
                <span class="font-body-md text-body-md text-on-surface-variant text-sm">I'm okay with my feedback being displayed as a testimonial on the website (first name only).</span>
            </label>

            <button class="w-full bg-primary-container text-on-primary font-label-sm text-label-sm py-4 rounded-lg hover:bg-on-background transition-all flex items-center justify-center gap-2 text-base">
                Submit Feedback <span class="material-symbols-outlined text-xl">send</span>
            </button>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
function setRating(n) {
    document.getElementById('rating-input').value = n;
    document.querySelectorAll('.star-btn').forEach((btn, i) => {
        const icon = btn.querySelector('.material-symbols-outlined');
        if (i < n) { icon.classList.add('text-warning-amber'); icon.classList.remove('text-outline-variant/50'); icon.textContent = 'star'; }
        else { icon.classList.remove('text-warning-amber'); icon.classList.add('text-outline-variant/50'); icon.textContent = 'star_rate'; }
    });
}
</script>
@endpush
