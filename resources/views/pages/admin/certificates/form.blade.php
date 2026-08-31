@extends('layouts.admin')

@section('title', 'Generate Certificate')

@section('content')
<a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container hover:text-secondary mb-6"><span class="material-symbols-outlined text-sm">arrow_back</span> All certificates</a>

<form method="POST" action="{{ route('admin.certificates.store') }}" class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-6 md:p-8 space-y-gutter max-w-3xl">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="type">Certificate Type *</label>
            <select id="type" name="type" required class="rounded-lg border-outline-variant/50 bg-surface px-4 py-3">
                @foreach ($types as $value => $label)
                    <option value="{{ $value }}" @selected(old('type') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="volunteer_id">Volunteer (optional)</label>
            <select id="volunteer_id" name="volunteer_id" onchange="document.getElementById('recipient_name').closest('div').classList.toggle('hidden', !!this.value)" class="rounded-lg border-outline-variant/50 bg-surface px-4 py-3">
                <option value="">— External recipient (fill name below) —</option>
                @foreach ($volunteers as $v)
                    <option value="{{ $v->id }}" data-name="{{ $v->full_name }}" @selected(old('volunteer_id') == $v->id)>{{ $v->full_name }} · {{ $v->volunteer_id }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="recipient_name">Recipient Name *</label>
            <input id="recipient_name" name="recipient_name" value="{{ old('recipient_name') }}" placeholder="Auto-filled when a volunteer is selected" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="recipient_email">Recipient Email (to send PDF)</label>
            <input id="recipient_email" name="recipient_email" type="email" value="{{ old('recipient_email') }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="md:col-span-2 flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="reason">Reason / Event Name</label>
            <input id="reason" name="reason" value="{{ old('reason', old('event_preset')) }}" placeholder="e.g. Tree Plantation Drive — March 2026" list="reason-presets" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
            <datalist id="reason-presets">
                @foreach ($events as $event)
                    <option value="{{ $event->title }} — {{ $event->starts_at->format('F Y') }}">{{ $event->title }}</option>
                @endforeach
            </datalist>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="duration">Duration (for long-term certs)</label>
            <input id="duration" name="duration" value="{{ old('duration') }}" placeholder='e.g. "6 months", "Jan–Dec 2025"' class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="issued_on">Date of Issue *</label>
            <input type="date" id="issued_on" name="issued_on" required value="{{ old('issued_on', now()->format('Y-m-d')) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="signatory_name">Signatory Name</label>
            <input id="signatory_name" name="signatory_name" value="{{ old('signatory_name', \App\Models\Setting::get('signatory_name')) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="signatory_designation">Signatory Designation</label>
            <input id="signatory_designation" name="signatory_designation" value="{{ old('signatory_designation', \App\Models\Setting::get('signatory_designation')) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
    </div>

    <button class="bg-primary-container text-on-primary font-label-sm text-label-sm px-8 py-3 rounded-lg hover:bg-on-background transition-colors inline-flex items-center gap-2">
        Generate & Download PDF <span class="material-symbols-outlined text-base">workspace_premium</span>
    </button>
</form>

<script>
document.getElementById('volunteer_id').addEventListener('change', function () {
    const opt = this.selectedOptions[0];
    if (opt && opt.value) document.getElementById('recipient_name').value = opt.dataset.name || '';
});
</script>
@endsection
