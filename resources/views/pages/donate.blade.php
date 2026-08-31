@extends('layouts.app')

@section('title', 'Donate | Hum Hain Na Foundation')

@php($settings = \App\Models\Setting::allCached())
@php($upiId = $settings['upi_id'] ?? null)

@section('content')
{{-- Hero (Stitch screen) --}}
<section class="grid grid-cols-1 lg:grid-cols-2 gap-gutter mb-section-gap-sm items-center max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
    <div class="space-y-6">
        <div class="inline-flex items-center gap-2 bg-surface-container-low px-4 py-2 rounded-full shadow-[0_2px_8px_rgba(9,22,74,0.05)] border border-surface-container-high">
            <span class="material-symbols-outlined text-secondary-container text-sm">favorite</span>
            <span class="font-label-sm text-label-sm text-on-surface-variant">Your contribution saves lives</span>
        </div>
        <h1 class="font-display-lg text-display-lg text-primary">Make an <span class="text-secondary">Impact</span> Today.</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant">
            Every rupee you donate goes directly towards providing essential resources, education, and healthcare to those who need it most. Join our mission of transparency and compassion.
        </p>
        <div class="flex items-center gap-4 p-4 bg-surface-container rounded-xl border border-surface-container-high w-fit">
            <span class="material-symbols-outlined text-success-green text-3xl">verified</span>
            <div>
                <p class="font-label-sm text-label-sm font-semibold">{{ $settings['tax_note_80g'] ? '80G Tax Exemption' : 'Transparent Giving' }}</p>
                <p class="font-label-sm text-label-sm text-on-surface-variant">{{ $settings['tax_note_80g'] ?? 'Regular utilization reports show exactly where every donation goes.' }}</p>
            </div>
        </div>
    </div>
    <div class="rounded-2xl overflow-hidden shadow-[0_8px_24px_rgba(9,22,74,0.08)] relative h-[320px] lg:h-[440px] bg-gradient-to-br from-primary-container via-surface-tint to-secondary">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 16px 16px;"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary-container/80 to-transparent flex items-end p-6">
            <p class="text-on-primary font-headline-md text-headline-md">Over 50,000 lives touched.</p>
        </div>
    </div>
</section>

@if (session('donation_success'))
    @php($d = session('donation'))
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-sm">
        <div class="bg-success-green/10 border border-success-green/40 rounded-xl p-6 md:p-8 space-y-3">
            <h2 class="font-headline-lg !text-xl text-success-green flex items-center gap-2"><span class="material-symbols-outlined">task_alt</span> Donation pledge recorded — thank you!</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Please complete the payment using UPI or bank transfer below. Reference your tracking number:</p>
            <p class="font-mono-id text-mono-id text-base tracking-wider bg-surface px-3 py-1.5 rounded-lg w-fit border border-outline-variant/40">{{ data_get($d, 'id') }}</p>
            @if ($upiId)
                <a href="{{ route('donate.show') }}" class="hidden"></a>
                <p class="font-body-md text-body-md text-on-surface-variant">Pay <strong>₹{{ number_format((float) data_get($d, 'amount')) }}</strong> to UPI ID <strong>{{ $upiId }}</strong> and our team will confirm your receipt within 24–48 hours of receiving the payment.</p>
            @endif
        </div>
    </section>
@endif

<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop grid grid-cols-1 lg:grid-cols-5 gap-gutter pb-section-gap-lg">

    {{-- Donation form --}}
    <div class="lg:col-span-3 bg-surface rounded-2xl shadow-[0_8px_30px_rgba(9,22,74,0.08)] border border-outline-variant/20 overflow-hidden">
        <div class="h-2 w-full bg-gradient-to-r from-primary-container via-surface-tint to-secondary"></div>
        <form action="{{ route('donate.store') }}" method="POST" id="donate-form" class="p-6 md:p-10 space-y-6">
            @csrf

            {{-- Amount presets --}}
            <div class="flex flex-col gap-3">
                <label class="font-label-sm text-label-sm text-on-background font-semibold">Choose an amount *</label>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3" id="presets">
                    @foreach ([500 => ['meal', 'Feeds a family for a week'], 1000 => ['school', 'School kit for 2 children'], 2500 => ['health', 'Sponsors a health camp'], 5000 => ['volunteer_activism', 'Funds a full drive']] as $amt => [$icon, $desc])
                        <button type="button" data-amount="{{ $amt }}"
                            onclick="pickAmount({{ $amt }}, this)"
                            class="preset-btn group rounded-xl border {{ old('amount') == $amt ? '' : 'border-outline-variant/40' }} bg-surface p-4 text-center hover:border-primary-container transition-all focus:outline-none {{ old('amount') == $amt ? 'preset-active' : '' }}">
                            <span class="material-symbols-outlined text-primary-container">{{ $icon }}</span>
                            <span class="block font-headline-md font-bold text-on-background mt-1">₹{{ number_format($amt) }}</span>
                            <span class="block font-label-sm text-label-xs text-on-surface-variant text-[11px] leading-tight mt-1">{{ $desc }}</span>
                        </button>
                    @endforeach
                </div>
                <input type="number" name="amount" id="amount" min="10" step="1" placeholder="Or enter custom amount ₹ *" required
                    value="{{ old('amount') }}"
                    class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 font-mono-id text-lg"/>
            </div>

            {{-- Frequency --}}
            <div class="flex flex-col gap-2">
                <span class="font-label-sm text-label-sm text-on-background font-semibold">Donation type *</span>
                <div class="flex gap-3">
                    <label class="flex items-center gap-2 border border-outline-variant/40 rounded-lg px-4 py-3 cursor-pointer has-checked:border-primary-container has-checked:bg-surface-container-low flex-1">
                        <input type="radio" name="frequency" value="one_time" checked class="accent-[#09164a]"/> <span class="font-label-sm text-label-sm">One-time</span>
                    </label>
                    <label class="flex items-center gap-2 border border-outline-variant/40 rounded-lg px-4 py-3 cursor-pointer has-checked:border-primary-container has-checked:bg-surface-container-low flex-1">
                        <input type="radio" name="frequency" value="monthly" class="accent-[#09164a]"/> <span class="font-label-sm text-label-sm">Monthly</span>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm text-label-sm text-on-background" for="donor_name">Full Name *</label>
                    <input id="donor_name" name="donor_name" required value="{{ old('donor_name') }}" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm"/>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm text-label-sm text-on-background" for="mobile">Mobile Number *</label>
                    <input id="mobile" name="mobile" required value="{{ old('mobile') }}" inputmode="tel" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm"/>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm text-label-sm text-on-background" for="email">Email * <span class="text-on-surface-variant font-normal">(for receipt)</span></label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm"/>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm text-label-sm text-on-background" for="pan">PAN Number <span class="text-on-surface-variant font-normal">(for 80G receipt)</span></label>
                    <input id="pan" name="pan" placeholder="ABCDE1234F" value="{{ old('pan') }}" pattern="[A-Za-z]{5}[0-9]{4}[A-Za-z]" title="Format: ABCDE1234F" style="text-transform: uppercase" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm"/>
                </div>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="cause">Donate for a cause</label>
                <select id="cause" name="cause" class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 capitalize">
                    <option value="">Where it's needed most</option>
                    @foreach (['education','health','environment','relief','women empowerment','fundraising'] as $c)
                        <option value="{{ $c }}" @selected(old('cause') === $c)>{{ ucfirst($c) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="w-full bg-primary-container text-on-primary py-4 rounded-lg hover:bg-on-background transition-all flex items-center justify-center gap-2 font-label-sm text-label-sm text-base shadow-sm">
                Proceed with this Pledge <span class="material-symbols-outlined">arrow_forward</span>
            </button>
            <p class="text-xs text-on-surface-variant text-center -mt-2">You'll receive payment instructions instantly. A PDF receipt is emailed once payment is confirmed.</p>
        </form>
    </div>

    {{-- Payment methods sidebar --}}
    <aside class="lg:col-span-2 space-y-gutter">
        @if ($upiId)
            <div class="bg-surface rounded-xl border border-outline-variant/30 shadow-sm p-6 text-center">
                <h3 class="font-headline-md text-headline-md !text-lg text-on-background mb-1 flex items-center justify-center gap-2"><span class="material-symbols-outlined text-primary-container">qr_code_2</span> Scan & Pay via UPI</h3>
                <p class="font-label-sm text-label-sm text-on-surface-variant mb-4">Any UPI app · GPay · PhonePe · Paytm</p>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data={{ urlencode('upi://pay?pa='.urlencode($upiId).'&pn='.urlencode($settings['org_short_name'] ?? 'HHNF').'&cu=INR') }}"
                     alt="UPI QR Code" width="200" height="200"
                     class="mx-auto rounded-xl border border-outline-variant/40 p-2 bg-white"/>
                <div class="mt-4 flex items-center justify-center gap-2 bg-surface-container-low rounded-lg px-3 py-2.5">
                    <code class="font-mono-id text-mono-id text-on-background truncate">{{ $upiId }}</code>
                    <button type="button" onclick="copyUpi(this)" aria-label="Copy UPI ID" class="text-primary-container hover:text-secondary transition-colors"><span class="material-symbols-outlined text-lg">content_copy</span></button>
                </div>
            </div>
        @endif

        <div class="bg-surface rounded-xl border border-outline-variant/30 shadow-sm p-6">
            <h3 class="font-headline-md text-headline-md !text-lg text-on-background mb-4 flex items-center gap-2"><span class="material-symbols-outlined text-primary-container">account_balance</span> Bank Transfer / NEFT</h3>
            <dl class="space-y-3">
                @foreach ([['Account Name', $settings['bank_account_name']], ['Account Number', $settings['bank_account_number']], ['IFSC Code', $settings['bank_ifsc']], ['Bank & Branch', $settings['bank_name_branch']]] as [$label, $value])
                    <div class="flex justify-between items-start gap-4 border-b border-outline-variant/20 pb-2 last:border-0 last:pb-0">
                        <dt class="font-label-sm text-label-sm text-on-surface-variant shrink-0">{{ $label }}</dt>
                        <dd class="font-body-md text-body-md text-sm text-on-background font-medium text-right">{{ $value ?? '—' }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>

        <div class="bg-surface-container-low rounded-xl border border-outline-variant/30 p-6">
            <h3 class="font-headline-md text-headline-md !text-lg text-on-background mb-2 flex items-center gap-2"><span class="material-symbols-outlined text-success-green">fact_check</span> Fund Utilization</h3>
            <p class="font-body-md text-body-md text-on-surface-variant text-sm">{!! nl2br(e($settings['fund_utilization_note'] ?? 'We publish regular reports on how donations are used — education kits delivered, camps conducted, meals distributed. Transparency is our promise.')) !!}</p>
        </div>

        @if ($settings['tax_note_80g'])
            <div class="bg-surface-variant/60 rounded-xl border border-outline-variant/30 p-6 flex items-start gap-3">
                <span class="material-symbols-outlined text-success-green">verified</span>
                <p class="font-label-sm text-label-sm text-on-background">{!! nl2br(e($settings['tax_note_80g'])) !!}</p>
            </div>
        @endif
    </aside>
</section>

@if ($settings['social_youtube'] || true)
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pb-section-gap-lg hidden"></section>
@endif
@endsection

@push('scripts')
<script>
function pickAmount(amt, btn) {
    document.getElementById('amount').value = amt;
    document.querySelectorAll('.preset-btn').forEach(b => b.classList.remove('border-primary-container', 'ring-2', 'ring-primary-container/20'));
    btn.classList.add('border-primary-container', 'ring-2', 'ring-primary-container/20');
}
function copyUpi(btn) {
    const upi = btn.parentElement.querySelector('code').textContent.trim();
    navigator.clipboard.writeText(upi).then(() => {
        btn.innerHTML = '<span class="material-symbols-outlined text-lg text-success-green">check</span>';
        setTimeout(() => { btn.innerHTML = '<span class="material-symbols-outlined text-lg">content_copy</span>'; }, 2000);
    });
}
document.getElementById('amount').addEventListener('input', () => {
    document.querySelectorAll('.preset-btn').forEach(b => b.classList.remove('border-primary-container', 'ring-2', 'ring-primary-container/20'));
});
</script>
@endpush
