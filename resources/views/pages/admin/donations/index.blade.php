@extends('layouts.admin')

@section('title', 'Donations')

@section('content')
<header class="flex flex-col md:flex-row md:justify-between md:items-end gap-4">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-background">Manage Donations</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">
            Received: <strong class="text-success-green">₹{{ number_format((float) $totalCompleted) }}</strong> ·
            Pending confirmation: <strong class="text-warning-amber">₹{{ number_format((float) $totalPending) }}</strong>
        </p>
    </div>
    <div class="flex gap-2 flex-wrap items-center">
        @foreach (['' => 'All', 'pending' => 'Pending', 'completed' => 'Completed', 'failed' => 'Failed'] as $value => $label)
            <a href="{{ route('admin.donations.index', ['status' => $value]) }}" class="font-label-sm px-4 py-2 rounded-lg transition-all {{ $status === $value ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'border border-outline bg-surface text-on-surface-variant hover:bg-surface-container-low' }}">{{ $label }}</a>
        @endforeach
        <a href="{{ route('admin.donations.export') }}" class="border border-outline bg-surface text-on-background font-label-sm px-4 py-2 rounded-lg hover:bg-surface-container-low inline-flex items-center gap-1"><span class="material-symbols-outlined text-base">download</span> Export CSV</a>
    </div>
</header>

<div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left min-w-[900px]">
            <thead>
                <tr class="bg-surface-dim/60 font-label-sm text-xs text-on-surface-variant uppercase tracking-wider border-b border-outline-variant/30">
                    <th class="px-5 py-4">Receipt No.</th>
                    <th class="px-5 py-4">Donor</th>
                    <th class="px-5 py-4">Amount</th>
                    <th class="px-5 py-4">Type / Cause</th>
                    <th class="px-5 py-4">Method</th>
                    <th class="px-5 py-4">Date</th>
                    <th class="px-5 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20">
                @forelse ($donations as $d)
                    <tr class="hover:bg-surface-light transition-colors">
                        <td class="px-5 py-4 font-mono-id text-mono-id">{{ $d->receipt_number ?? '—' }}</td>
                        <td class="px-5 py-4">
                            <span class="font-label-sm font-semibold text-on-background">{{ $d->donor_name }}</span>
                            <span class="block text-xs text-on-surface-variant">{{ Str::limit($d->email ?? $d->mobile, 28) }}@if($d->pan) · PAN {{ $d->pan }}@endif</span>
                        </td>
                        <td class="px-5 py-4 font-label-sm font-semibold text-primary-container whitespace-nowrap">₹{{ number_format((float) $d->amount) }}</td>
                        <td class="px-5 py-4 text-xs capitalize text-on-surface-variant">{{ str_replace('_', ' ', $d->frequency) }}<br>{{ $d->cause ? ucfirst($d->cause) : '' }}</td>
                        <td class="px-5 py-4 text-xs uppercase">{{ $d->method }}</td>
                        <td class="px-5 py-4 text-xs whitespace-nowrap">{{ optional($d->paid_at ?? $d->created_at)->format('d M Y') }}</td>
                        <td class="px-5 py-4">
                            <form action="{{ route('admin.donations.update', $d) }}" method="POST" class="flex items-center gap-2">
                                @csrf @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="rounded-md border-outline-variant/50 bg-surface text-xs px-2 py-1.5 capitalize {{ ['completed' => '!text-success-green', 'failed' => '!text-danger-red', 'pending' => '!text-warning-amber'][$d->status] }}">
                                    @foreach (['pending','completed','failed'] as $s)
                                        <option value="{{ $s }}" @selected($d->status === $s)>{{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
                            </form>
                            @if ($d->receipt_number)
                                <a href="{{ url('/donations/'.$d->id.'/receipt') }}" target="_blank" title="Download receipt PDF" class="inline-flex p-1.5 text-primary-container hover:text-secondary align-middle"><span class="material-symbols-outlined text-base">receipt_long</span></a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-5 py-12 text-center text-on-surface-variant">No donations recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $donations->links() }}</div>
</div>
@endsection
