@extends('layouts.volunteer')

@section('title', 'My Tasks & Impact')

@section('content')
<header class="flex flex-col md:flex-row md:justify-between md:items-end gap-4">
    <div>
        <h2 class="font-headline-lg text-headline-lg text-on-background">Welcome back{{ $volunteer ? ', '.str($volunteer->full_name)->before(' ') : '' }}!</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">
            @if ($volunteer && $volunteer->status === 'approved')
                Here is your current task board and impact summary.
            @elseif ($volunteer)
                Your application is <strong class="capitalize">{{ str_replace('_', ' ', $volunteer->status) }}</strong> — you'll get tasks once it's approved.
            @else
                No volunteer profile is linked to this account yet.
            @endif
        </p>
    </div>
    @if ($volunteer?->volunteer_id)
        <span class="font-mono-id text-mono-id bg-surface-container-low border border-outline-variant/40 rounded-lg px-4 py-2 tracking-wider w-fit">{{ $volunteer->volunteer_id }}</span>
    @endif
</header>

@if (! $volunteer)
    <div class="bg-surface-container-low rounded-xl p-10 text-center border border-outline-variant/30">
        <span class="material-symbols-outlined text-4xl text-outline-variant">person_search</span>
        <p class="font-body-lg text-body-lg text-on-surface-variant mt-3 mb-6">No application found for this account.</p>
        <a href="{{ route('volunteer.apply.form') }}" class="inline-block bg-primary-container text-on-primary font-label-sm text-label-sm px-8 py-3 rounded-lg hover:bg-on-background transition-colors">Apply as Volunteer</a>
    </div>
@elseif ($volunteer->status === 'pending')
    <div class="bg-warning-amber/10 border border-warning-amber/40 rounded-xl p-6 flex items-start gap-3">
        <span class="material-symbols-outlined text-warning-amber">hourglass_top</span>
        <p class="font-body-md text-body-md text-on-background">Your application is under review. Once a coordinator approves it, your unique Volunteer ID and ID card will appear here automatically.</p>
    </div>
