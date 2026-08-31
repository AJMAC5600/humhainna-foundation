<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request): View
    {
        return view('pages.admin.feedbacks.index', [
            'feedbacks' => Feedback::latest()->paginate(25),
            'avgRating' => round((float) Feedback::avg('rating'), 1),
        ]);
    }

    public function update(Request $request, Feedback $feedback): RedirectResponse
    {
        $feedback->update(['show_as_testimonial' => $request->boolean('show_as_testimonial')]);

        return back()->with('success', 'Testimonial visibility updated.');
    }

    public function destroy(Feedback $feedback): RedirectResponse
    {
        $feedback->delete();

        return back()->with('success', 'Feedback deleted.');
    }
}
