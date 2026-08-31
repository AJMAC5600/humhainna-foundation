<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about', ['settings' => Setting::allCached()]);
    }

    public function achievements(): View
    {
        return view('pages.achievements', [
            'counters' => Achievement::counters()->get(),
            'awards' => Achievement::ofType('award')->get(),
            'media' => Achievement::ofType('media')->get(),
            'stories' => Achievement::ofType('story')->get(),
            'milestones' => Achievement::ofType('milestone')->orderBy('date')->get(),
        ]);
    }

    public function faq(): View
    {
        return view('pages.faq', ['faqs' => Faq::orderBy('sort_order')->get()]);
    }
}
