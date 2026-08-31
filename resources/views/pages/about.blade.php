@extends('layouts.app')

@section('title', 'About Us | Hum Hain Na Foundation')

@section('content')
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <div class="bg-surface-container-low rounded-[2rem] p-8 md:p-14 border border-outline-variant/30">
        <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container-high rounded-full w-fit mb-6">
            <span class="material-symbols-outlined text-base text-secondary-container">handshake</span>
            <span class="font-label-sm text-label-sm text-on-surface-variant">Who we are</span>
        </div>
        <h1 class="font-display-lg text-display-lg text-on-background mb-6">Hum Hain Na <span class="text-secondary">Foundation</span></h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl">{!! nl2br(e(\App\Models\Setting::get('org_tagline', 'We are a community-driven NGO working at the grassroots across education, health, environment and relief — because change begins with us.'))) !!}</p>
    </div>
</section>

<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-2 gap-gutter mb-section-gap-sm">
    <div class="bg-surface rounded-xl p-8 border border-outline-variant/30 shadow-sm">
        <span class="material-symbols-outlined text-3xl text-secondary-container">flag</span>
        <h2 class="font-headline-lg text-headline-lg !text-2xl text-on-background mt-3 mb-3">Our Mission</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">{!! nl2br(e(\App\Models\Setting::get('mission', 'To mobilize volunteers and resources for transparent, measurable community upliftment.'))) !!}</p>
    </div>
    <div class="bg-primary-container rounded-xl p-8 shadow-[0_4px_16px_rgba(9,22,74,0.15)]">
        <span class="material-symbols-outlined text-3xl text-tertiary-fixed-dim">visibility</span>
        <h2 class="font-headline-lg text-headline-lg !text-2xl text-on-primary mt-3 mb-3">Our Vision</h2>
        <p class="font-body-md text-body-md text-on-primary/85">{!! nl2br(e(\App\Models\Setting::get('vision', 'A society where no one is left behind — where every citizen participates in building a compassionate, sustainable future.'))) !!}</p>
    </div>
</section>

<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <h2 class="font-headline-lg text-headline-lg text-on-background mb-6">Our Story & Journey</h2>
    <div class="bg-surface rounded-xl p-8 border border-outline-variant/30 shadow-sm font-body-md text-body-md text-on-surface-variant leading-relaxed">
        {!! nl2br(e(\App\Models\Setting::get('story', 'Founded by a small group of friends who started with weekend food drives, the Foundation has grown into a structured volunteer network running education, health, environment and relief programs year-round. Milestones of our journey are listed on the Achievements page.'))) !!}
    </div>
</section>

<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
    <h2 class="font-headline-lg text-headline-lg text-on-background mb-6">Our Core Values</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
        @foreach (array_filter(array_map('trim', explode("\n", \App\Models\Setting::get('core_values', "Compassion — we lead with empathy in every action.\nIntegrity — full transparency in funds and fieldwork.\nService — community first, always.\nInclusion — everyone can contribute.")))) as $line)
            @php([$name, $desc] = array_pad(explode('—', $line, 2), 2, ''))
            <div class="bg-surface-container-lowest p-6 rounded-[16px] border border-outline-variant/30 shadow-sm hover:-translate-y-1 transition-transform">
                <div class="w-10 h-10 rounded-full bg-secondary-fixed-dim/40 flex items-center justify-center mb-4 text-secondary"><span class="material-symbols-outlined">favorite</span></div>
                <h3 class="font-headline-md text-headline-md !text-lg text-on-background mb-1">{{ trim($name) }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant text-sm">{{ trim($desc) }}</p>
            </div>
        @endforeach
    </div>
</section>

<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
    <h2 class="font-headline-lg text-headline-lg text-on-background mb-6">Registration & Legal Details</h2>
    <div class="bg-surface rounded-xl p-8 border border-outline-variant/30 shadow-sm flex items-start gap-4">
        <span class="material-symbols-outlined text-3xl text-success-green">verified_user</span>
        <p class="font-body-md text-body-md text-on-surface-variant">{!! nl2br(e(\App\Models\Setting::get('reg_number', 'NGO registration details will be published here for donor trust — including 12A / 80G / FCRA certificates as applicable.'))) !!}</p>
    </div>
</section>
@endsection
