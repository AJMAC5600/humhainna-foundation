<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\TaskVolunteer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskActionController extends Controller
{
    public function update(Request $request, TaskVolunteer $assignment): RedirectResponse
    {
        abort_unless($assignment->volunteer_id === auth()->user()?->volunteer?->id, 403);
        abort_if($assignment->status === 'verified', 422, 'This task is already verified.');

        $data = $request->validate([
            'action' => ['required', 'in:start,complete'],
            'proof' => ['required_if:action,complete', 'nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:4096'],
            'proof_note' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($data['action'] === 'start') {
            $assignment->update(['status' => 'in_progress']);

            return back()->with('success', 'Task marked as in progress.');
        }

        $path = $request->file('proof')?->store('task-proofs');

        $assignment->update([
            'status' => 'completed',
            'proof_path' => $path,
            'proof_note' => $data['proof_note'] ?? null,
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Proof submitted! The coordinator will verify your work shortly.');
    }
}
