@extends('layouts.app')

@section('title', 'Verify '.($code ?? '').' | Hum Hain Na Foundation')

@php
    // Allow ?code= from the certificates page to resolve immediately
    if (!$code && request('code')) {
        $code = trim((string) request('code'));
        if (preg_match('/^HHNF-\d{4}-\d{5}$/i', $code)) {
            $volunteer = \App\Models\Volunteer::whereRaw('LOWER(volunteer_id) = ?', [strtolower($code)])->first();
            $type = 'volunteer';
        } else {
            $certificate = \App\Models\Certificate::where('certificate_number', $code)->first();
            $type = 'certificate';
        }
    }
@endphp

@section('content')
<section class="max-w-2xl mx-auto px-margin-mobile pb-section-gap-lg">
    <a href="{{ route('certificates.info') }}" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container hover:text-secondary transition-colors mb-8"><span class="material-symbols-outlined text-sm">arrow_back</span> Certificates & Verification</a>

    <h1 class="font-headline-lg text-headline-lg text-on-background mb-2">Verification Result</h1>

    @if (isset($code))
        <p class="font-mono-id text-mono-id text-base tracking-wider text-on-surface-variant mb-10">{{ $code }}</p>

        @if (($type ?? '') === 'volunteer')
            @if (!empty($volunteer))
                <div class="rounded-2xl overflow-hidden border-2 border-success-green/60 shadow-[0_8px_24px_rgba(16,185,129,0.15)]">
                    <div class="bg-success-green/15 p-6 flex items-center gap-3 border-b border-success-green/20">
                        <span class="material-symbols-outlined text-success-green text-3xl">verified</span>
                        <div>
                            <p class="font-headline-md !text-lg text-success-green">Genuine Volunteer ID</p>
                            <p class="font-label-sm text-label-sm text-on-surface-variant">This volunteer is registered with Hum Hain Na Foundation</p>
                        </div>
                    </div>
                    <div class="bg-surface p-6 grid grid-cols-1 sm:grid-cols-[auto,1fr] gap-6 items-center">
                        @if ($volunteer->photo_path)
                            <img src="{{ asset('storage/'.$volunteer->photo_path) }}" alt="{{ $volunteer->full_name }}" class="w-24 h-24 rounded-full object-cover border-4 border-surface-container-low shadow"/>
                        @endif
                        <dl class="space-y-2">
                            <dt class="font-label-sm text-label-sm text-on-surface-variant">Name<dd class="font-headline-md !text-xl text-on-background">{{ $volunteer->full_name }}</dd></dt>
                            <div class="grid grid-cols-2 gap-x-6 gap-y-2 pt-1">
                                <dt class="font-label-sm text-label-sm text-on-surface-variant">Volunteer ID<dd class="font-mono-id text-mono-id">{{ $volunteer->volunteer_id }}</dd></dt>
                                <dt class="font-label-sm text-label-sm text-on-surface-variant">Status<dd class="font-label-sm text-label-sm"><span class="inline-flex px-3 py-0.5 rounded-full bg-success-green/10 text-success-green border border-success-green/30">Active</span></dd></dt>
                                @if ($volunteer->valid_till)<dt class="font-label-sm text-label-sm text-on-surface-variant">Valid Till<dd>{{ $volunteer->valid_till->format('M Y') }}</dd></dt>@endif
                            </div>
                        </dl>
                    </div>
                </div>
            @else
                <div class="rounded-2xl border-2 border-danger-red/50 p-8 text-center bg-error-container/40">
                    <span class="material-symbols-outlined text-danger-red text-4xl">gpp_bad</span>
                    <p class="font-headline-md !text-xl text-on-background mt-3">No volunteer found with this ID</p>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-1">The ID may be fake or mistyped. Please double-check the code.</p>
                </div>
            @endif
        @else
            @if (!empty($certificate))
                <div class="rounded-2xl overflow-hidden border-2 border-success-green/60 shadow-[0_8px_24px_rgba(16,185,129,0.15)]">
                    <div class="bg-success-green/15 p-6 flex items-center gap-3 border-b border-success-green/20">
                        <span class="material-symbols-outlined text-success-green text-3xl">workspace_premium</span>
                        <div>
                            <p class="font-headline-md !text-lg text-success-green">Genuine Certificate</p>
                            <p class="font-label-sm text-label-sm text-on-surface-variant">Issued by Hum Hain Na Foundation</p>
                        </div>
                    </div>
                    <div class="bg-surface p-6 space-y-2">
                        <p class="font-label-sm text-label-sm text-on-surface-variant">Issued to</p>
                        <p class="font-headline-md !text-2xl text-on-background">{{ $certificate->recipient_name }}</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 pt-2">
                            <p class="font-label-sm text-label-sm text-on-surface-variant">Type <dd class="font-body-md text-body-md text-on-background">{{ \App\Models\Certificate::TYPES[$certificate->type] ?? ucfirst($certificate->type) }}</dd></p>
                            @if ($certificate->reason)<p class="font-label-sm text-label-sm text-on-surface-variant">For <dd class="font-body-md text-body-md text-on-background">{{ $certificate->reason }}</dd></p>@endif
                            @if ($certificate->duration)<p class="font-label-sm text-label-sm text-on-surface-variant">Duration <dd class="font-body-md text-body-md text-on-background">{{ $certificate->duration }}</dd></p>@endif
                            <p class="font-label-sm text-label-sm text-on-surface-variant">Issued on <dd class="font-body-md text-body-md text-on-background">{{ $certificate->issued_on->format('d M Y') }}</dd></p>
                        </div>
                    </div>
                </div>
            @elseif (str_starts_with($code, 'HHNF-RCP-'))
                <div class="rounded-2xl border-2 border-outline-variant/40 p-8 text-center bg-surface-container-low">
                    <span class="material-symbols-outlined text-primary-container text-4xl">receipt_long</span>
                    <p class="font-headline-md !text-lg text-on-background mt-3">Donation receipt reference detected</p>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-1">Receipt verification for {{ $code }} will appear once the payment has been confirmed by our team.</p>
                </div>
            @else
                <div class="rounded-2xl border-2 border-danger-red/50 p-8 text-center bg-error-container/40">
                    <span class="material-symbols-outlined text-danger-red text-4xl">gpp_bad</span>
                    <p class="font-headline-md !text-xl text-on-background mt-3">Certificate not found</p>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-1">This certificate number does not exist in our records. Beware of fraudulent documents.</p>
                </div>
            @endif
        @endif
    @endif

    <form method="GET" action="{{ route('verify.form') }}" class="mt-10 flex gap-3">
        <input name="code" required placeholder="Try another code" class="flex-grow rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 font-mono-id text-mono-id uppercase"/>
        <button class="border border-outline bg-surface text-on-background font-label-sm text-label-sm px-6 rounded-lg hover:bg-surface-variant transition-colors">Verify</button>
    </form>
</section>
@endsection
