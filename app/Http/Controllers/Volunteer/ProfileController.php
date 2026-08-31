<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('pages.dashboard.profile', [
            'volunteer' => auth()->user()->volunteer,
        ]);
    }

    public function update(Request $request)
    {
        $volunteer = auth()->user()->volunteer;
        if (! $volunteer) {
            return redirect()->route('home');
        }

        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'digits:10'],
            'email' => ['required', 'email'],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'pincode' => ['nullable', 'digits:6'],
            'education' => ['nullable', 'string', 'max:120'],
            'occupation' => ['nullable', 'string', 'max:120'],
            'blood_group' => ['nullable', 'in:A+,A-,B+,B-,O+,O-,AB+,AB-'],
            'availability' => ['nullable', 'in:full_time,part_time,weekends,occasional'],
            'experience' => ['nullable', 'string', 'max:3000'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:20'],
            'photo' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('volunteers/photos', 'public');
        }

        $volunteer->update($data);

        return back()->with('success', 'Profile updated.');
    }
}
