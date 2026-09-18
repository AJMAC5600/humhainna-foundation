@extends('layouts.app')

@section('title', 'Our Work — Photo Gallery | Hum Hain Na Foundation')

@section('content')

{{-- =========================================================
HERO
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
                    Photo Gallery · Real Impact Stories
                </span>
            </div>

            <h1 class="font-bold text-[#102957] tracking-[-0.045em] leading-[0.94] text-[26px] mb-2.5">
                <span class="block">Our</span>
                <span class="relative inline-block text-[#c84f0a]">
                    Work
                    <svg class="absolute left-0 -bottom-0.5 w-full h-[3px]" viewBox="0 0 220 9" fill="none"
                        preserveAspectRatio="none" aria-hidden="true">
                        <path d="M3 6.5C55 2 155 2 217 6" stroke="#c84f0a" stroke-width="3" stroke-linecap="round" />
                    </svg>
                </span>
            </h1>

            <p class="max-w-[340px] mx-auto text-[11px] leading-[1.35] text-slate-700">
                Albums from our events, campaigns and drives —
                proof of every hour our community puts in.
            </p>

        </div>

        <img src="{{ asset('images/hero-banner-mobile.png') }}"
             alt="Hum Hain Na Foundation — Our Work"
             class="block w-full h-auto object-contain select-none pointer-events-none"
             loading="eager" draggable="false">
    </div>

    {{-- TABLET + DESKTOP --}}
    <div class="hidden sm:block relative w-full">
        <img src="{{ asset('images/hero-banner.png') }}"
             alt="Hum Hain Na Foundation — Our Work"
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
                            Photo Gallery · Real Impact Stories
                        </span>
                    </div>

                    <h1 class="font-bold text-[#102957] tracking-[-0.045em] leading-[0.94]
                               text-[20px] md:text-[28px] lg:text-[42px] xl:text-[56px] 2xl:text-[68px]
                               mb-1.5 md:mb-2.5 lg:mb-4">
                        <span class="block">Our</span>
                        <span class="relative inline-block text-[#c84f0a]">
                            Work
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
                              text-slate-700">
                        Albums from our events, campaigns and drives —
                        proof of every hour our community puts in.
                    </p>

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
            space-y-8 md:space-y-10">

    {{-- =========================================================
    FILTER BAR
    ========================================================= --}}
    <form method="GET"
          class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-3
                 bg-surface-container-low rounded-2xl
                 p-4 md:p-5
                 border border-outline-variant/30">

        <div class="grid grid-cols-2 sm:flex gap-3 sm:gap-3 flex-1">
            <select name="category"
                    class="rounded-lg border-outline-variant/50 bg-surface
                           px-3 sm:px-4 py-2.5
                           font-label-sm text-label-sm
                           focus:border-primary-container focus:ring-primary-container/20 capitalize
                           w-full sm:w-auto min-w-0">
                <option value="">All categories</option>
                @foreach ($categories as $cat)
                    @if ($cat)
                        <option value="{{ $cat }}" @selected($activeCategory === $cat)>
                            {{ ucfirst(str_replace('_', ' ', $cat)) }}
                        </option>
                    @endif
                @endforeach
            </select>

            <select name="year"
                    class="rounded-lg border-outline-variant/50 bg-surface
                           px-3 sm:px-4 py-2.5
                           font-label-sm text-label-sm
                           focus:border-primary-container focus:ring-primary-container/20
                           w-full sm:w-auto min-w-0">
                <option value="">All years</option>
                @foreach ($years as $y)
                    <option value="{{ $y }}" @selected(request('year') == $y)>{{ $y }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-3">
            <button class="flex-1 sm:flex-none
                           bg-primary-container text-on-primary
                           font-label-sm text-label-sm
                           px-5 sm:px-6 py-2.5 rounded-lg
                           hover:bg-on-background transition-colors">
                Filter
            </button>

            @if (request()->hasAny(['category', 'year']))
                <a href="{{ route('gallery.index') }}"
                   class="font-label-sm text-label-sm text-on-surface-variant
                          hover:text-secondary underline whitespace-nowrap">
                    Reset
                </a>
            @endif
        </div>

    </form>

    {{-- =========================================================
    ALBUM GRID
    ========================================================= --}}
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">

            @forelse ($albums as $album)
                <a href="{{ route('gallery.show', $album) }}"
                   class="group bg-surface rounded-2xl overflow-hidden
                          shadow-[0_2px_8px_rgba(9,22,74,0.06)]
                          border border-outline-variant/20
                          hover:shadow-[0_8px_24px_rgba(9,22,74,0.12)]
                          hover:-translate-y-1
                          transition-all duration-300 flex flex-col">

                    <div class="aspect-[4/3] relative overflow-hidden bg-surface-variant">
                        @if ($album->cover_path)
                            <img src="{{ asset('storage/'.$album->cover_path) }}"
                                 alt="{{ $album->title }}"
                                 loading="lazy"
                                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-surface-variant">
                                <span class="material-symbols-outlined text-4xl text-outline-variant">image</span>
                            </div>
                        @endif

                        @if ($album->category)
                            <div class="absolute top-3 left-3 sm:top-4 sm:left-4
                                        bg-surface/90 backdrop-blur-sm
                                        px-2.5 sm:px-3 py-1 rounded-full
                                        border border-outline-variant/30
                                        font-label-sm text-label-sm text-[10px] sm:text-xs capitalize">
                                {{ str_replace('_', ' ', $album->category) }}
                            </div>
                        @endif

                        {{-- Photo count pill --}}
                        <div class="absolute bottom-3 right-3 sm:bottom-4 sm:right-4
                                    bg-[#102957]/85 backdrop-blur-sm text-white
                                    px-2.5 py-1 rounded-full
                                    text-[10px] sm:text-xs font-semibold
                                    flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px] sm:text-[14px]">photo_library</span>
                            {{ $album->photos_count }}
                        </div>
                    </div>

                    <div class="p-5 sm:p-6 flex flex-col flex-grow">
                        <h2 class="font-headline-md text-headline-md !text-lg sm:!text-xl
                                   text-on-background mb-2
                                   line-clamp-2">
                            {{ $album->title }}
                        </h2>

                        <p class="font-label-sm text-label-sm text-on-surface-variant
                                  flex items-center gap-1.5 mb-3 text-xs sm:text-sm">
                            <span class="material-symbols-outlined text-base">calendar_month</span>
                            {{ optional($album->date)->format('d M Y') }}
                        </p>

                        @if ($album->description)
                            <p class="font-body-md text-body-md text-on-surface-variant
                                      text-sm leading-relaxed flex-grow
                                      line-clamp-3">
                                {{ Str::limit($album->description, 120) }}
                            </p>
                        @endif

                        <div class="mt-4 pt-4 border-t border-outline-variant/20
                                    flex items-center justify-between">
                            <span class="font-label-sm text-label-sm text-secondary font-semibold
                                         group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                                View album
                                <span class="material-symbols-outlined text-base">arrow_forward</span>
                            </span>
                        </div>
                    </div>

                </a>
            @empty
                <div class="col-span-full bg-surface-container-low rounded-2xl
                            p-10 md:p-14 text-center
                            border border-outline-variant/30">
                    <div class="w-16 h-16 rounded-full bg-surface-container-high mx-auto
                                flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-3xl text-outline-variant">photo_library</span>
                    </div>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">
                        No albums published yet. Check back soon!
                    </p>
                </div>
            @endforelse

        </div>

        <div class="mt-10 md:mt-12">{{ $albums->links() }}</div>
    </div>

</div>

@endsection