<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Event;
use App\Models\TaskVolunteer;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $volunteer = auth()->user()->volunteer()->with('tasks')->first();

        $assignments = collect();
        if ($volunteer) {
            $assignments = TaskVolunteer::query()
                ->where('volunteer_id', $volunteer->id)
                ->with(['task', 'task.event'])
                ->latest()
                ->get();
        }

        return view('pages.dashboard.index', [
            'volunteer' => $volunteer,
            'assignments' => $assignments,
            'hours' => (int) $assignments->whereNotNull('verified_at')->sum(fn ($a) => $a->task->hours ?? 0),
            'eventsCount' => $volunteer ? Event::whereHas('registrations', fn ($q) => $q->where('volunteer_id', $volunteer->id))->count() : 0,
            'certificates' => $volunteer ? Certificate::where('volunteer_id', $volunteer->id)->get() : collect(),
        ]);
    }
}
