@extends('layouts.admin')

@section('title', 'Volunteer — '.$volunteer->full_name)

@php($interestLabels = ['education' => 'Education / Teaching', 'health_camps' => 'Health Camps', 'fundraising' => 'Fundraising', 'event_management' => 'Event Management', 'social_media' => 'Social Media', 'environment' => 'Environment', 'distribution_drives' => 'Distribution Drives', 'others' => 'Others'])
@php($availabilityLabels = ['full_time' => 'Full-time', 'part_time' => 'Part-time', 'weekends' => 'Weekends only', 'occasional' => 'Occasional'])

@section('content')
<a href="{{ route('admin.volunteers.index') }}" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container hover:text-secondary mb-6"><span class="material-symbols-outlined text-sm">arrow_back</span> All volunteers</a>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter items-start">
    <div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-6 flex flex-col items-center text-center">
        @if ($volunteer->photo_path)
            <img src="{{ asset('storage/'.$volunteer->photo_path) }}" alt="" class="w-32 h-32 rounded-full object-cover border-4 border-surface-container-low shadow"/>
        @else
            <span class="material-symbols-outlined text-7xl text-outline-variant">account_circle</span>
        @endif
        <h1 class="font-headline-md !text-xl font-bold text-on-background mt-4">{{ $volunteer->full_name }}</h1>
        <p class="font-mono-id text-mono-id text-on-surface-variant">{{ $volunteer->volunteer_id ?? 'ID pending' }}</p>
        <span class="mt-3 inline-flex items-center px-3 py-1 rounded-full font-label-sm text-xs border {{ match($volunteer->status) {
            'approved' => 'bg-success-green/10 text-success-green border-success-green/30',
            'rejected' => 'bg-danger-red/10 text-danger-red border-danger-red/30',
            default => 'bg-warning-amber/10 text-warning-amber border-warning-amber/30',
        } }}">{{ ucfirst($volunteer->status) }}</span>
        <div class="mt-6 w-full space-y-2">
            @if ($volunteer->status === 'pending')
                <form action="{{ route('admin.volunteers.decide', $volunteer) }}" method="POST" onsubmit="return confirm('Approve and generate ID?')">
                    @csrf @method('PATCH')
                    <input type="hidden" name="decision" value="approve"/>
                    <button class="w-full bg-success-green text-white py-3 rounded-lg font-label-sm text-label-sm hover:opacity-90 inline-flex justify-center items-center gap-2"><span class="material-symbols-outlined">how_to_reg</span> Approve & Generate ID</button>
                </form>
                <details>
                    <summary class="list-none cursor-pointer text-error py-2.5 rounded-lg border border-danger-red/40 font-label-sm text-label-sm">Reject application…</summary>
                    <form action="{{ route('admin.volunteers.decide', $volunteer) }}" method="POST" class="mt-2 space-y-2">
                        @csrf @method('PATCH')
                        <input type="hidden" name="decision" value="reject"/>
                        <input type="text" name="rejection_note" placeholder="Reason" required class="w-full rounded-md border-outline-variant/50 text-sm px-3 py-2"/>
                        <button class="w-full bg-error text-white py-2.5 rounded-lg text-xs font-semibold">Confirm Rejection</button>
                    </form>
                </details>
            @elseif ($volunteer->status === 'approved')
                <a href="{{ route('admin.volunteers.idcard', $volunteer) }}" class="block bg-primary-container text-on-primary py-3 rounded-lg font-label-sm text-label-sm hover:bg-on-background transition-colors inline-flex justify-center items-center gap-2 w-full"><span class="material-symbols-outlined">badge</span> Download ID Card PDF</a>
            @endif
        </div>
        @if ($generatedPassword)
            <div class="mt-4 p-3 bg-warning-amber/10 border border-warning-amber/40 rounded-lg text-xs w-full">
                New login password: <b class="font-mono-id">{{ $generatedPassword }}</b> (share with volunteer)
            </div>
        @endif
    </div>

    <div class="lg:col-span-2 space-y-gutter">
        <div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-6">
            <h2 class="font-headline-md !text-lg text-on-background mb-4">Application Details</h2>
            <dl class="grid grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-4">
                @foreach ([
                    'Email' => $volunteer->email, 'Mobile' => '+91 '.$volunteer->mobile,
                    'Date of Birth' => optional($volunteer->dob)->format('d M Y'), 'Gender' => ucfirst((string) $volunteer->gender),
                    'Blood Group' => $volunteer->blood_group, 'Availability' => $availabilityLabels[$volunteer->availability ?? ''] ?? '—',
                    'Education' => $volunteer->education, 'Occupation' => $volunteer->occupation,
                    'City / State' => trim(($volunteer->city ?? '').', '.($volunteer->state ?? '').' '.($volunteer->pincode ?? '')),
                    'Emergency Contact' => trim(($volunteer->emergency_contact_name ?? '').' '.($volunteer->emergency_contact_phone ?? '')),
                ] as $label => $value)
                    @if ($value !== null && trim((string) $value) !== '')
                        <div><dt class="text-[11px] uppercase tracking-wider text-on-surface-variant">{{ $label }}</dt><dd class="font-label-sm text-label-sm text-on-background mt-0.5">{{ $value ?: '—' }}</dd></div>
                    @endif
                @endforeach
                <div class="col-span-2 md:col-span-3"><dt class="text-[11px] uppercase tracking-wider text-on-surface-variant">Address</dt><dd class="font-body-md text-body-md text-on-background mt-0.5">{{ $volunteer->address ?? '—' }}</dd></div>
                <div class="col-span-2 md:col-span-3">
                    <dt class="text-[11px] uppercase tracking-wider text-on-surface-variant mb-1">Areas of Interest</dt>
                    <dd class="flex flex-wrap gap-1.5">
                        @foreach ($volunteer->areas_of_interest ?? [] as $i)
                            <span class="text-xs px-2.5 py-1 bg-surface-container-low border border-outline-variant/40 rounded-full text-on-background">{{ $interestLabels[$i] ?? $i }}</span>
                        @endforeach
                    </dd>
                </div>
                @if ($volunteer->experience)
                    <div class="col-span-2 md:col-span-3"><dt class="text-[11px] uppercase tracking-wider text-on-surface-variant">Experience</dt><dd class="font-body-md text-body-md text-on-background mt-0.5">{!! nl2br(e($volunteer->experience)) !!}</dd></div>
                @endif
            </dl>
            <div class="mt-5 pt-4 border-t border-outline-variant/20 flex flex-wrap gap-x-8 gap-y-2 text-sm">
                @if ($volunteer->id_proof_path)
                    <span>
                        <span class="text-[11px] uppercase tracking-wider text-on-surface-variant block">ID Proof (private)</span>
                        <a href="{{ route('admin.volunteers.idproof', $volunteer) }}" target="_blank" class="text-primary-container underline inline-flex items-center gap-1"><span class="material-symbols-outlined text-sm">description</span> View uploaded document</a>
                    </span>
                @endif
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-6">
            <h2 class="font-headline-md !text-lg text-on-background mb-3">Assigned Tasks ({{ $volunteer->tasks->count() }})</h2>
            <ul class="divide-y divide-outline-variant/20">
                @forelse ($volunteer->tasks as $task)
                    <li class="py-2.5 flex justify-between items-center gap-3 text-sm">
                        <span class="text-on-background">{{ $task->title }} <span class="text-on-surface-variant text-xs">· deadline {{ optional($task->pivot->deadline ?? null)->format('d M') ?? optional($task->deadline)->format('d M Y') ?? '—' }}</span></span>
                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs border {{ $task->pivot->status === 'verified' ? 'bg-success-green/10 text-success-green border-success-green/30' : ($task->pivot->status === 'completed' ? 'bg-primary-fixed-dim/40 text-primary-container border-primary-fixed-dim' : 'bg-warning-amber/10 text-warning-amber border-warning-amber/30') }}">{{ str_replace('_',' ', $task->pivot->status) }}</span>
                    </li>
                @empty
                    <li class="py-4 text-on-surface-variant">No tasks assigned yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
