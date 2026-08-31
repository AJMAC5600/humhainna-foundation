<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:5', 'max:5000'],
        ]);

        $data['email'] ??= null;
        $data['phone'] ??= null;

        if (empty($data['email']) && empty($data['phone'])) {
            return back()->withErrors(['email' => 'Please provide an email or phone number so we can reply.'])->withInput();
        }

        ContactMessage::create($data);

        return back()->with('success', "Message received! Our team will get back to you soon.");
    }
}
