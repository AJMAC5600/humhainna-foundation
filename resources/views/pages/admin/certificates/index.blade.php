@extends('layouts.admin')

@section('title', 'Certificates')

@section('content')
<header class="flex justify-between items-end">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-background">Manage Certificates</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Generate verified certificates with unique numbers and QR codes.</p>
    </div>
    <a href="{{ route('admin.certificates.create') }}" class="bg-primary-container text-on-primary font-label-sm text-label-sm px-6 py-2.5 rounded-lg hover:bg-on-background transition-colors inline-flex items-center gap-2"><span class="material-symbols-outlined text-base">add</span> Generate Certificate</a>
</header>

<div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left min-w-[720px]">
            <thead>
                <tr class="bg-surface-dim/60 font-label-sm text-xs text-on-surface-variant uppercase tracking-wider border-b border-outline-variant/30">
                    <th class="px-5 py-4">Certificate No.</th>
                    <th class="px-5 py-4">Recipient</th>
                    <th class="px-5 py-4">Type</th>
                    <th class="px-5 py-4">For</th>
                    <th class="px-5 py-4">Issued</th>
                    <th class="px-5 py-4 text-right">PDF</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20">
                @forelse ($certificates as $c)
                    <tr class="hover:bg-surface-light transition-colors">
                        <td class="px-5 py-4"><span class="font-mono-id text-mono-id">{{ $c->certificate_number }}</span></td>
                        <td class="px-5 py-4 font-label-sm font-semibold text-on-background">
                            {{ $c->recipient_name }}
                            @if ($c->volunteer)<span class="block text-xs text-on-surface-variant font-normal">{{ $c->volunteer->volunteer_id }}</span>@endif
                        </td>
                        <td class="px-5 py-4"><span class="text-xs px-2.5 py-1 rounded-full bg-surface-container-low border border-outline-variant/40 capitalize">{{ str_replace('_', ' ', $c->type) }}</span></td>
                        <td class="px-5 py-4 text-sm text-on-surface-variant">{{ Str::limit($c->reason, 44) ?? '—' }}</td>
                        <td class="px-5 py-4 text-sm text-on-surface-variant whitespace-nowrap">{{ $c->issued_on->format('d M Y') }}</td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.certificates.pdf', $c) }}" class="text-primary-container hover:text-secondary inline-flex items-center gap-1 font-label-sm"><span class="material-symbols-outlined text-base">download</span> PDF</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-12 text-center text-on-surface-variant">No certificates issued yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $certificates->links() }}</div>
</div>
@endsection
