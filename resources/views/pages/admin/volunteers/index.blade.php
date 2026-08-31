@extends('layouts.admin')

@section('title', 'Volunteers')

@section('content')
<header class="flex flex-col md:flex-row md:justify-between md:items-end gap-4">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-background">Manage Volunteers</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Review applications, approve volunteers and download their ID cards.</p>
    </div>
    <div class="flex gap-2">
        @foreach (['' => 'All', 'pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $value => $label)
            <a href="{{ route('admin.volunteers.index', ['status' => $value]) }}"
               class="font-label-sm text-label-sm px-4 py-2 rounded-lg transition-all {{ $status === $value ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'border border-outline bg-surface text-on-surface-variant hover:bg-surface-container-low' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</header>

<div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left min-w-[760px]">
            <thead>
                <tr class="bg-surface-dim/60 font-label-sm text-xs text-on-surface-variant uppercase tracking-wider border-b border-outline-variant/30">
                    <th class="px-5 py-4">Applicant</th>
                    <th class="px-5 py-4">Contact</th>
                    <th class="px-5 py-4">Interest</th>
                    <th class="px-5 py-4">Applied</th>
                    <th class="px-5 py-4">Status</th>
                    <th class="px-5 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20">
                @forelse ($volunteers as $v)
                    <tr class="hover:bg-surface-light transition-colors align-middle">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                @if ($v->photo_path)
                                    <img src="{{ asset('storage/'.$v->photo_path) }}" alt="" class="w-10 h-10 rounded-full object-cover"/>
                                @else
                                    <span class="material-symbols-outlined text-3xl text-outline-variant">account_circle</span>
                                @endif
                                <div>
                                    <a href="{{ route('admin.volunteers.show', $v) }}" class="font-label-sm font-semibold text-on-background hover:text-secondary">{{ $v->full_name }}</a>
                                    @if ($v->volunteer_id)<span class="block font-mono-id text-mono-id text-xs text-on-surface-variant">{{ $v->volunteer_id }}</span>@endif
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-sm text-on-surface-variant">{{ $v->mobile }}<br><span class="text-xs">{{ Str::limit($v->email, 26) }}</span></td>
                        <td class="px-5 py-4">
                            <div class="flex flex-wrap gap-1 max-w-[200px]">
                                @foreach (collect($v->areas_of_interest ?? [])->take(2) as $interest)
                                    <span class="text-[11px] px-2 py-0.5 bg-surface-container-low border border-outline-variant/40 rounded-full text-on-surface-variant capitalize">{{ str_replace('_', ' ', $interest) }}</span>
                                @endforeach
                                @if (count($v->areas_of_interest ?? []) > 2)<span class="text-[11px] px-2 py-0.5 text-on-surface-variant">+{{ count($v->areas_of_interest) - 2 }}</span>@endif
                            </div>
                        </td>
                        <td class="px-5 py-4 text-sm text-on-surface-variant whitespace-nowrap">{{ $v->created_at->format('d M Y') }}</td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full font-label-sm text-xs border {{ match($v->status) {
                                'approved' => 'bg-success-green/10 text-success-green border-success-green/30',
                                'rejected' => 'bg-danger-red/10 text-danger-red border-danger-red/30',
                                default => 'bg-warning-amber/10 text-warning-amber border-warning-amber/30',
                            } }}">{{ ucfirst($v->status) }}</span>
                        </td>
                        <td class="px-5 py-4 text-right whitespace-nowrap">
                            @if ($v->status === 'pending')
                                <form action="{{ route('admin.volunteers.decide', $v) }}" method="POST" class="inline-flex gap-2 items-center" onsubmit="return confirm('Approve {{ $v->full_name }}? A login will be created and the Volunteer ID generated.')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="decision" value="approve"/>
                                    <button class="bg-success-green text-white text-xs font-semibold px-3 py-1.5 rounded-lg hover:opacity-90 inline-flex items-center gap-1"><span class="material-symbols-outlined text-sm">check</span> Approve</button>
                                </form>
                                <details class="inline-block relative">
                                    <summary class="list-none cursor-pointer text-danger-red text-xs font-semibold px-3 py-1.5 rounded-lg border border-danger-red/40 hover:bg-danger-red/5 inline-flex items-center gap-1"><span class="material-symbols-outlined text-sm">close</span> Reject</summary>
                                    <form action="{{ route('admin.volunteers.decide', $v) }}" method="POST" class="absolute right-0 mt-2 z-20 bg-surface p-4 rounded-xl shadow-xl border border-outline-variant/40 w-64 space-y-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="decision" value="reject"/>
                                        <input type="text" name="rejection_note" placeholder="Reason (shared with applicant)" required class="w-full rounded-md border-outline-variant/50 text-sm px-3 py-2"/>
                                        <button class="w-full bg-error text-white text-xs font-semibold py-2 rounded-lg">Confirm Rejection</button>
                                    </form>
                                </details>
                            @elseif ($v->status === 'approved')
                                <a href="{{ route('admin.volunteers.idcard', $v) }}" class="text-primary-container text-xs font-semibold px-3 py-1.5 rounded-lg border border-outline-variant/50 hover:bg-surface-container-low inline-flex items-center gap-1"><span class="material-symbols-outlined text-sm">badge</span> ID Card</a>
                            @endif
                            <a href="{{ route('admin.volunteers.show', $v) }}" class="text-on-surface-variant text-xs px-2 inline-flex items-center"><span class="material-symbols-outlined text-base">visibility</span></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-12 text-center text-on-surface-variant">No volunteer applications found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $volunteers->links() }}</div>
</div>
@endsection
