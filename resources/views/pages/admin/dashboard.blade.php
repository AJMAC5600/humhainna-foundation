@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<header class="flex justify-between items-end">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-background">Dashboard</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Quick overview of everything happening across the Foundation.</p>
    </div>
    <span class="font-label-sm text-label-sm text-on-surface-variant">{{ now()->format('D, d M Y') }}</span>
</header>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-gutter">
    @foreach ([
        ['Pending Volunteers', $volunteersPending, 'groups', 'warning-amber', 'admin.volunteers.index', ['status' => 'pending']],
        ['Approved Volunteers', $volunteersApproved, 'verified_user', 'success-green', 'admin.volunteers.index', []],
        ['Donations Received', '₹'.number_format((float) $donationsTotal), 'volunteer_activism', 'secondary-container', 'admin.donations.index', []],
        ['Pending Donations', $donationsPending, 'hourglass_top', 'danger-red', 'admin.donations.index', []],
        ['Upcoming Events', $eventsUpcoming, 'event', 'primary-container', 'admin.events.index', []],
        ['Certificates Issued', $certificatesIssued, 'workspace_premium', 'surface-tint', 'admin.certificates.index', []],
        ['Feedback Received', $feedbackCount.' ('.$avgRating.'★)', 'reviews', 'warning-amber', 'admin.feedbacks.index', []],
        ['Unread Messages', $unreadMessages, 'mail', 'danger-red', 'admin.messages.index', []],
    ] as [$label, $value, $icon, $color, $route, $params])
        <a href="{{ route($route, $params) }}" class="bg-surface-container-lowest p-6 rounded-[16px] shadow-sm border border-outline-variant/30 hover:shadow-md hover:-translate-y-0.5 transition-all block">
            <div class="flex items-center justify-between mb-3">
                <span class="font-label-sm text-label-sm text-on-surface-variant">{{ $label }}</span>
                <div class="w-9 h-9 rounded-full bg-{{ $color }}/10 flex items-center justify-center text-{{ $color }}"><span class="material-symbols-outlined">{{ $icon }}</span></div>
            </div>
            <div class="font-headline-lg !text-3xl font-bold text-primary-container">{{ $value }}</div>
        </a>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
    {{-- Recent volunteers --}}
    <div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="p-5 border-b border-outline-variant/20 flex justify-between items-center">
            <h2 class="font-headline-md !text-lg text-on-background">Latest Applications</h2>
            <a href="{{ route('admin.volunteers.index') }}" class="font-label-sm text-label-sm text-primary-container hover:underline">View all</a>
        </div>
        <ul class="divide-y divide-outline-variant/20">
            @forelse ($recentVolunteers as $v)
                <li class="p-4 px-5 flex items-center gap-3 hover:bg-surface-light transition-colors">
                    <a href="{{ route('admin.volunteers.show', $v) }}" class="flex items-center gap-3 w-full">
                        @if ($v->photo_path)
                            <img src="{{ asset('storage/'.$v->photo_path) }}" alt="" class="w-10 h-10 rounded-full object-cover"/>
                        @else
                            <span class="material-symbols-outlined text-3xl text-outline-variant">account_circle</span>
                        @endif
                        <span class="flex-grow min-w-0">
                            <span class="block font-label-sm text-label-sm font-semibold text-on-background truncate">{{ $v->full_name }}</span>
                            <span class="block text-xs text-on-surface-variant truncate">{{ $v->email }} · {{ $v->mobile }}</span>
                        </span>
                        <span class="shrink-0 inline-flex items-center px-3 py-1 rounded-full font-label-sm text-xs border {{ match($v->status) {
                            'approved' => 'bg-success-green/10 text-success-green border-success-green/30',
                            'rejected' => 'bg-danger-red/10 text-danger-red border-danger-red/30',
                            default => 'bg-warning-amber/10 text-warning-amber border-warning-amber/30',
                        } }}">{{ ucfirst($v->status) }}</span>
                    </a>
                </li>
            @empty
                <li class="p-8 text-center text-on-surface-variant font-label-sm text-label-sm">No applications yet.</li>
            @endforelse
        </ul>
    </div>

    {{-- Recent donations --}}
    <div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="p-5 border-b border-outline-variant/20 flex justify-between items-center">
            <h2 class="font-headline-md !text-lg text-on-background">Recent Donations</h2>
            <a href="{{ route('admin.donations.index') }}" class="font-label-sm text-label-sm text-primary-container hover:underline">View all</a>
        </div>
        <ul class="divide-y divide-outline-variant/20">
            @forelse ($recentDonations as $d)
                <li class="p-4 px-5 flex items-center gap-3">
                    <span class="material-symbols-outlined p-2 rounded-full bg-secondary-fixed-dim/40 text-secondary">favorite</span>
                    <span class="flex-grow min-w-0">
                        <span class="block font-label-sm text-label-sm font-semibold text-on-background truncate">{{ $d->donor_name }} — ₹{{ number_format((float) $d->amount) }}</span>
                        <span class="block text-xs text-on-surface-variant capitalize">{{ str_replace('_',' ', $d->frequency) }} · {{ ucfirst($d->method ?? '') }} · {{ $d->created_at->diffForHumans() }}</span>
                    </span>
                    <span class="shrink-0 inline-flex items-center px-3 py-1 rounded-full font-label-sm text-xs border {{ $d->status === 'completed' ? 'bg-success-green/10 text-success-green border-success-green/30' : ($d->status === 'failed' ? 'bg-danger-red/10 text-danger-red border-danger-red/30' : 'bg-warning-amber/10 text-warning-amber border-warning-amber/30') }}">{{ ucfirst($d->status) }}</span>
                </li>
            @empty
                <li class="p-8 text-center text-on-surface-variant font-label-sm text-label-sm">No donations yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
