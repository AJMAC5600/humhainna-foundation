<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function show(): View
    {
        return view('pages.feedback');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'person_type' => ['required', 'in:volunteer,donor,beneficiary,visitor,partner'],
            'related_to' => ['required', 'in:event,volunteering,donation,website,general'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comments' => ['required', 'string', 'min:5', 'max:3000'],
            'testimonial_consent' => ['sometimes', 'boolean'],
        ]);

        Feedback::create($data);

        return back()->with('success', 'Thank you for your feedback! It means a lot to us.');
    }
}
