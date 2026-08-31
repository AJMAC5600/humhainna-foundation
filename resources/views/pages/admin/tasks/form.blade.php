@extends('layouts.admin')

@section('title', $task->exists ? 'Edit Task' : 'New Task')

@section('content')
<a href="{{ route('admin.tasks.index') }}" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container hover:text-secondary mb-6"><span class="material-symbols-outlined text-sm">arrow_back</span> All tasks</a>

<form method="POST" action="{{ $task->exists ? route('admin.tasks.update', $task) : route('admin.tasks.store') }}" class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-6 md:p-8 space-y-gutter max-w-3xl">
    @csrf
    @if ($task->exists) @method('PUT') @endif

    <div class="flex flex-col gap-1.5">
        <label class="font-label-sm text-label-sm text-on-background" for="title">Task Title *</label>
        <input id="title" name="title" required value="{{ old('title', $task->title) }}" placeholder="e.g. Winter blanket drive — packing team" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
    </div>

    <div class="flex flex-col gap-1.5">
        <label class="font-label-sm text-label-sm text-on-background" for="description">Description</label>
        <textarea id="description" name="description" rows="3" class="rounded-lg border-outline-variant/50 px-4 py-3">{{ old('description', $task->description) }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="event_id">Linked Event (optional)</label>
            <select id="event_id" name="event_id" class="rounded-lg border-outline-variant/50 bg-surface px-4 py-3 capitalize">
                <option value="">— None —</option>
                @foreach ($events as $event)
                    <option value="{{ $event->id }}" @selected(old('event_id', $task->event_id) == $event->id)>{{ $event->title }} ({{ $event->starts_at->format('M Y') }})</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="priority">Priority *</label>
            <select id="priority" name="priority" required class="rounded-lg border-outline-variant/50 bg-surface px-4 py-3 capitalize">
                @foreach (['low', 'medium', 'high'] as $p)
                    <option value="{{ $p }}" @selected(old('priority', $task->priority ?? 'medium') === $p)>{{ ucfirst($p) }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="start_date">Start Date</label>
            <input type="date" id="start_date" name="start_date" value="{{ old('start_date', optional($task->start_date)?->format('Y-m-d')) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="deadline">Deadline</label>
            <input type="date" id="deadline" name="deadline" value="{{ old('deadline', optional($task->deadline)?->format('Y-m-d')) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="hours">Volunteer Hours (credited on verification)</label>
            <input type="number" min="0" max="1000" id="hours" name="hours" value="{{ old('hours', $task->hours ?? 4) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
    </div>

    <fieldset class="border border-outline-variant/40 rounded-xl p-5 pt-4">
        <legend class="px-2 font-label-sm text-label-sm font-semibold text-on-background">Assign Volunteers</legend>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 max-h-64 overflow-y-auto">
            @forelse ($volunteers as $volunteer)
                <label class="flex items-center gap-2.5 rounded-lg border {{ in_array($volunteer->id, old('volunteer_ids', $task->volunteers->pluck('id')->all())) ? 'border-primary-container bg-surface-container-low ring-1 ring-primary-container/20' : 'border-outline-variant/40' }} px-3 py-2 cursor-pointer hover:bg-surface-container-low transition-colors">
                    <input type="checkbox" name="volunteer_ids[]" value="{{ $volunteer->id }}" @checked(in_array($volunteer->id, old('volunteer_ids', $task->volunteers->pluck('id')->all()))) class="rounded border-outline-variant text-primary-container focus:ring-primary-container/30"/>
                    <span class="text-xs truncate">{{ $volunteer->full_name }}</span>
                </label>
            @empty
                <p class="text-sm text-on-surface-variant col-span-full">No approved volunteers yet.</p>
            @endforelse
        </div>
    </fieldset>

    <button class="bg-primary-container text-on-primary font-label-sm text-label-sm px-8 py-3 rounded-lg hover:bg-on-background transition-colors">{{ $task->exists ? 'Update Task' : 'Create Task' }}</button>
</form>
@endsection
