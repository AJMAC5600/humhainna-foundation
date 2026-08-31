@extends('layouts.volunteer')

@section('title', 'My ID Card')

@section('content')
<header>
    <h2 class="font-headline-lg text-headline-lg text-on-background">My Volunteer ID Card</h2>
    <p class="font-body-md text-body-md text-on-surface-variant mt-2">Carry this digitally or print it. Anyone can verify its authenticity by scanning the QR code.</p>
</header>

@php($volunteer = $volunteer)
@if (! $volunteer || $volunteer->status !== 'approved')
    <div class="bg-warning-amber/10 border border-warning-amber/40 rounded-xl p-6 flex items-start gap-3 max-w-2xl">
        <span class="material-symbols-outlined text-warning-amber">lock</span>
        <p class="font-body-md text-body-md text-on-background">Your ID card becomes available once your application is approved by the Foundation team.</p>
    </div>
@else
    <div class="flex flex-col lg:flex-row gap-gutter items-start">
        {{-- Front --}}
        <div class="w-full max-w-[420px] bg-surface-container-lowest rounded-2xl shadow-lg border border-outline-variant/30 overflow-hidden">
            <div class="bg-gradient-to-r from-primary-container to-surface-tint p-5 relative">
                <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 14px 14px;"></div>
                <div class="relative flex items-center gap-3">
                    <span class="material-symbols-outlined text-white text-3xl">volunteer_activism</span>
                    <div>
                        <p class="text-white font-headline-md !text-base leading-tight">HUM HAIN NA FOUNDATION</p>
                        <p class="text-white/70 font-label-sm text-label-sm">Official Volunteer Identity Card</p>
                    </div>
                </div>
            </div>
            <div class="p-6 flex gap-5">
                @if ($volunteer->photo_path)
                    <img src="{{ asset('storage/'.$volunteer->photo_path) }}" alt="{{ $volunteer->full_name }}" class="w-24 h-28 object-cover rounded-lg border-2 border-outline-variant/30 shadow-sm"/>
                @endif
                <dl class="flex-grow space-y-1.5">
                    <dt class="font-label-sm text-label-xs text-on-surface-variant text-[11px] uppercase tracking-wider">Name</dt>
                    <dd class="font-headline-md !text-lg text-on-background font-bold">{{ $volunteer->full_name }}</dd>
                    <dt class="font-label-sm text-label-xs text-[11px] text-on-surface-variant uppercase tracking-wider pt-1">Volunteer ID</dt>
                    <dd class="font-mono-id text-mono-id text-on-background">{{ $volunteer->volunteer_id }}</dd>
                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <div><dt class="text-[11px] uppercase tracking-wider text-on-surface-variant">Blood Group</dt><dd class="text-danger-red font-bold">{{ $volunteer->blood_group ?? '—' }}</dd></div>
                        <div><dt class="text-[11px] uppercase tracking-wider text-on-surface-variant">Mobile</dt><dd class="text-on-background font-medium">{{ $volunteer->mobile }}</dd></div>
                        <div><dt class="text-[11px] uppercase tracking-wider text-on-surface-variant">Valid From</dt><dd>{{ optional($volunteer->valid_from)->format('M Y') ?? '—' }}</dd></div>
                        <div><dt class="text-[11px] uppercase tracking-wider text-on-surface-variant">Valid Till</dt><dd>{{ optional($volunteer->valid_till)->format('M Y') ?? '—' }}</dd></div>
                    </div>
                </dl>
                <img src="{{ $qr }}" alt="QR" class="w-20 h-20 self-start border border-outline-variant/40 rounded-md bg-white p-1"/>
            </div>
        </div>

        <div class="space-y-gutter max-w-sm">
            <a href="{{ route('dashboard.idcard.download') }}" class="flex items-center justify-center gap-2 w-full bg-primary-container text-on-primary rounded-lg py-4 px-8 font-label-sm text-label-sm hover:bg-on-background transition-colors">
                <span class="material-symbols-outlined">download</span> Download as PDF
            </a>
            <div class="bg-surface-container-low rounded-xl p-6 border border-outline-variant/30">
                <h3 class="font-headline-md !text-base text-on-background mb-2 flex items-center gap-2"><span class="material-symbols-outlined text-primary-container">info</span> Good to know</h3>
                <ul class="font-body-md text-on-surface-variant text-sm space-y-2 list-disc pl-4">
                    <li>Your card is valid for one year and renewable.</li>
                    <li>The QR code opens a public verification page — anyone can confirm you're a genuine volunteer.</li>
                    <li>Lost the printout? Just download it again from here anytime.</li>
                </ul>
            </div>
        </div>
    </div>
@endif
@endsection
