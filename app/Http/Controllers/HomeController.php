<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Event;
use App\Models\Feedback;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'upcomingEvents' => Event::upcoming()->take(3)->get(),
            'albums' => Album::latest('date')->take(6)->with('photos')->get(),
            'testimonials' => Feedback::where('show_as_testimonial', true)->latest()->take(3)->get(),
        ]);
    }
}
