@extends('layouts.app')

@section('title', 'Contact Us | Hum Hain Na Foundation')

@php($settings = \App\Models\Setting::allCached())

@section('content')
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pb-section-gap-lg">
    <div class="text-center mb-12">
        <span class="material-symbols-outlined text-primary-container text-4xl">contact_mail</span>
        <h1 class="font-display-lg text-display-lg text-on-background mt-3 mb-3">Get in <span class="text-secondary">Touch</span></h1>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto">Questions about volunteering, donations, partnerships or anything else — we'd love to hear from you.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-gutter">
        {{-- Info --}}
        <aside class="lg:col-span-2 space-y-gutter">
            <div class="bg-primary-container rounded-2xl p-8 text-on-primary space-y-6 shadow-[0_8px_24px_rgba(9,22,74,0.2)]">
                @if ($settings['address'])
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined">location_on</span>
                        <div><p class="font-label-sm text-label-sm opacity-70 uppercase tracking-wide">Office Address</p><p class="font-body-md text-body-md">{!! nl2br(e($settings['address'])) !!}</p></div>
                    </div>
                @endif
                @if ($settings['phone'] || $settings['helpline'])
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined">call</span>
                        <div><p class="font-label-sm text-label-sm opacity-70 uppercase tracking-wide">Phone / Helpline</p>
                            @if ($settings['phone'])<a href="tel:{{ preg_replace('/\s/', '', $settings['phone']) }}" class="block font-body-md text-body-md hover:underline">{{ $settings['phone'] }}</a>@endif
                            @if ($settings['helpline'])<a href="tel:{{ preg_replace('/\s/', '', $settings['helpline']) }}" class="block font-body-md text-body-md hover:underline">Helpline: {{ $settings['helpline'] }}</a>@endif
                        </div>
                    </div>
                @endif
                @if ($settings['email'])
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined">mail</span>
                        <div><p class="font-label-sm text-label-sm opacity-70 uppercase tracking-wide">Email</p><a href="mailto:{{ $settings['email'] }}" class="font-body-md text-body-md hover:underline break-all">{{ $settings['email'] }}</a></div>
                    </div>
                @endif
                @if ($settings['office_hours'])
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined">schedule</span>
                        <div><p class="font-label-sm text-label-sm opacity-70 uppercase tracking-wide">Office Hours</p><p class="font-body-md text-body-md">{{ $settings['office_hours'] }}</p></div>
                    </div>
                @endif
                <div class="pt-2 border-t border-white/15 flex gap-4">
                    @foreach ([['facebook', 'social_facebook'], ['photo_camera', 'social_instagram'], ['alternate_email', 'social_twitter'], ['smart_display', 'social_youtube'], ['business_center', 'social_linkedin']] as [$icon, $key])
                        @if ($settings[$key] ?? null)
                            <a href="{{ $settings[$key] }}" target="_blank" rel="noopener" aria-label="{{ $icon }}" class="opacity-80 hover:opacity-100 transition-opacity"><span class="material-symbols-outlined">{{ $icon }}</span></a>
                        @endif
                    @endforeach
                </div>
            </div>

            @if ($settings['map_link'])
                <div class="rounded-2xl overflow-hidden border border-outline-variant/30 shadow-sm h-64">
                    <iframe src="{{ $settings['map_link'] }}" title="Map" class="w-full h-full border-0" loading="lazy"></iframe>
                </div>
            @endif
        </aside>

        {{-- Form --}}
        <div class="lg:col-span-3">
            <div class="bg-surface rounded-2xl shadow-[0_8px_30px_rgba(9,22,74,0.08)] border border-outline-variant/20 overflow-hidden">
                <div class="h-2 w-full bg-gradient-to-r from-primary-container via-surface-tint to-secondary"></div>
                <form action="{{ route('contact.store') }}" method="POST" class="p-6 md:p-10 space-y-6">
                    @csrf
                    @if (session('success'))
                        <div data-autodismiss class="p-5 rounded-lg bg-success-green/10 border border-success-green/40 text-success-green font-body-md text-body-md flex items-start gap-3">
                            <span class="material-symbols-outlined">check_circle</span>{{ session('success') }}
                        </div>
                    @endif
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
                            <label class="font-label-sm text-label-sm text-on-background" for="subject">Subject *</label>
                            <input id="subject" name="subject" required value="{{ old('subject') }}" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm"/>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="email">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm"/>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="phone">Phone</label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm"/>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-sm text-label-sm text-on-background" for="message">Message *</label>
                        <textarea id="message" name="message" rows="6" required minlength="5" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3">{{ old('message') }}</textarea>
                    </div>

                    <button class="w-full bg-primary-container text-on-primary font-label-sm text-label-sm py-4 rounded-lg hover:bg-on-background transition-all flex items-center justify-center gap-2 text-base">
                        Send Message <span class="material-symbols-outlined text-xl">send</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
