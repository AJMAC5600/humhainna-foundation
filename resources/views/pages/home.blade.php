@extends('layouts.app')

@section('title', 'Hum Hain Na Foundation — Volunteer. Donate. Create Change.')

@section('content')



    {{-- =========================================================
    HERO SECTION — RESPONSIVE BANNER
    No overlay | Text aligned to left whitespace
    ========================================================= --}}

    <section class="relative w-full overflow-hidden bg-[#fbfaf6]">

        {{-- =====================================================
        MOBILE VIEW — SEPARATE (NO OVERLAY)
        Text upar, image neeche
        ====================================================== --}}
        <div class="block sm:hidden w-full">

            {{-- MOBILE CONTENT --}}
            <div class="w-full px-5 pt-4 pb-4 text-center">

                {{-- BADGE --}}
                <div class="inline-flex items-center justify-center gap-1.5
                                    px-2.5 py-1
                                    rounded-full
                                    bg-[#102957]
                                    border border-white/20
                                    shadow-[0_4px_14px_rgba(16,41,87,0.16)]
                                    mb-2">

                    <span class="w-1.5 h-1.5 rounded-full bg-[#f28c28] shrink-0"></span>

                    <span class="text-[9px] font-semibold tracking-[0.02em] text-white whitespace-nowrap">
                        Registered NGO · 5,000+ lives touched
                    </span>

                </div>

                {{-- HEADING --}}
                <h1 class="font-bold text-[#102957] tracking-[-0.045em] leading-[0.94]
                                   text-[26px] mb-2">

                    <span class="block">Together We</span>

                    <span class="relative inline-block text-[#c84f0a]">
                        Rise

                        <svg class="absolute left-0 -bottom-0.5 w-full h-[3px]" viewBox="0 0 220 9" fill="none"
                            preserveAspectRatio="none" aria-hidden="true">
                            <path d="M3 6.5C55 2 155 2 217 6" stroke="#c84f0a" stroke-width="3" stroke-linecap="round" />
                        </svg>

                    </span>

                </h1>

                {{-- DESCRIPTION --}}
                <p class="max-w-[340px] mx-auto
                                  text-[11px] leading-[1.35]
                                  text-slate-700
                                  mb-3">
                    Hum Hain Na Foundation works across education,
                    health, environment and relief — powered by
                    volunteers and transparent giving.
                </p>

                {{-- CTA BUTTONS (smaller) --}}
                <div class="flex flex-wrap items-center justify-center gap-1.5 mb-3">

                    {{-- VOLUNTEER --}}
                    <a href="{{ route('volunteer.apply.form') }}" class="
                                group inline-flex items-center justify-center whitespace-nowrap
                                gap-1
                                min-h-[30px]
                                px-3
                                rounded-full
                                bg-[#c84f0a] text-white font-semibold
                                text-[9px]
                                shadow-[0_6px_16px_rgba(200,79,10,0.16)]
                                hover:bg-[#b74406] active:scale-95
                                transition-all duration-300">

                        <span>Become a Volunteer</span>

                        <span class="material-symbols-outlined text-[11px] group-hover:translate-x-1 transition-transform">
                            arrow_forward
                        </span>

                    </a>

                    {{-- DONATE --}}
                    <a href="{{ route('donate.show') }}" class="
                                inline-flex items-center justify-center
                                gap-1
                                min-h-[28px]
                                px-3
                                rounded-full
                                bg-white/95 text-[#102957] font-semibold
                                text-[9px]
                                border border-[#102957]/25 shadow-sm
                                hover:bg-[#102957] hover:text-white hover:border-[#102957] active:scale-95
                                transition-all duration-300">

                        <span class="material-symbols-outlined text-[11px]">favorite</span>

                        <span>Donate</span>

                    </a>

                </div>

                {{-- IMPACT AREAS --}}
                <div class="mt-2 pt-2 border-t border-slate-300/50">

                    <div class="grid grid-cols-2 gap-x-2 gap-y-1.5">

                        {{-- EDUCATION --}}
                        <div class="flex items-center justify-center gap-1.5 min-w-0">
                            <div class="w-5 h-5 rounded-full bg-[#f7dfca] flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[11px] text-[#c84f0a]">menu_book</span>
                            </div>
                            <div class="min-w-0 text-left">
                                <p class="text-[8px] font-bold text-[#102957] truncate">Education</p>
                                <p class="text-[7px] text-slate-500 truncate">Brighter Minds</p>
                            </div>
                        </div>

                        {{-- HEALTH --}}
                        <div class="flex items-center justify-center gap-1.5 min-w-0">
                            <div class="w-5 h-5 rounded-full bg-[#dcebdc] flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[11px] text-[#4d7655]">favorite</span>
                            </div>
                            <div class="min-w-0 text-left">
                                <p class="text-[8px] font-bold text-[#102957] truncate">Health</p>
                                <p class="text-[7px] text-slate-500 truncate">Stronger Lives</p>
                            </div>
                        </div>

                        {{-- ENVIRONMENT --}}
                        <div class="flex items-center justify-center gap-1.5 min-w-0">
                            <div class="w-5 h-5 rounded-full bg-[#e2eee2] flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[11px] text-[#557b5b]">eco</span>
                            </div>
                            <div class="min-w-0 text-left">
                                <p class="text-[8px] font-bold text-[#102957] truncate">Environment</p>
                                <p class="text-[7px] text-slate-500 truncate">Greener Tomorrow</p>
                            </div>
                        </div>

                        {{-- COMMUNITY --}}
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

            {{-- MOBILE IMAGE (below text) --}}
            <img src="{{ \App\Models\Setting::get('hero_banner_mobile') ? asset('storage/'.\App\Models\Setting::get('hero_banner_mobile')) : asset('images/hero-banner-mobile.png') }}" alt="Hum Hain Na Foundation — Together We Rise"
                class="block w-full h-auto object-contain select-none pointer-events-none" loading="eager"
                draggable="false">

        </div>


        {{-- =====================================================
        TABLET + DESKTOP VIEW — OVERLAY (UNCHANGED)
        ====================================================== --}}
        <div class="hidden sm:block relative w-full">

            <img src="{{ \App\Models\Setting::get('hero_banner') ? asset('storage/'.\App\Models\Setting::get('hero_banner')) : asset('images/hero-banner.png') }}" alt="Hum Hain Na Foundation — Together We Rise"
                class="block w-full h-auto object-contain select-none pointer-events-none" loading="eager"
                draggable="false">


            {{-- HERO CONTENT OVER IMAGE --}}
            <div class="absolute inset-0">

                {{-- Soft readability layer --}}
                <div class="absolute inset-0
                                           bg-gradient-to-r
                                           from-[#fbfaf6]/55
                                           via-[#fbfaf6]/15
                                           to-transparent
                                           pointer-events-none">
                </div>


                {{-- CONTENT --}}
                <div class="relative z-10
                                           w-full h-full
                                           max-w-[1800px]
                                           mx-auto
                                           flex items-center">

                    {{-- LEFT CONTENT --}}
                    <div class="
                                            w-[55%]
                                            md:w-[50%]
                                            lg:w-[48%]
                                            xl:w-[46%]

                                            pl-[4%]
                                            md:pl-[5%]
                                            lg:pl-[5.5%]
                                            xl:pl-[6%]

                                            pr-2
                                            md:pr-3
                                            lg:pr-4
                                        ">

                        {{-- BADGE --}}
                        <div class="
                                                inline-flex items-center
                                                gap-1
                                                md:gap-1.5
                                                lg:gap-2

                                                px-2
                                                md:px-3
                                                lg:px-4

                                                py-0.5
                                                md:py-1
                                                lg:py-2

                                                rounded-full

                                                bg-[#102957]
                                                border border-white/20

                                                shadow-[0_4px_14px_rgba(16,41,87,0.16)]

                                                mb-1.5
                                                md:mb-2.5
                                                lg:mb-4
                                            ">

                            <span class="w-1 h-1 md:w-1.5 md:h-1.5 lg:w-2 lg:h-2 rounded-full bg-[#f28c28] shrink-0"></span>

                            <span class="
                                                    text-[7px]
                                                    md:text-[9px]
                                                    lg:text-[11px]
                                                    xl:text-sm

                                                    font-semibold
                                                    tracking-[0.02em]
                                                    text-white
                                                    whitespace-nowrap
                                                ">
                                Registered NGO · 5,000+ lives touched
                            </span>

                        </div>


                        {{-- HEADING --}}
                        <h1 class="
                                                font-bold
                                                text-[#102957]
                                                tracking-[-0.045em]
                                                leading-[0.94]

                                                text-[20px]
                                                md:text-[28px]
                                                lg:text-[42px]
                                                xl:text-[56px]
                                                2xl:text-[68px]

                                                mb-1.5
                                                md:mb-2.5
                                                lg:mb-4
                                            ">

                            <span class="block">Together We</span>

                            <span class="relative inline-block text-[#c84f0a]">
                                Rise

                                <svg class="
                                                        absolute left-0
                                                        -bottom-0.5
                                                        md:-bottom-1
                                                        lg:-bottom-1.5
                                                        w-full
                                                        h-[2px]
                                                        md:h-[3px]
                                                        lg:h-[4px]
                                                    " viewBox="0 0 220 9" fill="none" preserveAspectRatio="none"
                                    aria-hidden="true">
                                    <path d="M3 6.5C55 2 155 2 217 6" stroke="#c84f0a" stroke-width="3"
                                        stroke-linecap="round" />
                                </svg>

                            </span>

                        </h1>


                        {{-- DESCRIPTION --}}
                        <p class="
                                            max-w-[280px]
                                            md:max-w-[380px]
                                            lg:max-w-[480px]

                                            text-[8px]
                                            md:text-[10px]
                                            lg:text-[12px]
                                            xl:text-[15px]
                                            2xl:text-[19px]

                                            leading-[1.3]
                                            md:leading-[1.35]
                                            lg:leading-[1.45]
                                            xl:leading-[1.5]

                                            text-slate-700

                                            mb-1.5
                                            md:mb-2.5
                                            lg:mb-4
                                        ">
                            Hum Hain Na Foundation works across education,
                            health, environment and relief — powered by
                            volunteers and transparent giving.
                        </p>


                        {{-- CTA BUTTONS --}}
                        <div class="
                                                flex flex-wrap items-center
                                                gap-1
                                                md:gap-1.5
                                                lg:gap-3
                                                mb-1.5
                                                md:mb-2.5
                                            ">

                            {{-- VOLUNTEER --}}
                            <a href="{{ route('volunteer.apply.form') }}" class="
                        group inline-flex items-center justify-center whitespace-nowrap
                        gap-0.5 md:gap-1 lg:gap-2
                        min-h-[26px] md:min-h-[32px] lg:min-h-[42px] xl:min-h-[48px]
                        px-2.5 md:px-3.5 lg:px-5 xl:px-7
                        rounded-full
                        bg-[#c84f0a] text-white font-semibold
                        text-[7px] md:text-[9px] lg:text-xs xl:text-base
                        shadow-[0_6px_16px_rgba(200,79,10,0.16)]
                        hover:bg-[#b74406] hover:-translate-y-0.5
                        transition-all duration-300">

                                <span>Become a Volunteer</span>

                                <span class="
                            material-symbols-outlined
                            text-[9px] md:text-[11px] lg:text-[15px] xl:text-[18px]
                            group-hover:translate-x-1 transition-transform">
                                    arrow_forward
                                </span>

                            </a>


                            {{-- DONATE --}}
                            <a href="{{ route('donate.show') }}" class="
                                                    inline-flex items-center justify-center
                                                    gap-0.5 md:gap-1 lg:gap-2
                                                    min-h-[24px] md:min-h-[30px] lg:min-h-[40px] xl:min-h-[44px]
                                                    px-2.5 md:px-3.5 lg:px-4 xl:px-5
                                                    rounded-full
                                                    bg-white/95 text-[#102957] font-semibold
                                                    text-[7px] md:text-[9px] lg:text-xs xl:text-sm
                                                    border border-[#102957]/25 shadow-sm
                                                    hover:bg-[#102957] hover:text-white hover:border-[#102957] hover:-translate-y-0.5
                                                    transition-all duration-300">

                                <span class="
                                                        material-symbols-outlined
                                                        text-[9px] md:text-[11px] lg:text-[15px] xl:text-[17px]">
                                    favorite
                                </span>

                                <span>Donate</span>

                            </a>

                        </div>


                        {{-- IMPACT AREAS --}}
                        <div class="
                                                mt-1.5
                                                md:mt-2.5
                                                lg:mt-4
                                                pt-1.5
                                                md:pt-2.5
                                                lg:pt-4
                                                border-t border-slate-300/50
                                            ">

                            <div class="
                                                    grid grid-cols-4
                                                    gap-x-1.5
                                                    md:gap-x-2
                                                    lg:gap-x-3
                                                    gap-y-1.5
                                                    md:gap-y-2
                                                ">

                                {{-- EDUCATION --}}
                                <div class="flex items-center gap-1 md:gap-1.5 lg:gap-2 min-w-0">
                                    <div
                                        class="w-5 h-5 md:w-6 md:h-6 lg:w-8 lg:h-8 rounded-full bg-[#f7dfca] flex items-center justify-center shrink-0">
                                        <span
                                            class="material-symbols-outlined text-[9px] md:text-[11px] lg:text-[15px] text-[#c84f0a]">menu_book</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p
                                            class="text-[6px] md:text-[8px] lg:text-[11px] font-bold text-[#102957] truncate">
                                            Education</p>
                                        <p class="text-[5px] md:text-[7px] lg:text-[9px] text-slate-500 truncate">Brighter
                                            Minds</p>
                                    </div>
                                </div>

                                {{-- HEALTH --}}
                                <div class="flex items-center gap-1 md:gap-1.5 lg:gap-2 min-w-0">
                                    <div
                                        class="w-5 h-5 md:w-6 md:h-6 lg:w-8 lg:h-8 rounded-full bg-[#dcebdc] flex items-center justify-center shrink-0">
                                        <span
                                            class="material-symbols-outlined text-[9px] md:text-[11px] lg:text-[15px] text-[#4d7655]">favorite</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p
                                            class="text-[6px] md:text-[8px] lg:text-[11px] font-bold text-[#102957] truncate">
                                            Health</p>
                                        <p class="text-[5px] md:text-[7px] lg:text-[9px] text-slate-500 truncate">Stronger
                                            Lives</p>
                                    </div>
                                </div>

                                {{-- ENVIRONMENT --}}
                                <div class="flex items-center gap-1 md:gap-1.5 lg:gap-2 min-w-0">
                                    <div
                                        class="w-5 h-5 md:w-6 md:h-6 lg:w-8 lg:h-8 rounded-full bg-[#e2eee2] flex items-center justify-center shrink-0">
                                        <span
                                            class="material-symbols-outlined text-[9px] md:text-[11px] lg:text-[15px] text-[#557b5b]">eco</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p
                                            class="text-[6px] md:text-[8px] lg:text-[11px] font-bold text-[#102957] truncate">
                                            Environment</p>
                                        <p class="text-[5px] md:text-[7px] lg:text-[9px] text-slate-500 truncate">Greener
                                            Tomorrow</p>
                                    </div>
                                </div>

                                {{-- COMMUNITY --}}
                                <div class="flex items-center gap-1 md:gap-1.5 lg:gap-2 min-w-0">
                                    <div
                                        class="w-5 h-5 md:w-6 md:h-6 lg:w-8 lg:h-8 rounded-full bg-[#e8e9ef] flex items-center justify-center shrink-0">
                                        <span
                                            class="material-symbols-outlined text-[9px] md:text-[11px] lg:text-[15px] text-[#102957]">groups</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p
                                            class="text-[6px] md:text-[8px] lg:text-[11px] font-bold text-[#102957] truncate">
                                            Community</p>
                                        <p class="text-[5px] md:text-[7px] lg:text-[9px] text-slate-500 truncate">Inclusive
                                            Growth</p>
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
    IMPACT COUNTERS
    ========================================================= --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8
                    pt-10 sm:pt-12 md:pt-16 lg:pt-20
                    pb-16 sm:pb-20 md:pb-24">

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 md:gap-6" id="counters">

            @forelse (\App\Models\Achievement::counters()->get() as $c)
                <div class="group bg-white p-5 sm:p-7 rounded-2xl
                                shadow-sm border border-slate-200/60
                                text-center
                                hover:shadow-lg hover:-translate-y-1 hover:border-amber-200
                                transition-all duration-300">

                    <div class="w-12 h-12 sm:w-14 sm:h-14 mx-auto rounded-xl
                                    bg-blue-50 flex items-center justify-center
                                    mb-3 sm:mb-4
                                    group-hover:bg-amber-100 transition-colors duration-300">
                        <span class="material-symbols-outlined text-2xl sm:text-3xl
                                         text-blue-900 group-hover:text-amber-600
                                         transition-colors duration-300">
                            {{ $c->icon ?? 'favorite' }}
                        </span>
                    </div>

                    <div class="text-3xl sm:text-4xl lg:text-5xl font-bold text-blue-900
                                    counter-value leading-none"
                        data-target="{{ preg_replace('/[^0-9]/', '', $c->value ?? '0') }}">
                        {{ $c->value }}
                    </div>

                    <span class="block mt-2 text-[10px] sm:text-xs font-semibold
                                     uppercase tracking-wider text-slate-500">
                        {{ $c->title }}
                    </span>
                </div>
            @empty
                <div class="col-span-2 lg:col-span-4 text-center text-slate-500 py-10">
                    Impact statistics coming soon.
                </div>
            @endforelse

        </div>

    </section>


    {{-- =========================================================
    AREAS OF WORK
    ========================================================= --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 md:mb-24">

        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-10 pb-5 border-b border-slate-200">
            <div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight">
                    What We Do
                </h2>
                <p class="text-sm sm:text-base text-slate-500 mt-2">
                    Focused programs creating measurable community impact.
                </p>
            </div>
            <a href="{{ route('about') }}" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold text-blue-900
                                              hover:text-amber-600 transition-colors">
                Learn more
                <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
        </div>

        {{-- Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            @foreach ([
                    ['menu_book', 'Education Drives', 'Weekend teaching programs, digital literacy workshops and school-supply distribution for marginalized youth.', route('volunteer.apply.form')],
                    ['medical_services', 'Health Camps', 'Free check-up camps with doctors, patient registration support and community health awareness.', route('events.index')],
                    ['local_shipping', 'Distribution Drives', 'Food rations, clothing and disaster relief materials delivered where they are needed most.', route('gallery.index')],
                    ['forest', 'Environment', 'Tree plantation drives, urban clean-ups and sustainability awareness campaigns.', route('blog.index')]
                ] as [$icon, $title, $desc, $link])

                <a href="{{ $link }}"
                    class="group relative bg-white rounded-2xl p-6 sm:p-7
                                                                              border border-slate-200/60 shadow-sm
                                                                              hover:shadow-xl hover:-translate-y-1.5 hover:border-amber-200
                                                                              transition-all duration-300 flex flex-col overflow-hidden">

                    {{-- Hover accent --}}
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 to-amber-500
                                                                                    scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-300">
                    </div>

                    {{-- Icon --}}
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-blue-50 flex items-center justify-center mb-4
                                                                                    group-hover:bg-blue-900 transition-colors duration-300">
                        <span
                            class="material-symbols-outlined text-2xl text-blue-900 group-hover:text-white transition-colors duration-300">
                            {{ $icon }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-2">
                        {{ $title }}
                    </h3>

                    {{-- Description --}}
                    <p class="text-sm text-slate-500 leading-relaxed flex-grow">
                        {{ $desc }}
                    </p>

                    {{-- Arrow --}}
                    <div class="mt-4 flex items-center gap-1 text-sm font-semibold text-blue-900
                                                                                    opacity-0 group-hover:opacity-100 group-hover:translate-x-1
                                                                                    transition-all duration-300">
                        Explore
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </div>
                </a>

            @endforeach

        </div>
    </section>


    {{-- =========================================================
    UPCOMING EVENTS
    ========================================================= --}}
    @if ($upcomingEvents->count())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 md:mb-24">

            {{-- Section Header --}}
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-10 pb-5 border-b border-slate-200">
                <div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight">
                        Upcoming Events
                    </h2>
                    <p class="text-sm sm:text-base text-slate-500 mt-2">
                        Join us at our next on-ground initiative.
                    </p>
                </div>
                <a href="{{ route('events.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-900
                                                                              hover:text-amber-600 transition-colors">
                    All events
                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
            </div>

            {{-- Events Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                @foreach ($upcomingEvents as $event)
                    <a href="{{ route('events.show', $event) }}"
                        class="group bg-white rounded-2xl overflow-hidden
                                                                                                              border border-slate-200/60 shadow-sm
                                                                                                              hover:shadow-xl hover:-translate-y-1.5
                                                                                                              transition-all duration-300 flex flex-col">

                        {{-- Banner --}}
                        <div class="h-48 relative overflow-hidden bg-slate-100">
                            @if ($event->banner_path)
                                <img src="{{ asset('storage/' . $event->banner_path) }}" alt="{{ $event->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-900 to-blue-700"></div>
                            @endif

                            {{-- Category Badge --}}
                            <div
                                class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full
                                                                                                                        text-xs font-semibold text-slate-700 capitalize shadow-sm">
                                {{ str_replace('_', ' ', $event->category) }}
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6 flex flex-col flex-grow">

                            <h3
                                class="text-lg sm:text-xl font-bold text-slate-900 mb-3 leading-snug group-hover:text-blue-900 transition-colors">
                                {{ $event->title }}
                            </h3>

                            <div class="space-y-2 mb-4">
                                <p class="flex items-center gap-2 text-sm text-slate-500">
                                    <span class="material-symbols-outlined text-base text-amber-500">calendar_month</span>
                                    {{ $event->starts_at->format('D, d M Y · h:i A') }}
                                </p>
                                <p class="flex items-center gap-2 text-sm text-slate-500">
                                    <span class="material-symbols-outlined text-base text-amber-500">location_on</span>
                                    {{ Str::limit($event->location, 50) }}
                                </p>
                            </div>

                            <div class="mt-auto pt-3 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-sm font-semibold text-blue-900">View Details</span>
                                <span
                                    class="material-symbols-outlined text-base text-blue-900 group-hover:translate-x-1 transition-transform">
                                    arrow_forward
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        </section>
    @endif


    {{-- =========================================================
    GALLERY PREVIEW
    ========================================================= --}}
    @if ($albums->count())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 md:mb-24">

            {{-- Section Header --}}
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-10 pb-5 border-b border-slate-200">
                <div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight">
                        Our Work in Pictures
                    </h2>
                    <p class="text-sm sm:text-base text-slate-500 mt-2">
                        Moments from our on-ground initiatives.
                    </p>
                </div>
                <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-900
                                                                              hover:text-amber-600 transition-colors">
                    Full gallery
                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
            </div>

            {{-- Gallery Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">

                @foreach ($albums as $album)
                    <a href="{{ route('gallery.show', $album) }}"
                        class="group relative aspect-square rounded-2xl overflow-hidden
                                                                                                              border border-slate-200/60 bg-slate-100
                                                                                                              hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                        @if ($album->cover_path)
                            <img src="{{ asset('storage/' . $album->cover_path) }}" alt="{{ $album->title }}"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-blue-700"></div>
                        @endif

                        {{-- Overlay --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-blue-950/90 via-blue-950/20 to-transparent
                                                                                                                    opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                        </div>

                        {{-- Content --}}
                        <div class="absolute inset-x-0 bottom-0 p-3 sm:p-4">
                            <p class="text-white text-xs sm:text-sm font-semibold leading-tight line-clamp-2">
                                {{ Str::limit($album->title, 30) }}
                            </p>
                        </div>

                    </a>
                @endforeach

            </div>
        </section>
    @endif


    {{-- =========================================================
    TESTIMONIALS
    ========================================================= --}}
    @if ($testimonials->count())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 md:mb-24">

            {{-- Section Header --}}
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight mb-3">
                    Voices From Our Community
                </h2>
                <p class="text-sm sm:text-base text-slate-500 max-w-2xl mx-auto">
                    Real stories from volunteers, beneficiaries, and partners who make our work possible.
                </p>
            </div>

            {{-- Testimonials Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                @foreach ($testimonials as $t)
                    <figure
                        class="relative bg-[#1e3a8a] rounded-2xl p-6 sm:p-7
                                                                                                               border border-blue-800/60 shadow-sm
                                                                                                               hover:shadow-lg hover:-translate-y-1
                                                                                                               transition-all duration-300 flex flex-col">

                        {{-- Quote Mark --}}
                        <div class="absolute top-5 right-6 text-6xl text-blue-700/40 font-serif leading-none select-none">
                            "
                        </div>

                        {{-- Stars --}}
                        <div class="flex gap-0.5 mb-4 relative">
                            @for ($i = 1; $i <= 5; $i++)
                                <span
                                    class="material-symbols-outlined text-lg
                                                                                                                                                     {{ $i <= $t->rating ? 'text-amber-400' : 'text-blue-700/50' }}"
                                    style="font-variation-settings: 'FILL' 1;">
                                    star
                                </span>
                            @endfor
                        </div>

                        {{-- Quote --}}
                        <blockquote class="text-sm sm:text-base text-blue-100/90 leading-relaxed italic flex-grow relative">
                            "{{ Str::limit($t->comments, 200) }}"
                        </blockquote>

                        {{-- Author --}}
                        <figcaption class="mt-5 pt-5 border-t border-blue-700/50 flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-500
                                                                                                                    flex items-center justify-center text-blue-900 font-bold text-sm shrink-0">
                                {{ strtoupper(substr($t->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-white">{{ $t->name }}</p>
                                <p class="text-xs text-blue-200/80 capitalize">{{ $t->person_type }}</p>
                            </div>
                        </figcaption>

                    </figure>
                @endforeach

            </div>
        </section>
    @endif


    {{-- =========================================================
    FINAL CTA
    ========================================================= --}}
    @if ($testimonials->count())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 md:mb-24">

            {{-- Section Header --}}
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight mb-3">
                    Voices From Our Community
                </h2>
                <p class="text-sm sm:text-base text-slate-500 max-w-2xl mx-auto">
                    Real stories from volunteers, beneficiaries, and partners who make our work possible.
                </p>
            </div>

            {{-- Testimonials Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                @foreach ($testimonials as $t)
                    <figure class="relative bg-[#1e3a8a] rounded-2xl p-6 sm:p-7
                                                                               border border-blue-800/60 shadow-sm
                                                                               hover:shadow-lg hover:-translate-y-1
                                                                               transition-all duration-300 flex flex-col">

                        {{-- Quote Mark --}}
                        <div class="absolute top-5 right-6 text-6xl text-blue-700/40 font-serif leading-none select-none">
                            "
                        </div>

                        {{-- Stars --}}
                        <div class="flex gap-0.5 mb-4 relative">
                            @for ($i = 1; $i <= 5; $i++)
                                <span
                                    class="material-symbols-outlined text-lg
                                                                                             {{ $i <= $t->rating ? 'text-amber-400' : 'text-blue-700/50' }}"
                                    style="font-variation-settings: 'FILL' 1;">
                                    star
                                </span>
                            @endfor
                        </div>

                        {{-- Quote --}}
                        <blockquote class="text-sm sm:text-base text-blue-100/90 leading-relaxed italic flex-grow relative">
                            "{{ Str::limit($t->comments, 200) }}"
                        </blockquote>

                        {{-- Author --}}
                        <figcaption class="mt-5 pt-5 border-t border-blue-700/50 flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-500
                                                                                flex items-center justify-center text-blue-900 font-bold text-sm shrink-0">
                                {{ strtoupper(substr($t->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-white">{{ $t->name }}</p>
                                <p class="text-xs text-blue-200/80 capitalize">{{ $t->person_type }}</p>
                            </div>
                        </figcaption>

                    </figure>
                @endforeach

            </div>
        </section>
    @endif


    {{-- =========================================================
    FINAL CTA
    ========================================================= --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 md:mb-24">
        <div class="relative rounded-3xl lg:rounded-[2.5rem] overflow-hidden shadow-2xl shadow-blue-900/20">

            {{-- Background Image --}}
            <img src="{{ asset('images/cta-final.png') }}" alt="Volunteers making a difference"
                class="absolute inset-0 w-full h-full object-cover">

            {{-- Dark Blue Overlay --}}
            <!-- <div class="absolute inset-0 bg-gradient-to-br from-blue-900/95 via-blue-900/85 to-blue-800/90"></div> -->

            {{-- Dotted Pattern --}}
            <!-- <div class="absolute inset-0 opacity-10"
                    style="background-image: radial-gradient(#ffffff 1.5px, transparent 1.5px); background-size: 24px 24px;">
                </div> -->

            {{-- Glow --}}
            <!-- <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-amber-400/20 blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-blue-400/20 blur-3xl"></div> -->

            {{-- Content --}}
            <div class="relative z-10 p-8 sm:p-12 lg:p-20 text-center">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#1e3a8a] mb-4 tracking-tight leading-tight">
                    Your Time. Their Future.
                </h2>
                <p class="text-base sm:text-lg text-blue-80 max-w-2xl mx-auto mb-8 leading-relaxed">
                    Every hour volunteered and every rupee donated goes directly into verified, on-ground impact.
                </p>

                <div class="flex flex-wrap justify-center gap-3 sm:gap-4">
                    <a href="{{ route('volunteer.apply.form') }}" class="inline-flex items-center gap-2 px-6 sm:px-8 py-3.5
                                          bg-white text-blue-900 rounded-xl font-semibold text-sm sm:text-base
                                          shadow-lg hover:bg-amber-400 hover:text-blue-900 hover:-translate-y-0.5
                                          transition-all duration-200">
                        <span class="material-symbols-outlined text-lg">group_add</span>
                        Join as Volunteer
                    </a>
                    <a href="{{ route('donate.show') }}" class="inline-flex items-center gap-2 px-6 sm:px-8 py-3.5
                                          bg-amber-500 text-blue-900 rounded-xl font-semibold text-sm sm:text-base
                                          shadow-lg hover:bg-amber-400 hover:-translate-y-0.5
                                          transition-all duration-200">
                        <span class="material-symbols-outlined text-lg">favorite</span>
                        Donate Now
                    </a>
                </div>
            </div>

        </div>
    </section>

    @push('scripts')
        <script>
            // =========================================================
            // ANIMATED COUNTERS
            // =========================================================
            document.querySelectorAll('.counter-value').forEach(el => {
                const target = parseInt(el.dataset.target || '0');
                if (!target) return;

                const duration = 1500;
                const start = performance.now();

                const step = now => {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    const current = Math.floor(target * eased);
                    el.textContent = current.toLocaleString('en-IN');
                    if (progress < 1) requestAnimationFrame(step);
                };

                // Intersection Observer to trigger on scroll
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            requestAnimationFrame(step);
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.3 });

                observer.observe(el);
            });
        </script>
    @endpush

@endsection