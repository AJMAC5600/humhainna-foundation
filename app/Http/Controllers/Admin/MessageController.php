<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.messages.index', [
            'messages' => ContactMessage::latest()->paginate(25),
            'unread' => ContactMessage::unread()->count(),
        ]);
    }

    public function markRead(ContactMessage $message): RedirectResponse
    {
        $message->update(['read_at' => now()]);

        return back();
    }
}
