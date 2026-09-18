@extends('layouts.app')

@section('title', 'About Us | Hum Hain Na Foundation')

@section('content')

{{-- =========================================================
HERO  
========================================================= --}}
<section class="relative w-full overflow-hidden bg-[#fbfaf6]">

    {{-- MOBILE VIEW — SEPARATE (NO OVERLAY) --}}
    <div class="block sm:hidden w-full">
        <div class="w-full px-5 pt-4 pb-4 text-center">

            <div class="inline-flex items-center justify-center gap-1.5 px-2.5 py-1 rounded-full bg-[#102957] border border-white/20 shadow-[0_4px_14px_rgba(16,41,87,0.16)] mb-2">
                <span class="w-1.5 h-1.5 rounded-full bg-[#f28c28] shrink-0"></span>
                <span class="text-[9px] font-semibold tracking-[0.02em] text-white whitespace-nowrap">
                    Registered NGO · Serving Since Day One
                </span>
            </div>

            <h1 class="font-bold text-[#102957] tracking-[-0.045em] leading-[0.94] text-[26px] mb-2">
                <span class="block">Who We</span>
                <span class="relative inline-block text-[#c84f0a]">
                    Are
                    <svg class="absolute left-0 -bottom-0.5 w-full h-[3px]" viewBox="0 0 220 9" fill="none" preserveAspectRatio="none" aria-hidden="true">
                        <path d="M3 6.5C55 2 155 2 217 6" stroke="#c84f0a" stroke-width="3" stroke-linecap="round" />
                    </svg>
                </span>
            </h1>

            <p class="max-w-[340px] mx-auto text-[11px] leading-[1.35] text-slate-700 mb-3">
                Hum Hain Na Foundation is a community-driven NGO
                working at the grassroots across education, health,
                environment and relief — because change begins with us.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-1.5 mb-3">
                <a href="{{ route('volunteer.apply.form') }}" class="group inline-flex items-center justify-center whitespace-nowrap gap-1 min-h-[30px] px-3 rounded-full bg-[#c84f0a] text-white font-semibold text-[9px] shadow-[0_6px_16px_rgba(200,79,10,0.16)] hover:bg-[#b74406] active:scale-95 transition-all duration-300">
                    <span>Join as Volunteer</span>
                    <span class="material-symbols-outlined text-[11px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
                <a href="{{ route('donate.show') }}" class="inline-flex items-center justify-center gap-1 min-h-[28px] px-3 rounded-full bg-white/95 text-[#102957] font-semibold text-[9px] border border-[#102957]/25 shadow-sm hover:bg-[#102957] hover:text-white hover:border-[#102957] active:scale-95 transition-all duration-300">
                    <span class="material-symbols-outlined text-[11px]">favorite</span>
                    <span>Support Us</span>
                </a>
            </div>

            <div class="mt-2 pt-2 border-t border-slate-300/50">
                <div class="grid grid-cols-2 gap-x-2 gap-y-1.5">
                    <div class="flex items-center justify-center gap-1.5 min-w-0">
                        <div class="w-5 h-5 rounded-full bg-[#f7dfca] flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[11px] text-[#c84f0a]">menu_book</span>
                        </div>
                        <div class="min-w-0 text-left">
                            <p class="text-[8px] font-bold text-[#102957] truncate">Education</p>
                            <p class="text-[7px] text-slate-500 truncate">Brighter Minds</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-1.5 min-w-0">
                        <div class="w-5 h-5 rounded-full bg-[#dcebdc] flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[11px] text-[#4d7655]">favorite</span>
                        </div>
                        <div class="min-w-0 text-left">
                            <p class="text-[8px] font-bold text-[#102957] truncate">Health</p>
                            <p class="text-[7px] text-slate-500 truncate">Stronger Lives</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-1.5 min-w-0">
                        <div class="w-5 h-5 rounded-full bg-[#e2eee2] flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[11px] text-[#557b5b]">eco</span>
                        </div>
                        <div class="min-w-0 text-left">
                            <p class="text-[8px] font-bold text-[#102957] truncate">Environment</p>
                            <p class="text-[7px] text-slate-500 truncate">Greener Tomorrow</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-1.5 min-w-0">
                        <div class="w-5 h-5 rounded-full bg-[#e8e9ef] flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[11px] text-[#102957]">groups</span>
                        </div>
                        <div class="min-w-0 text-left">
                            <p class="text-[8px] font-bold text-[#102957] truncate">Community</p>
                            <p class="text-[7px] text-slate-500 truncate">Inclusive Growth</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <img src="{{ asset('images/hero-2mobile.png') }}" alt="Hum Hain Na Foundation — Who We Are"
            class="block w-full h-auto object-contain select-none pointer-events-none" loading="eager" draggable="false">
    </div>


    {{-- TABLET + DESKTOP VIEW — OVERLAY (UNCHANGED) --}}
    <div class="hidden sm:block relative w-full">
        <img src="{{ asset('images/hero-2.png') }}" alt="Hum Hain Na Foundation — Who We Are"
            class="block w-full h-auto object-contain select-none pointer-events-none" loading="eager" draggable="false">

        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-[#fbfaf6]/55 via-[#fbfaf6]/15 to-transparent pointer-events-none"></div>

            <div class="relative z-10 w-full h-full max-w-[1800px] mx-auto flex items-center">
                <div class="w-[55%] md:w-[50%] lg:w-[48%] xl:w-[46%] pl-[4%] md:pl-[5%] lg:pl-[5.5%] xl:pl-[6%] pr-2 md:pr-3 lg:pr-4">

                    <div class="inline-flex items-center gap-1 md:gap-1.5 lg:gap-2 px-2 md:px-3 lg:px-4 py-0.5 md:py-1 lg:py-2 rounded-full bg-[#102957] border border-white/20 shadow-[0_4px_14px_rgba(16,41,87,0.16)] mb-1.5 md:mb-2.5 lg:mb-4">
                        <span class="w-1 h-1 md:w-1.5 md:h-1.5 lg:w-2 lg:h-2 rounded-full bg-[#f28c28] shrink-0"></span>
                        <span class="text-[7px] md:text-[9px] lg:text-[11px] xl:text-sm font-semibold tracking-[0.02em] text-white whitespace-nowrap">
                            Registered NGO · Serving Since Day One
                        </span>
                    </div>

                    <h1 class="font-bold text-[#102957] tracking-[-0.045em] leading-[0.94] text-[20px] md:text-[28px] lg:text-[42px] xl:text-[56px] 2xl:text-[68px] mb-1.5 md:mb-2.5 lg:mb-4">
                        <span class="block">Who We</span>
                        <span class="relative inline-block text-[#c84f0a]">
                            Are
                            <svg class="absolute left-0 -bottom-0.5 md:-bottom-1 lg:-bottom-1.5 w-full h-[2px] md:h-[3px] lg:h-[4px]" viewBox="0 0 220 9" fill="none" preserveAspectRatio="none" aria-hidden="true">
                                <path d="M3 6.5C55 2 155 2 217 6" stroke="#c84f0a" stroke-width="3" stroke-linecap="round" />
                            </svg>
                        </span>
                    </h1>

                    <p class="max-w-[280px] md:max-w-[380px] lg:max-w-[480px] text-[8px] md:text-[10px] lg:text-[12px] xl:text-[15px] 2xl:text-[19px] leading-[1.3] md:leading-[1.35] lg:leading-[1.45] xl:leading-[1.5] text-slate-700 mb-1.5 md:mb-2.5 lg:mb-4">
                        Hum Hain Na Foundation is a community-driven NGO
                        working at the grassroots across education,
                        health, environment and relief — because change
                        begins with us.
                    </p>

                    <div class="flex flex-wrap items-center gap-1 md:gap-1.5 lg:gap-3 mb-1.5 md:mb-2.5">
                        <a href="{{ route('volunteer.apply.form') }}" class="group inline-flex items-center justify-center whitespace-nowrap gap-0.5 md:gap-1 lg:gap-2 min-h-[26px] md:min-h-[32px] lg:min-h-[42px] xl:min-h-[48px] px-2.5 md:px-3.5 lg:px-5 xl:px-7 rounded-full bg-[#c84f0a] text-white font-semibold text-[7px] md:text-[9px] lg:text-xs xl:text-base shadow-[0_6px_16px_rgba(200,79,10,0.16)] hover:bg-[#b74406] hover:-translate-y-0.5 transition-all duration-300">
                            <span>Join as Volunteer</span>
                            <span class="material-symbols-outlined text-[9px] md:text-[11px] lg:text-[15px] xl:text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                        <a href="{{ route('donate.show') }}" class="inline-flex items-center justify-center gap-0.5 md:gap-1 lg:gap-2 min-h-[24px] md:min-h-[30px] lg:min-h-[40px] xl:min-h-[44px] px-2.5 md:px-3.5 lg:px-4 xl:px-5 rounded-full bg-white/95 text-[#102957] font-semibold text-[7px] md:text-[9px] lg:text-xs xl:text-sm border border-[#102957]/25 shadow-sm hover:bg-[#102957] hover:text-white hover:border-[#102957] hover:-translate-y-0.5 transition-all duration-300">
                            <span class="material-symbols-outlined text-[9px] md:text-[11px] lg:text-[15px] xl:text-[17px]">favorite</span>
                            <span>Support Us</span>
                        </a>
                    </div>

                    <div class="mt-1.5 md:mt-2.5 lg:mt-4 pt-1.5 md:pt-2.5 lg:pt-4 border-t border-slate-300/50">
                        <div class="grid grid-cols-4 gap-x-1.5 md:gap-x-2 lg:gap-x-3 gap-y-1.5 md:gap-y-2">
                            <div class="flex items-center gap-1 md:gap-1.5 lg:gap-2 min-w-0">
                                <div class="w-5 h-5 md:w-6 md:h-6 lg:w-8 lg:h-8 rounded-full bg-[#f7dfca] flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[9px] md:text-[11px] lg:text-[15px] text-[#c84f0a]">menu_book</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[6px] md:text-[8px] lg:text-[11px] font-bold text-[#102957] truncate">Education</p>
                                    <p class="text-[5px] md:text-[7px] lg:text-[9px] text-slate-500 truncate">Brighter Minds</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 md:gap-1.5 lg:gap-2 min-w-0">
                                <div class="w-5 h-5 md:w-6 md:h-6 lg:w-8 lg:h-8 rounded-full bg-[#dcebdc] flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[9px] md:text-[11px] lg:text-[15px] text-[#4d7655]">favorite</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[6px] md:text-[8px] lg:text-[11px] font-bold text-[#102957] truncate">Health</p>
                                    <p class="text-[5px] md:text-[7px] lg:text-[9px] text-slate-500 truncate">Stronger Lives</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 md:gap-1.5 lg:gap-2 min-w-0">
                                <div class="w-5 h-5 md:w-6 md:h-6 lg:w-8 lg:h-8 rounded-full bg-[#e2eee2] flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[9px] md:text-[11px] lg:text-[15px] text-[#557b5b]">eco</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[6px] md:text-[8px] lg:text-[11px] font-bold text-[#102957] truncate">Environment</p>
                                    <p class="text-[5px] md:text-[7px] lg:text-[9px] text-slate-500 truncate">Greener Tomorrow</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 md:gap-1.5 lg:gap-2 min-w-0">
                                <div class="w-5 h-5 md:w-6 md:h-6 lg:w-8 lg:h-8 rounded-full bg-[#e8e9ef] flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[9px] md:text-[11px] lg:text-[15px] text-[#102957]">groups</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[6px] md:text-[8px] lg:text-[11px] font-bold text-[#102957] truncate">Community</p>
                                    <p class="text-[5px] md:text-[7px] lg:text-[9px] text-slate-500 truncate">Inclusive Growth</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


{{-- =========================================================
CONTENT WRAPPER — consistent vertical rhythm
========================================================= --}}
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop
            pt-14 sm:pt-16 md:pt-20 lg:pt-24
            pb-16 sm:pb-20 md:pb-24
            space-y-14 sm:space-y-16 md:space-y-20 lg:space-y-24">

    {{-- =========================================================
    MISSION & VISION
    ========================================================= --}}
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">

        {{-- Mission --}}
        <div class="group bg-surface rounded-2xl p-7 sm:p-8 md:p-10 border border-outline-variant/30 shadow-sm hover:shadow-md transition-shadow duration-300">
            <div class="w-12 h-12 rounded-xl bg-secondary-fixed-dim/40 flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-2xl text-secondary">flag</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg !text-2xl text-on-background mb-4">Our Mission</h2>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                {!! nl2br(e(\App\Models\Setting::get('mission', 'To mobilize volunteers and resources for transparent, measurable community upliftment.'))) !!}
            </p>
        </div>

        {{-- Vision --}}
        <div class="group relative bg-primary-container rounded-2xl p-7 sm:p-8 md:p-10 shadow-[0_4px_16px_rgba(9,22,74,0.15)] overflow-hidden">
            <div class="absolute -top-16 -right-16 w-48 h-48 rounded-full bg-white/5 blur-2xl pointer-events-none"></div>
            <div class="relative">
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-2xl text-tertiary-fixed-dim">visibility</span>
                </div>
                <h2 class="font-headline-lg text-headline-lg !text-2xl text-on-primary mb-4">Our Vision</h2>
                <p class="font-body-md text-body-md text-on-primary/85 leading-relaxed">
                    {!! nl2br(e(\App\Models\Setting::get('vision', 'A society where no one is left behind — where every citizen participates in building a compassionate, sustainable future.'))) !!}
                </p>
            </div>
        </div>

    </section>

    {{-- =========================================================
    OUR STORY
    ========================================================= --}}
    <section>
        <div class="flex items-center gap-3 mb-6 md:mb-8">
            <span class="material-symbols-outlined text-2xl md:text-3xl text-secondary">auto_stories</span>
            <h2 class="font-headline-lg text-headline-lg text-on-background">Our Story &amp; Journey</h2>
        </div>

        <div class="relative bg-surface rounded-2xl p-7 sm:p-8 md:p-10 lg:p-12 border border-outline-variant/30 shadow-sm overflow-hidden">
            <div class="absolute left-0 top-0 h-full w-1 bg-gradient-to-b from-secondary to-secondary/0"></div>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed md:leading-loose">
                {!! nl2br(e(\App\Models\Setting::get('story', 'Founded by a small group of friends who started with weekend food drives, the Foundation has grown into a structured volunteer network running education, health, environment and relief programs year-round. Milestones of our journey are listed on the Achievements page.'))) !!}
            </p>
        </div>
    </section>

    {{-- =========================================================
    CORE VALUES
    ========================================================= --}}
    <section>
        <div class="flex items-center gap-3 mb-6 md:mb-8">
            <span class="material-symbols-outlined text-2xl md:text-3xl text-secondary">volunteer_activism</span>
            <h2 class="font-headline-lg text-headline-lg text-on-background">Our Core Values</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6">
            @foreach (array_filter(array_map('trim', explode("\n", \App\Models\Setting::get('core_values', "Compassion — we lead with empathy in every action.\nIntegrity — full transparency in funds and fieldwork.\nService — community first, always.\nInclusion — everyone can contribute.")))) as $line)
                @php([$name, $desc] = array_pad(explode('—', $line, 2), 2, ''))
                <div class="group bg-surface-container-lowest p-6 md:p-7 rounded-2xl border border-outline-variant/30 shadow-sm hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                    <div class="w-11 h-11 rounded-full bg-secondary-fixed-dim/40 flex items-center justify-center mb-5 text-secondary group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-xl">favorite</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md !text-lg text-on-background mb-2.5">{{ trim($name) }}</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant text-sm leading-relaxed">{{ trim($desc) }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- =========================================================
    REGISTRATION & LEGAL
    ========================================================= --}}
    <section>
        <div class="flex items-center gap-3 mb-6 md:mb-8">
            <span class="material-symbols-outlined text-2xl md:text-3xl text-success-green">verified_user</span>
            <h2 class="font-headline-lg text-headline-lg text-on-background">Registration &amp; Legal Details</h2>
        </div>

        <div class="bg-surface rounded-2xl p-7 sm:p-8 md:p-10 border border-outline-variant/30 shadow-sm flex flex-col sm:flex-row items-start gap-5 md:gap-6">
            <div class="w-12 h-12 rounded-xl bg-success-green/10 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-2xl text-success-green">verified_user</span>
            </div>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                {!! nl2br(e(\App\Models\Setting::get('reg_number', 'NGO registration details will be published here for donor trust — including 12A / 80G / FCRA certificates as applicable.'))) !!}
            </p>
        </div>
    </section>

</div>

@endsection