@extends('layouts.app')

@section('title', 'Certificates & Verification | Hum Hain Na Foundation')

@section('content')
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pb-section-gap-lg">
    <div class="text-center mb-12">
        <span class="material-symbols-outlined text-primary-container text-4xl">workspace_premium</span>
        <h1 class="font-display-lg text-display-lg text-on-background mt-3 mb-3">Certificates & <span class="text-secondary">Verification</span></h1>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto">We issue Participation, Appreciation, Collaboration, Achievement and Internship certificates — each with a unique number and QR code you can verify here.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter max-w-4xl mx-auto">
        {{-- Verify --}}
        <div class="bg-surface rounded-2xl border border-outline-variant/30 shadow-sm p-8">
            <h2 class="font-headline-lg text-headline-lg !text-xl text-on-background mb-2 flex items-center gap-2"><span class="material-symbols-outlined text-success-green">verified_user</span> Verify a Certificate / ID Card</h2>
            <p class="font-body-md text-body-md text-on-surface-variant text-sm mb-6">Enter the code printed on the document or scan its QR code. Formats: <code class="font-mono-id text-xs bg-surface-container-low px-1.5 py-0.5 rounded">HHNF-2026-00123</code> (ID card) or <code class="font-mono-id text-xs bg-surface-container-low px-1.5 py-0.5 rounded">HHNF-CERT-2026-00001</code> (certificate).</p>
            <form method="GET" action="{{ route('verify.form') }}" class="flex gap-3">
                <input name="code" required placeholder="Enter code" value="{{ request('code') }}" class="flex-grow rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 font-mono-id text-mono-id uppercase"/>
                <button class="bg-primary-container text-on-primary font-label-sm text-label-sm px-6 rounded-lg hover:bg-on-background transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-base">search</span> Verify</button>
            </form>
        </div>

        {{-- Types --}}
        <div class="bg-surface-container-low rounded-2xl border border-outline-variant/30 p-8">
            <h2 class="font-headline-lg text-headline-lg !text-xl text-on-background mb-4 flex items-center gap-2"><span class="material-symbols-outlined text-secondary">card_membership</span> Certificate Types</h2>
            <ul class="space-y-3">
                @foreach (\App\Models\Certificate::TYPES as $type)
                    <li class="flex items-start gap-3 font-body-md text-body-md text-on-surface-variant text-sm">
                        <span class="material-symbols-outlined text-success-green text-lg shrink-0 mt-0.5">check_circle</span>{{ $type }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection
