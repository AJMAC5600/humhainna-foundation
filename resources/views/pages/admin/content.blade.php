@extends('layouts.admin')

@section('title', 'Site Content')

@section('content')
<header>
    <h1 class="font-headline-lg text-headline-lg text-on-background">Site Content & Settings</h1>
    <p class="font-body-md text-body-md text-on-surface-variant mt-1">Edit website text, contact info, donation details and social links — no developer needed.</p>
</header>

<form method="POST" action="{{ route('admin.content.update') }}" enctype="multipart/form-data" class="space-y-gutter max-w-4xl">
    @csrf
    @method('PUT')

    @if ($errors->any())
        <div class="p-4 rounded-lg bg-error-container border border-error/30 font-label-sm text-label-sm">{{ $errors->first() }}</div>
    @endif

    @php
        $groups = [
            'Organization' => [
                'org_name' => ['Organization Name', 'text'],
                'org_short_name' => ['Short Name (on UPI QR)', 'text'],
                'org_tagline' => ['Tagline / About intro', 'textarea'],
                'reg_number' => ['NGO Registration Number', 'text'],
            ],
            'Homepage' => [
                'hero_title' => ['Hero Title', 'text'],
                'hero_subtitle' => ['Hero Subtitle', 'textarea'],
                'footer_note' => ['Footer Note', 'text'],
            ],
            'Homepage Images' => [
                'hero_banner' => ['Hero Banner (Desktop) — 1920x ~600px', 'image'],
                'hero_banner_mobile' => ['Hero Banner (Mobile) — 800x ~900px', 'image'],
            ],
            'About Us' => [
                'mission' => ['Mission', 'textarea'],
                'vision' => ['Vision', 'textarea'],
                'story' => ['Our Story', 'textarea'],
                'core_values' => ['Core Values (one per line: "Name — description")', 'textarea'],
            ],
            'Contact Details' => [
                'address' => ['Office Address', 'textarea'],
                'phone' => ['Phone', 'text'],
                'helpline' => ['Helpline', 'text'],
                'email' => ['Email', 'text'],
                'office_hours' => ['Office Hours', 'text'],
                'map_link' => ['Google Maps Embed URL', 'text'],
            ],
            'Donations' => [
                'upi_id' => ['UPI ID (shows QR on donate page)', 'text'],
                'bank_account_name' => ['Bank Account Name', 'text'],
                'bank_account_number' => ['Account Number', 'text'],
                'bank_ifsc' => ['IFSC Code', 'text'],
                'bank_name_branch' => ['Bank Name & Branch', 'text'],
                'tax_note_80g' => ['80G Tax Exemption Note', 'textarea'],
                'fund_utilization_note' => ['Fund Utilization Note', 'textarea'],
            ],
            'Social Media' => [
                'social_facebook' => ['Facebook URL', 'text'],
                'social_instagram' => ['Instagram URL', 'text'],
                'social_twitter' => ['Twitter/X URL', 'text'],
                'social_youtube' => ['YouTube URL', 'text'],
                'social_linkedin' => ['LinkedIn URL', 'text'],
                'whatsapp_number' => ['WhatsApp Number (floating chat)', 'text'],
            ],
            'Certificates' => [
                'signatory_name' => ['Default Signatory Name', 'text'],
                'signatory_designation' => ['Default Signatory Designation', 'text'],
            ],
        ];
    @endphp

    @foreach ($groups as $groupTitle => $fields)
        <div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-6">
            <h2 class="font-headline-md !text-lg text-on-background mb-gutter flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-container">{{ match($groupTitle) { 'Organization' => 'corporate_fare', 'Homepage' => 'home', 'About Us' => 'info', 'Contact Details' => 'call', 'Donations' => 'volunteer_activism', 'Social Media' => 'share', default => 'workspace_premium' } }}</span>
                {{ $groupTitle }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                @foreach ($fields as $key => [$label, $type])
                    <div class="{{ $type === 'textarea' ? 'md:col-span-2' : '' }} flex flex-col gap-1.5">
                        <label class="font-label-sm text-label-sm text-on-background" for="{{ $key }}">{{ $label }}</label>
                        @if ($type === 'textarea')
                            <textarea id="{{ $key }}" name="{{ $key }}" rows="3" class="rounded-lg border-outline-variant/50 px-4 py-3">{{ old($key, \App\Models\Setting::get($key)) }}</textarea>
                        @elseif ($type === 'image')
                            @php($cur = \App\Models\Setting::get($key))
                            @if($cur)<img src="{{ asset('storage/'.$cur) }}" class="h-20 w-auto rounded border mb-2"/>{{ $cur }}@endif
                            <input type="file" id="{{ $key }}" name="{{ $key }}" accept="image/*" class="rounded-lg border border-dashed border-outline-variant/50 px-4 py-3 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-surface-container-low file:text-primary-container"/>
                            <span class="text-xs text-on-surface-variant">Upload kare — purani image replace ho jayegi</span>
                        @else
                            <input id="{{ $key }}" name="{{ $key }}" value="{{ old($key, \App\Models\Setting::get($key)) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <button class="bg-primary-container text-on-primary font-label-sm text-label-sm px-10 py-3.5 rounded-lg hover:bg-on-background transition-colors">Save All Content</button>
</form>
@endsection
