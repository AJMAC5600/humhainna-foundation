@extends('layouts.app')

@section('title', 'Volunteer With Us | Hum Hain Na Foundation')

@section('content')

{{-- =========================================================
HERO  (unchanged)
========================================================= --}}
<section class="relative w-full overflow-hidden bg-[#fbfaf6]">

    {{-- MOBILE --}}
    <div class="block sm:hidden w-full">
        <div class="w-full px-5 pt-5 pb-5 text-center">

            <div class="inline-flex items-center justify-center gap-1.5 px-2.5 py-1 rounded-full
                        bg-[#102957] border border-white/20
                        shadow-[0_4px_14px_rgba(16,41,87,0.16)] mb-2.5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#f28c28] shrink-0"></span>
                <span class="text-[9px] font-semibold tracking-[0.02em] text-white whitespace-nowrap">
                    Join our active volunteers
                </span>
            </div>

            <h1 class="font-bold text-[#102957] tracking-[-0.045em] leading-[0.94] text-[26px] mb-2.5">
                <span class="block">Become a</span>
                <span class="relative inline-block text-[#c84f0a]">
                    Change Maker
                    <svg class="absolute left-0 -bottom-0.5 w-full h-[3px]" viewBox="0 0 220 9" fill="none"
                        preserveAspectRatio="none" aria-hidden="true">
                        <path d="M3 6.5C55 2 155 2 217 6" stroke="#c84f0a" stroke-width="3" stroke-linecap="round" />
                    </svg>
                </span>
            </h1>

            <p class="max-w-[340px] mx-auto text-[11px] leading-[1.35] text-slate-700 mb-3">
                Your time is the most valuable donation. Join the
                Hum Hain Na Foundation to drive transparent,
                community-led impact across education, health,
                and environment.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-1.5 mb-3">
                <a href="#register-form"
                   class="group inline-flex items-center justify-center whitespace-nowrap
                          gap-1 min-h-[30px] px-3 rounded-full
                          bg-[#c84f0a] text-white font-semibold text-[9px]
                          shadow-[0_6px_16px_rgba(200,79,10,0.16)]
                          hover:bg-[#b74406] active:scale-95
                          transition-all duration-300">
                    <span>Register Now</span>
                    <span class="material-symbols-outlined text-[11px] group-hover:translate-x-1 transition-transform">
                        arrow_forward
                    </span>
                </a>

                <a href="#areas-of-work"
                   class="inline-flex items-center justify-center
                          gap-1 min-h-[28px] px-3 rounded-full
                          bg-white/95 text-[#102957] font-semibold text-[9px]
                          border border-[#102957]/25 shadow-sm
                          hover:bg-[#102957] hover:text-white hover:border-[#102957] active:scale-95
                          transition-all duration-300">
                    <span>Explore Roles</span>
                </a>
            </div>

        </div>

        <img src="{{ asset('images/hero-2mobile.png') }}"
             alt="Hum Hain Na Foundation — Volunteer"
             class="block w-full h-auto object-contain select-none pointer-events-none"
             loading="eager" draggable="false">
    </div>

    {{-- TABLET + DESKTOP --}}
    <div class="hidden sm:block relative w-full">
        <img src="{{ asset('images/hero-2.png') }}"
             alt="Hum Hain Na Foundation — Volunteer"
             class="block w-full h-auto object-contain select-none pointer-events-none"
             loading="eager" draggable="false">

        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-[#fbfaf6]/55 via-[#fbfaf6]/15 to-transparent pointer-events-none"></div>

            <div class="relative z-10 w-full h-full max-w-[1800px] mx-auto flex items-center">
                <div class="w-[55%] md:w-[50%] lg:w-[48%] xl:w-[46%]
                            pl-[4%] md:pl-[5%] lg:pl-[5.5%] xl:pl-[6%]
                            pr-2 md:pr-3 lg:pr-4">

                    <div class="inline-flex items-center gap-1 md:gap-1.5 lg:gap-2
                                px-2 md:px-3 lg:px-4 py-0.5 md:py-1 lg:py-2
                                rounded-full bg-[#102957] border border-white/20
                                shadow-[0_4px_14px_rgba(16,41,87,0.16)]
                                mb-1.5 md:mb-2.5 lg:mb-4">
                        <span class="w-1 h-1 md:w-1.5 md:h-1.5 lg:w-2 lg:h-2 rounded-full bg-[#f28c28] shrink-0"></span>
                        <span class="text-[7px] md:text-[9px] lg:text-[11px] xl:text-sm
                                     font-semibold tracking-[0.02em] text-white whitespace-nowrap">
                            Join our active volunteers
                        </span>
                    </div>

                    <h1 class="font-bold text-[#102957] tracking-[-0.045em] leading-[0.94]
                               text-[20px] md:text-[28px] lg:text-[42px] xl:text-[56px] 2xl:text-[68px]
                               mb-1.5 md:mb-2.5 lg:mb-4">
                        <span class="block">Become a</span>
                        <span class="relative inline-block text-[#c84f0a]">
                            Change Maker
                            <svg class="absolute left-0 -bottom-0.5 md:-bottom-1 lg:-bottom-1.5
                                        w-full h-[2px] md:h-[3px] lg:h-[4px]"
                                 viewBox="0 0 220 9" fill="none"
                                 preserveAspectRatio="none" aria-hidden="true">
                                <path d="M3 6.5C55 2 155 2 217 6" stroke="#c84f0a" stroke-width="3" stroke-linecap="round" />
                            </svg>
                        </span>
                    </h1>

                    <p class="max-w-[280px] md:max-w-[380px] lg:max-w-[480px]
                              text-[8px] md:text-[10px] lg:text-[12px] xl:text-[15px] 2xl:text-[19px]
                              leading-[1.3] md:leading-[1.35] lg:leading-[1.45] xl:leading-[1.5]
                              text-slate-700
                              mb-1.5 md:mb-2.5 lg:mb-4">
                        Your time is the most valuable donation. Join the
                        Hum Hain Na Foundation to drive transparent,
                        community-led impact across education, health,
                        and environment.
                    </p>

                    <div class="flex flex-wrap items-center gap-1 md:gap-1.5 lg:gap-3">
                        <a href="#register-form"
                           class="group inline-flex items-center justify-center whitespace-nowrap
                                  gap-0.5 md:gap-1 lg:gap-2
                                  min-h-[26px] md:min-h-[32px] lg:min-h-[42px] xl:min-h-[48px]
                                  px-2.5 md:px-3.5 lg:px-5 xl:px-7 rounded-full
                                  bg-[#c84f0a] text-white font-semibold
                                  text-[7px] md:text-[9px] lg:text-xs xl:text-base
                                  shadow-[0_6px_16px_rgba(200,79,10,0.16)]
                                  hover:bg-[#b74406] hover:-translate-y-0.5
                                  transition-all duration-300">
                            <span>Register Now</span>
                            <span class="material-symbols-outlined
                                         text-[9px] md:text-[11px] lg:text-[15px] xl:text-[18px]
                                         group-hover:translate-x-1 transition-transform">
                                arrow_forward
                            </span>
                        </a>

                        <a href="#areas-of-work"
                           class="inline-flex items-center justify-center
                                  gap-0.5 md:gap-1 lg:gap-2
                                  min-h-[24px] md:min-h-[30px] lg:min-h-[40px] xl:min-h-[44px]
                                  px-2.5 md:px-3.5 lg:px-4 xl:px-5 rounded-full
                                  bg-white/95 text-[#102957] font-semibold
                                  text-[7px] md:text-[9px] lg:text-xs xl:text-sm
                                  border border-[#102957]/25 shadow-sm
                                  hover:bg-[#102957] hover:text-white hover:border-[#102957] hover:-translate-y-0.5
                                  transition-all duration-300">
                            <span>Explore Roles</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>


{{-- =========================================================
CONTENT WRAPPER
========================================================= --}}
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop
            pt-10 sm:pt-12 md:pt-16 lg:pt-20
            pb-16 sm:pb-20 md:pb-24
            space-y-14 sm:space-y-16 md:space-y-20 lg:space-y-24">

    {{-- =========================================================
    WHY VOLUNTEER
    ========================================================= --}}
    {{-- =========================================================
WHY VOLUNTEER  (redesigned)
========================================================= --}}
<section>
    <div class="text-center mb-10 md:mb-14">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                    bg-secondary-fixed-dim/40 mb-4">
            <span class="material-symbols-outlined text-base text-secondary">favorite</span>
            <span class="font-label-sm text-label-sm text-secondary font-semibold">
                Why join us
            </span>
        </div>
        <h2 class="font-headline-lg text-headline-lg text-on-background mb-4">
            Why Volunteer with Us?
        </h2>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto leading-relaxed">
            Experience utility-driven transparency. We provide you
            with the tools, training, and tracking to see the direct
            result of your efforts.
        </p>
    </div>

    {{-- Layout: Left hero-impact card, Right 4 reason cards --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 md:gap-6">

        {{-- LEFT: Verified Impact hero card --}}
        <div class="lg:col-span-5 relative rounded-3xl overflow-hidden
                    bg-primary-container text-on-primary
                    shadow-[0_8px_28px_rgba(9,22,74,0.18)]
                    flex flex-col justify-between
                    p-7 sm:p-8 md:p-10 min-h-[320px]
                    group
                    hover:shadow-[0_12px_36px_rgba(9,22,74,0.24)]
                    transition-shadow duration-500">

            {{-- Decorative glow --}}
            <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-secondary/25 blur-3xl
                        pointer-events-none group-hover:scale-125 transition-transform duration-700"></div>

            {{-- Watermark icon --}}
            <div class="absolute bottom-0 right-0 opacity-[0.06] pointer-events-none
                        transform group-hover:scale-110 rotate-6 transition-transform duration-700">
                <span class="material-symbols-outlined" style="font-size: 240px;">volunteer_activism</span>
            </div>

            <div class="relative z-10">
                <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-sm
                            flex items-center justify-center mb-6
                            ring-1 ring-white/15">
                    <span class="material-symbols-outlined text-3xl text-secondary-fixed-dim">public</span>
                </div>
                <h3 class="font-headline-md text-headline-md mb-3 text-2xl md:text-3xl">
                    Verified Impact
                </h3>
                <p class="font-body-md text-body-md opacity-90 leading-relaxed max-w-sm">
                    Every hour logged translates to verifiable community
                    upliftment, tracked through your volunteer dashboard.
                </p>
            </div>

            <div class="relative z-10 mt-8 pt-6 border-t border-white/15">
                <div class="flex items-end gap-3">
                    <span class="font-display-lg text-display-lg leading-none">
                        {{ \App\Models\Achievement::ofType('counter')->where('title', 'like', '%lives%')->value('value') ?? '5,000+' }}
                    </span>
                </div>
                <span class="font-label-sm text-label-sm uppercase tracking-[0.15em] block mt-2 opacity-75">
                    Lives Touched
                </span>
            </div>
        </div>

        {{-- RIGHT: 4 reason cards in 2x2 grid --}}
        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-6">

            @foreach ([
                ['school', 'Skill Building', 'Gain professional experience in logistics, teaching, and event management.'],
                ['badge', 'Official ID & Certificates', 'Receive an official foundation ID card and certificates of appreciation you can verify online.'],
                ['task_alt', 'Real Task Tracking', 'Assignments with clear deadlines and proof-based verification of your work.'],
                ['groups', 'Supportive Community', 'A network of compassionate people institutionalizing social welfare through structured action.']
            ] as [$icon, $title, $desc])
                <div class="group/card relative bg-surface rounded-2xl p-6 md:p-7
                            border border-outline-variant/40 shadow-sm
                            flex flex-col overflow-hidden
                            hover:shadow-[0_10px_28px_rgba(9,22,74,0.10)]
                            hover:-translate-y-1.5
                            hover:border-secondary/30
                            transition-all duration-300">

                    {{-- Hover glow --}}
                    <div class="absolute -top-12 -right-12 w-32 h-32 rounded-full
                                bg-secondary/5 blur-2xl opacity-0
                                group-hover/card:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative w-12 h-12 rounded-xl
                                bg-gradient-to-br from-secondary-fixed-dim/60 to-secondary-fixed-dim/30
                                flex items-center justify-center mb-5 text-secondary
                                group-hover/card:scale-110 group-hover/card:rotate-3
                                transition-transform duration-300">
                        <span class="material-symbols-outlined">{{ $icon }}</span>
                    </div>

                    <h3 class="relative font-headline-md text-headline-md mb-2 text-on-background !text-lg">
                        {{ $title }}
                    </h3>
                    <p class="relative font-body-md text-body-md text-on-surface-variant text-sm leading-relaxed flex-grow">
                        {{ $desc }}
                    </p>

                    {{-- Bottom accent line --}}
                    <div class="relative mt-5 h-0.5 w-8 rounded-full
                                bg-gradient-to-r from-secondary to-[#c84f0a]
                                group-hover/card:w-full transition-all duration-500"></div>
                </div>
            @endforeach

        </div>

    </div>
</section>

    {{-- =========================================================
    AREAS OF WORK
    ========================================================= --}}
    <section id="areas-of-work">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-3
                    mb-8 md:mb-10
                    border-b border-outline-variant/30 pb-4 md:pb-5">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                            bg-secondary-fixed-dim/40 mb-3">
                    <span class="material-symbols-outlined text-base text-secondary">category</span>
                    <span class="font-label-sm text-label-sm text-secondary font-semibold">
                        Where you fit in
                    </span>
                </div>
                <h2 class="font-headline-lg text-headline-lg text-on-background">Areas of Work</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2">
                    Where your skills can make the most difference.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6">
            @foreach ([
                ['menu_book', 'Education Drives', 'Assist in weekend teaching programs, digital literacy workshops, and distributing school supplies to marginalized youth.', 'education'],
                ['medical_services', 'Health Camps', 'Support medical professionals with patient registration, crowd management, and basic vitals checking during community health camps.', 'health_camps'],
                ['local_shipping', 'Distribution Drives', 'Manage logistics, packing, and systematic distribution of food rations, clothing, and disaster relief materials.', 'distribution_drives'],
                ['forest', 'Environment', 'Participate in organized tree plantation drives, urban clean-ups, and sustainability awareness campaigns.', 'environment']
            ] as [$icon, $title, $desc, $value])
                <div class="group/card relative bg-surface rounded-2xl
                            shadow-[0_2px_8px_rgba(9,22,74,0.06)]
                            border border-outline-variant/20 overflow-hidden
                            hover:shadow-[0_12px_32px_rgba(9,22,74,0.12)]
                            hover:-translate-y-1.5
                            hover:border-secondary/30
                            transition-all duration-300
                            p-6 md:p-7 flex flex-col h-full">

                    {{-- Accent bar on hover --}}
                    <div class="absolute top-0 left-0 h-1 w-0 bg-gradient-to-r from-secondary to-[#c84f0a]
                                group-hover/card:w-full transition-all duration-500"></div>

                    <div class="relative w-12 h-12 rounded-xl
                                bg-gradient-to-br from-secondary-fixed-dim/60 to-secondary-fixed-dim/30
                                flex items-center justify-center mb-5 text-secondary
                                group-hover/card:scale-110 group-hover/card:rotate-3
                                transition-transform duration-300">
                        <span class="material-symbols-outlined">{{ $icon }}</span>
                    </div>

                    <h3 class="font-headline-md text-headline-md text-on-background !text-xl mb-2.5">
                        {{ $title }}
                    </h3>

                    <p class="font-body-md text-body-md text-on-surface-variant text-sm leading-relaxed mb-5 flex-grow">
                        {{ $desc }}
                    </p>

                    <button type="button" onclick="checkInterest('{{ $value }}')"
                            class="font-label-sm text-label-sm text-[#c84f0a] font-semibold
                                   inline-flex items-center gap-1 hover:text-secondary
                                   transition-colors w-fit group/btn
                                   border-t border-outline-variant/20 pt-4 w-full justify-between">
                        <span>Select Role</span>
                        <span class="material-symbols-outlined text-sm
                                     group-hover/btn:translate-x-1 transition-transform">
                            arrow_forward
                        </span>
                    </button>

                </div>
            @endforeach
        </div>
    </section>

    {{-- =========================================================
    REGISTRATION FORM
    ========================================================= --}}
    <section class="max-w-4xl mx-auto" id="register-form">

        {{-- Section heading --}}
        <div class="text-center mb-10 md:mb-12">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                        bg-secondary-fixed-dim/40 mb-4">
                <span class="material-symbols-outlined text-base text-secondary">app_registration</span>
                <span class="font-label-sm text-label-sm text-secondary font-semibold">
                    Get started
                </span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-on-background mb-3">
                Volunteer Registration
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto">
                Complete this form to initiate your onboarding. Our team reviews every application.
            </p>
        </div>

        <div class="bg-surface rounded-3xl
                    shadow-[0_12px_40px_rgba(9,22,74,0.10)]
                    border border-outline-variant/20 overflow-hidden relative">

            {{-- Top gradient strip --}}
            <div class="h-1.5 w-full bg-gradient-to-r from-primary-container via-secondary to-[#c84f0a]"></div>

            <div class="p-6 sm:p-8 md:p-12">

                @if (session('success'))
                    <div data-autodismiss class="p-5 rounded-xl
                                                  bg-success-green/10 border border-success-green/40
                                                  text-success-green font-body-md text-body-md
                                                  flex items-start gap-3">
                        <span class="material-symbols-outlined">check_circle</span>
                        {{ session('success') }}
                    </div>
                @else
                    <form action="{{ route('volunteer.apply') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        @if ($errors->any())
                            <div class="p-4 rounded-xl bg-error-container text-on-error-container
                                        border border-error/30 font-label-sm text-label-sm space-y-1">
                                <strong class="block">Please fix the highlighted fields:</strong>
                                @foreach ($errors->all() as $err)
                                    <p>• {{ $err }}</p>
                                @endforeach
                            </div>
                        @endif

                        {{-- Personal details --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-sm text-label-sm text-on-background" for="full_name">Full Name *</label>
                                <input class="rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm transition-colors"
                                       id="full_name" name="full_name" placeholder="Jane Doe"
                                       value="{{ old('full_name') }}" required type="text"/>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-sm text-label-sm text-on-background" for="dob">Date of Birth *</label>
                                <input class="rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm transition-colors"
                                       id="dob" name="dob" value="{{ old('dob') }}" required type="date"/>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="photo">
                                Profile Photo *
                                <span class="text-on-surface-variant font-normal">(used on your official ID card)</span>
                            </label>
                            <input id="photo" name="photo" type="file" accept="image/*" required
                                   class="block w-full text-sm rounded-xl border border-dashed border-outline-variant/60 p-3
                                          file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0
                                          file:bg-surface-container-low file:text-primary-container
                                          file:font-semibold hover:file:bg-surface-container-high
                                          hover:border-secondary/40 transition-colors cursor-pointer"/>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-sm text-label-sm text-on-background" for="gender">Gender *</label>
                                <select class="rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 transition-colors"
                                        id="gender" name="gender" required>
                                    <option value="">Select…</option>
                                    @foreach (['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $v => $l)
                                        <option value="{{ $v }}" @selected(old('gender') === $v)>{{ $l }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-sm text-label-sm text-on-background" for="blood_group">Blood Group</label>
                                <select class="rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 transition-colors"
                                        id="blood_group" name="blood_group">
                                    <option value="">Select…</option>
                                    @foreach (['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
                                        <option value="{{ $bg }}" @selected(old('blood_group') === $bg)>{{ $bg }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-sm text-label-sm text-on-background" for="mobile">Mobile Number *</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-on-surface-variant">+91</span>
                                    <input class="rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 pl-12 pr-4 py-3 w-full shadow-sm transition-colors"
                                           id="mobile" name="mobile" placeholder="98765 43210"
                                           value="{{ old('mobile') }}" required type="tel"/>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="email">Email Address *</label>
                            <input class="rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm transition-colors"
                                   id="email" name="email" placeholder="jane.doe@example.com"
                                   value="{{ old('email') }}" required type="email"/>
                        </div>

                        {{-- Address --}}
                        <fieldset class="border border-outline-variant/40 rounded-xl p-5 pt-4">
                            <legend class="font-label-sm text-label-sm font-semibold text-on-background px-2">Address *</legend>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <textarea class="md:col-span-3 rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 transition-colors"
                                          name="address" rows="2" placeholder="House / street / area *" required>{{ old('address') }}</textarea>
                                <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 transition-colors"
                                       name="city" placeholder="City *" value="{{ old('city') }}" required type="text"/>
                                <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 transition-colors"
                                       name="state" placeholder="State *" value="{{ old('state') }}" required type="text"/>
                                <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 transition-colors"
                                       name="pincode" placeholder="PIN code *" value="{{ old('pincode') }}"
                                       required inputmode="numeric" pattern="[0-9]{6}" title="6-digit PIN code"/>
                            </div>
                        </fieldset>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-sm text-label-sm text-on-background" for="education">Education Qualification</label>
                                <input class="rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm transition-colors"
                                       id="education" name="education" placeholder="e.g. B.Tech, Class 12…"
                                       value="{{ old('education') }}" type="text"/>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-sm text-label-sm text-on-background" for="occupation">Occupation</label>
                                <input class="rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm transition-colors"
                                       id="occupation" name="occupation" placeholder="e.g. Student, Teacher…"
                                       value="{{ old('occupation') }}" type="text"/>
                            </div>
                        </div>

                        {{-- Areas of interest --}}
                        <div class="flex flex-col gap-2 pt-2">
                            <label class="font-label-sm text-label-sm text-on-background mb-1">
                                Areas of Interest *
                                <span class="text-on-surface-variant font-normal">(choose any)</span>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach ([
                                    ['education', 'Education / Teaching'],
                                    ['health_camps', 'Health Camps'],
                                    ['fundraising', 'Fundraising'],
                                    ['event_management', 'Event Management'],
                                    ['social_media', 'Social Media'],
                                    ['environment', 'Environment'],
                                    ['distribution_drives', 'Distribution Drives'],
                                    ['others', 'Others']
                                ] as [$value, $label])
                                    <label class="relative flex cursor-pointer rounded-xl border
                                                  {{ old('areas_of_interest') && in_array($value, old('areas_of_interest'))
                                                        ? 'border-primary-container ring-1 ring-primary-container/30 bg-surface-container-low'
                                                        : 'border-outline-variant/40 bg-surface' }}
                                                  p-4 shadow-sm hover:bg-surface-container-low
                                                  hover:border-secondary/40 transition-all">
                                        <input class="sr-only peer" name="areas_of_interest[]" type="checkbox"
                                               value="{{ $value }}"
                                               onchange="this.closest('label').classList.toggle('border-primary-container', this.checked); this.closest('label').classList.toggle('ring-1', this.checked); this.closest('label').classList.toggle('ring-primary-container/30', this.checked)"
                                               @checked(old('areas_of_interest') && in_array($value, old('areas_of_interest')))/>
                                        <div class="flex items-center gap-3">
                                            <div class="w-5 h-5 rounded-full border border-outline-variant
                                                        peer-checked:border-[7px] peer-checked:border-primary-container
                                                        transition-all flex-shrink-0"></div>
                                            <span class="font-body-md text-body-md text-on-background">{{ $label }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-sm text-label-sm text-on-background" for="availability">Availability *</label>
                                <select class="rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 transition-colors"
                                        id="availability" name="availability" required>
                                    <option value="">Select…</option>
                                    @foreach (['full_time' => 'Full-time', 'part_time' => 'Part-time', 'weekends' => 'Weekends only', 'occasional' => 'Occasional'] as $v => $l)
                                        <option value="{{ $v }}" @selected(old('availability') === $v)>{{ $l }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-sm text-label-sm text-on-background">
                                    Emergency Contact — Name & Phone *
                                </label>
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <input class="w-full sm:w-1/2 rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm transition-colors"
                                           name="emergency_contact_name" placeholder="Name *"
                                           value="{{ old('emergency_contact_name') }}" required type="text"/>
                                    <input class="w-full sm:w-1/2 rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm transition-colors"
                                           name="emergency_contact_phone" placeholder="Phone *"
                                           value="{{ old('emergency_contact_phone') }}" required type="tel"/>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="experience">Previous Volunteering Experience</label>
                            <textarea class="rounded-xl border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 transition-colors"
                                      id="experience" name="experience" rows="3"
                                      placeholder="Optional — tell us where you've volunteered before…">{{ old('experience') }}</textarea>
                        </div>

                        {{-- ID proof --}}
                        <div class="flex flex-col gap-1.5 pt-2">
                            <label class="font-label-sm text-label-sm text-on-background">
                                Upload ID Proof (Aadhaar / PAN / College ID) *
                            </label>
                            <p class="text-xs text-on-surface-variant mb-2">
                                Required for issuing your official volunteer ID card. Kept private & secure. Max size 2MB.
                            </p>
                            <div class="mt-1 flex justify-center rounded-xl border border-dashed border-outline-variant/80
                                        px-6 py-8 hover:bg-surface-container-low hover:border-secondary/50
                                        transition-colors cursor-pointer group">
                                <div class="text-center">
                                    <span class="material-symbols-outlined text-4xl text-outline-variant
                                                 group-hover:text-secondary transition-colors mb-2">cloud_upload</span>
                                    <div class="mt-2 flex text-sm leading-6 text-on-surface-variant justify-center">
                                        <label class="relative cursor-pointer rounded-md font-label-sm text-label-sm
                                                      text-primary-container font-semibold hover:text-secondary transition-colors"
                                               for="id_proof">
                                            <span>Upload a file</span>
                                            <input class="sr-only" id="id_proof" name="id_proof" type="file"
                                                   accept=".jpg,.jpeg,.png,.pdf" required/>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-on-surface-variant mt-1">PNG, JPG or PDF up to 2MB</p>
                                </div>
                            </div>
                        </div>

                        {{-- Consent --}}
                        <label class="flex items-start gap-3 pt-2 cursor-pointer
                                      p-4 rounded-xl border border-outline-variant/30
                                      hover:bg-surface-container-low transition-colors">
                            <input type="checkbox" name="consent" value="1" required
                                   class="mt-1 rounded border-outline-variant text-primary-container focus:ring-primary-container/30"/>
                            <span class="font-body-md text-body-md text-on-surface-variant text-sm">
                                I agree to the terms & conditions and code of conduct of Hum Hain Na Foundation,
                                and confirm that the information provided is true.*
                            </span>
                        </label>

                        <div class="pt-4">
                            <button class="w-full bg-[#c84f0a] text-white font-label-sm text-label-sm
                                           py-4 rounded-xl shadow-[0_8px_24px_rgba(200,79,10,0.25)]
                                           hover:bg-[#b74406] hover:-translate-y-0.5
                                           transition-all flex items-center justify-center gap-2 text-base font-semibold"
                                    type="submit">
                                Submit Registration
                                <span class="material-symbols-outlined text-xl">how_to_reg</span>
                            </button>
                            <p class="text-center text-xs text-on-surface-variant mt-4">
                                Already applied? Once approved,
                                <a class="underline hover:text-primary-container" href="{{ route('login') }}">log in to your dashboard</a>.
                            </p>
                        </div>

                    </form>
                @endif

            </div>
        </div>
    </section>

</div>

@endsection

@push('scripts')
<script>
function checkInterest(value) {
    const cb = document.querySelector(`input[name="areas_of_interest[]"][value="${value}"]`);
    if (!cb) return;
    cb.checked = true;
    const label = cb.closest('label');
    label.classList.add('border-primary-container','ring-1','ring-primary-container/30','bg-surface-container-low');
}
</script>
@endpush