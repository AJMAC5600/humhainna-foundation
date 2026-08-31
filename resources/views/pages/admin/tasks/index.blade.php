@extends('layouts.admin')

@section('title', 'Tasks')

@section('content')
<header class="flex justify-between items-end">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-background">Manage Tasks</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Assign work to volunteers and track progress.</p>
    </div>
    <a href="{{ route('admin.tasks.create') }}" class="bg-primary-container text-on-primary font-label-sm text-label-sm px-6 py-2.5 rounded-lg hover:bg-on-background transition-colors inline-flex items-center gap-2"><span class="material-symbols-outlined text-base">add</span> New Task</a>
</header>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
    @forelse ($tasks as $task)
        <div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-5 flex flex-col">
            <div class="flex justify-between items-start gap-3">
                <div class="min-w-0">
                    <h2 class="font-label-sm text-label-sm font-semibold text-on-background">{{ $task->title }}</h2>
                    <p class="text-xs text-on-surface-variant mt-0.5">
                        {{ optional($task->start_date)->format('d M') ?? '—' }} → {{ optional($task->deadline)->format('d M Y') ?? '—' }}
                        @if ($task->event) · {{ Str::limit($task->event->title, 30) }}@endif
                        · {{ $task->hours }}h
                    </p>
                </div>
                <span class="shrink-0 inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold border {{ ['low' => 'bg-surface-container-low text-on-surface-variant border-outline-variant/40', 'medium' => 'bg-warning-amber/10 text-warning-amber border-warning-amber/20', 'high' => 'bg-danger-red/10 text-danger-red border-danger-red/30'][$task->priority] }}">{{ strtoupper($task->priority) }}</span>
            </div>

            <div class="mt-3 flex flex-wrap gap-1.5">
                @forelse ($task->volunteers as $v)
                    @php($pv = $task->volunteers->find($v->id))
                    <span class="inline-flex items-center gap-1.5 text-xs px-2.5 py-1 rounded-full border {{ $pv->pivot->status === 'verified' ? 'bg-success-green/10 text-success-green border-success-green/30' : ($pv->pivot->status === 'completed' ? 'bg-primary-fixed-dim/40 text-primary-container border-primary-fixed-dim' : ($pv->pivot->status === 'in_progress' ? 'bg-secondary-fixed-dim/50 text-secondary border-secondary/20' : 'bg-surface-container-low text-on-surface-variant border-outline-variant/40')) }}">
                        {{ Str::before($v->full_name, ' ') }}
                        @if ($pv->pivot->status === 'completed')
                            <form action="{{ route('admin.assignments.verify', $pv->pivot) }}" method="POST" onsubmit="return confirm('Verify this volunteer\'s work?')">@csrf @method('PATCH')<button title="Verify & credit hours" class="text-primary-container hover:text-secondary"><span class="material-symbols-outlined text-sm">task_alt</span></button></form>
                        @endif
                    </span>
                @empty
                    <span class="text-xs text-danger-red">Not assigned to anyone</span>
                @endforelse
            </div>

            <div class="mt-auto pt-4 flex justify-end gap-2">
                <a href="{{ route('admin.tasks.edit', $task) }}" class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-outline-variant/50 hover:bg-surface-container-low inline-flex items-center gap-1"><span class="material-symbols-outlined text-sm">edit</span> Edit / Assign</a>
                <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete task?')">@csrf @method('DELETE')<button class="text-xs font-semibold px-3 py-1.5 rounded-lg text-error border border-danger-red/40 hover:bg-danger-red/5 inline-flex items-center gap-1"><span class="material-symbols-outlined text-sm">delete</span></button></form>
            </div>
        </div>
    @empty
        <div class="lg:col-span-2 bg-surface-container-low rounded-xl p-10 text-center border border-outline-variant/30">
            <span class="material-symbols-outlined text-4xl text-outline-variant">assignment</span>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-3">No tasks yet — create the first one.</p>
        </div>
    @endforelse
</div>

<div>{{ $tasks->links() }}</div>
@endsection
