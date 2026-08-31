<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Task;
use App\Models\TaskVolunteer;
use App\Models\Volunteer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        return view('pages.admin.tasks.index', [
            'tasks' => Task::with(['volunteers', 'event'])->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.tasks.form', [
            'task' => new Task,
            'events' => Event::orderBy('title')->get(),
            'volunteers' => Volunteer::where('status', 'approved')->orderBy('full_name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $task = Task::create(collect($data)->except('volunteer_ids')->all());

        if (! empty($data['volunteer_ids'])) {
            $task->volunteers()->sync($data['volunteer_ids']);
        }

        return redirect()->route('admin.tasks.index')->with('success', 'Task created and assigned.');
    }

    public function show(Task $task): View
    {
        return view('pages.admin.tasks.show', ['task' => $task->load(['volunteers', 'event'])]);
    }

    public function edit(Task $task): View
    {
        return view('pages.admin.tasks.form', [
            'task' => $task,
            'events' => Event::orderBy('title')->get(),
            'volunteers' => Volunteer::where('status', 'approved')->orderBy('full_name')->get(),
        ]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $data = $this->validated($request);
        $task->update(collect($data)->except('volunteer_ids')->all());
        $task->volunteers()->sync($data['volunteer_ids'] ?? []);

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return back()->with('success', 'Task deleted.');
    }

    public function verifyAssignment(TaskVolunteer $assignment): RedirectResponse
    {
        abort_unless($assignment->status === 'completed', 422, 'Only completed tasks can be verified.');

        $assignment->update([
            'status' => 'verified',
            'verified_at' => now(),
        ]);

        $assignment->volunteer->increment('hours_logged', $assignment->task->hours);

        return back()->with('success', "Work by {$assignment->volunteer->full_name} verified — hours credited.");
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'event_id' => ['nullable', 'exists:events,id'],
            'start_date' => ['nullable', 'date'],
            'deadline' => ['nullable', 'date', 'after_or_equal:start_date'],
            'priority' => ['required', 'in:low,medium,high'],
            'hours' => ['nullable', 'integer', 'min:0', 'max:1000'],
            'volunteer_ids' => ['nullable', 'array'],
            'volunteer_ids.*' => ['exists:volunteers,id'],
        ]);
    }
}