@elseif ($volunteer->status === 'rejected')
    <div class="bg-error-container rounded-xl p-6 flex items-start gap-3 border border-error/30">
        <span class="material-symbols-outlined text-error">cancel</span>
        <p class="font-body-md text-body-md text-on-background">Your application was not approved this time. {{ $volunteer->rejection_note ?? '' }}</p>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
    <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-gutter content-start">
        {{-- Stats --}}
        <div class="bg-surface-container-lowest p-6 rounded-[16px] shadow-sm border border-surface-container hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="font-label-sm text-label-sm text-on-surface-variant">Hours Contributed</span>
                <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary-container"><span class="material-symbols-outlined">schedule</span></div>
            </div>
            <div class="font-display-lg !text-5xl font-bold text-primary-container">{{ $hours }}</div>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-[16px] shadow-sm border border-surface-container hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="font-label-sm text-label-sm text-on-surface-variant">Events Participated</span>
                <div class="w-10 h-10 rounded-full bg-secondary-fixed-dim/50 flex items-center justify-center text-secondary"><span class="material-symbols-outlined">event</span></div>
            </div>
            <div class="font-display-lg !text-5xl font-bold text-primary-container">{{ $eventsCount }}</div>
        </div>

        {{-- Task board --}}
        <div class="sm:col-span-2 bg-surface-container-lowest rounded-[16px] shadow-sm border border-surface-container overflow-hidden">
            <div class="p-6 border-b border-surface-container flex justify-between items-center bg-surface-light">
                <h3 class="font-headline-md text-headline-md text-on-background">Current Tasks</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead>
                        <tr class="bg-surface-dim/60 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider border-b border-outline-variant/30">
                            <th class="px-6 py-4">Task</th>
                            <th class="px-6 py-4">Deadline</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="font-body-md text-body-md divide-y divide-outline-variant/20">
                        @forelse ($assignments as $a)
                            <tr class="hover:bg-surface-light transition-colors align-top" x-data="{ open: false }">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-on-background">{{ $a->task->title }}</p>
                                    @if ($a->task->description)<p class="text-xs text-on-surface-variant mt-0.5 max-w-xs">{{ Str::limit($a->task->description, 90) }}</p>@endif
                                    @if ($a->task->priority === 'high')<span class="mt-1 inline-flex items-center px-2 py-0.5 rounded-full bg-danger-red/10 text-danger-red text-xs border border-danger-red/20">High priority</span>@endif
                                </td>
                                <td class="px-6 py-4 text-on-surface-variant whitespace-nowrap">{{ optional($a->task->deadline)->format('d M Y') ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full font-label-sm text-label-sm border {{ match($a->status) {
                                        'verified' => 'bg-success-green/10 text-success-green border-success-green/20',
                                        'completed' => 'bg-primary-fixed-dim/30 text-primary-container border-primary-fixed-dim',
                                        'in_progress' => 'bg-secondary-fixed-dim/40 text-secondary border-secondary/20',
                                        default => 'bg-warning-amber/10 text-warning-amber border-warning-amber/20',
                                    } }}">{{ str_replace('_', ' ', $a->status) }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if (in_array($a->status, ['pending', 'in_progress']))
                                        <form method="POST" action="{{ route('dashboard.tasks.update', $a) }}" enctype="multipart/form-data" class="space-y-2 inline-block w-56 text-left">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="action" value="{{ $a->status === 'pending' ? 'start' : 'complete' }}"/>
                                            @if ($a->status === 'in_progress')
                                                <input type="file" name="proof" required accept=".jpg,.jpeg,.png,.pdf" class="block w-full text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-surface-container-low file:text-primary-container"/>
                                                <input type="text" name="proof_note" placeholder="Note (optional)" class="w-full rounded-md border-outline-variant/50 text-sm px-3 py-2"/>
                                            @endif
                                            <button class="w-full bg-primary-container text-on-primary rounded-lg py-2 font-label-sm text-label-sm hover:bg-on-background transition-colors">
                                                {{ $a->status === 'pending' ? 'Start Task' : 'Submit Proof' }}
                                            </button>
                                        </form>
                                    @elseif ($a->status === 'completed')
                                        <span class="text-xs text-on-surface-variant italic">Awaiting verification</span>
                                    @else
                                        <span class="material-symbols-outlined text-success-green" title="Verified by admin">verified</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-12 text-center text-on-surface-variant">No tasks assigned yet. You'll see them here once a coordinator assigns work.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Certificates --}}
        @if ($certificates->count())
            <div class="sm:col-span-2 bg-surface-container-lowest rounded-[16px] shadow-sm border border-surface-container p-6">
                <h3 class="font-headline-md text-headline-md text-on-background mb-4">My Certificates</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-gutter">
                    @foreach ($certificates as $cert)
                        <div class="border border-outline-variant/30 rounded-xl p-4 flex items-center justify-between gap-3 bg-surface-light">
                            <div class="min-w-0">
                                <p class="font-label-sm text-label-sm font-semibold text-on-background truncate">{{ \App\Models\Certificate::TYPES[$cert->type] ?? $cert->type }}</p>
                                <p class="font-mono-id text-mono-id text-xs text-on-surface-variant">{{ $cert->certificate_number }}</p>
                            </div>
                            <a href="{{ route('dashboard.certificates.download', $cert) }}" class="shrink-0 bg-primary-container text-on-primary rounded-lg px-4 py-2 font-label-sm text-label-sm hover:bg-on-background transition-colors inline-flex items-center gap-1"><span class="material-symbols-outlined text-base">download</span> PDF</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- Right column --}}
    <div class="md:col-span-4 space-y-gutter">
        {{-- Digital ID card preview (Stitch design) --}}
        <div class="bg-surface-container-lowest rounded-[16px] shadow-md border border-outline-variant/30 overflow-hidden relative">
            <div class="h-24 bg-gradient-to-r from-primary-container to-surface-tint relative">
                <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 16px 16px;"></div>
                <span class="absolute top-4 left-6 text-white/90 font-headline-md !text-base">HUM HAIN NA FOUNDATION</span>
            </div>
            <div class="px-6 pb-6 relative -mt-12 text-center flex flex-col items-center">
                @if ($volunteer?->photo_path)
                    <img src="{{ asset('storage/'.$volunteer->photo_path) }}" alt="{{ $volunteer->full_name }}" class="w-24 h-24 rounded-full border-4 border-surface-container-lowest shadow-sm object-cover bg-white mb-3"/>
                @else
                    <div class="w-24 h-24 rounded-full border-4 border-surface-container-lowest shadow-sm bg-surface-container flex items-center justify-center mb-3"><span class="material-symbols-outlined text-4xl text-outline-variant">person</span></div>
                @endif
                <h4 class="font-headline-md text-headline-md text-on-background mb-1">{{ $volunteer?->full_name ?? auth()->user()->name }}</h4>
                <p class="font-label-sm text-label-sm text-primary-container mb-4">{{ $volunteer?->status === 'approved' ? 'Registered Volunteer' : ucfirst(str_replace('_',' ', $volunteer?->status ?? 'applicant')) }}</p>
                <div class="w-full bg-surface-container-low p-4 rounded-lg border border-surface-container text-left space-y-2 mb-4">
                    <div class="flex justify-between items-center">
                        <span class="font-label-sm text-label-sm text-on-surface-variant">ID Number</span>
                        <span class="font-mono-id text-mono-id text-on-background tracking-wider">{{ $volunteer?->volunteer_id ?? 'Pending approval' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-label-sm text-label-sm text-on-surface-variant">Blood Group</span>
                        <span class="font-body-md text-body-md text-danger-red font-bold">{{ $volunteer?->blood_group ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-label-sm text-label-sm text-on-surface-variant">Valid Until</span>
                        <span class="font-body-md text-body-md text-on-background">{{ optional($volunteer?->valid_till)?->format('M Y') ?? '—' }}</span>
                    </div>
                </div>
                @if ($qr = app(\App\Services\QrService::class)->pngDataUri(route('verify.code', ['code' => $volunteer?->volunteer_id ?? 'x'])))
                    <img src="{{ $qr }}" alt="Verification QR" width="128" height="128" class="w-32 h-32 bg-white p-2 border border-outline-variant rounded-lg mx-auto mb-2"/>
                    <span class="font-label-sm text-label-sm text-on-surface-variant text-xs">Scan for verification</span>
                @endif
            </div>
        </div>

        <a href="{{ route('dashboard.idcard.show') }}" class="block bg-primary-container text-on-primary text-center rounded-lg py-3 font-label-sm text-label-sm hover:bg-on-background transition-colors">View / Download ID Card</a>
    </div>
</div>
@endsection
