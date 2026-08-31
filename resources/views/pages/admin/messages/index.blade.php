@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<header>
    <h1 class="font-headline-lg text-headline-lg text-on-background">Contact Messages</h1>
    <p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ $unread }} unread of {{ $messages->total() }} total.</p>
</header>

<div class="space-y-2">
    @forelse ($messages as $msg)
        <details class="group bg-surface-container-lowest rounded-xl border {{ $msg->read_at ? 'border-outline-variant/30' : 'border-primary-container/50 shadow-[0_0_0_1px_rgba(9,22,74,0.08)]' }}" @if ($loop->first && $unread) open @endif>
            <summary class="list-none cursor-pointer p-5 flex items-center gap-4 hover:bg-surface-light transition-colors [&::-webkit-details-marker]:hidden"
                     onclick="setTimeout(() => { if (!this.closest('details').dataset.read) fetch('{{ route('admin.messages.read', $msg) }}', {method: 'POST', headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content, 'Content-Type': 'application/json', 'X-HTTP-Method-Override': 'PATCH'}, body:'{}'}).then(()=>this.closest('details').dataset.read=1); }, 400)">
                @php($icon = $msg->read_at ? 'mail' : 'mark_email_unread')
                <span class="material-symbols-outlined {{ $msg->read_at ? 'text-outline-variant' : 'text-primary-container' }}">{{ $icon }}</span>
                <span class="flex-grow min-w-0">
                    <span class="block font-label-sm text-label-sm font-semibold text-on-background truncate">{{ $msg->subject }}</span>
                    <span class="block text-xs text-on-surface-variant truncate">{{ $msg->name }} · {{ $msg->email ?? $msg->phone }} · {{ $msg->created_at->diffForHumans() }}</span>
                </span>
            </summary>
            <div class="px-14 pb-5 -mt-1">
                <p class="font-body-md text-body-md text-on-background whitespace-pre-line">{!! nl2br(e($msg->message)) !!}</p>
                <div class="mt-3 flex gap-4 text-xs">
                    @if ($msg->email)<a href="mailto:{{ $msg->email }}?subject=Re: {{ rawurlencode($msg->subject ?? 'Your message') }}" class="text-primary-container underline">Reply by email</a>@endif
                    @if ($msg->phone)<a href="tel:{{ preg_replace('/\s/', '', $msg->phone) }}" class="text-primary-container underline">Call</a>@endif
                </div>
            </div>
        </details>
    @empty
        <div class="bg-surface-container-low rounded-xl p-10 text-center border border-outline-variant/30">
            <span class="material-symbols-outlined text-4xl text-outline-variant">inbox</span>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-3">Inbox is empty.</p>
        </div>
    @endforelse
</div>

<form method="POST" action="#" id="dummy-read-form" class="hidden">@csrf @method('PATCH')</form>
@endsection
