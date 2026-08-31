<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Volunteer;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.dashboard', [
            'volunteersPending' => Volunteer::where('status', 'pending')->count(),
            'volunteersApproved' => Volunteer::where('status', 'approved')->count(),
            'donationsTotal' => Donation::where('status', 'completed')->sum('amount'),
            'donationsPending' => Donation::where('status', 'pending')->count(),
            'eventsUpcoming' => Event::upcoming()->count(),
            'certificatesIssued' => Certificate::count(),
            'feedbackCount' => Feedback::count(),
            'avgRating' => round((float) Feedback::avg('rating'), 1),
            'unreadMessages' => ContactMessage::unread()->count(),
            'recentVolunteers' => Volunteer::latest()->take(5)->get(),
            'recentDonations' => Donation::with([])->latest()->take(5)->get(),
        ]);
    }
}
