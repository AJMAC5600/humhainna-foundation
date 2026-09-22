<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Contracts\View\View;

class VolunteerController extends Controller
{
    public function show(): View
    {
        return view('pages.volunteer');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'image', 'max:4096'],
            'dob' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'in:male,female,other'],
            'mobile' => ['required', 'regex:/^[6-9][0-9]{9}$/'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'pincode' => ['required', 'digits:6'],
            'education' => ['nullable', 'string', 'max:120'],
            'occupation' => ['nullable', 'string', 'max:120'],
            'blood_group' => ['nullable', 'in:A+,A-,B+,B-,O+,O-,AB+,AB-'],
            'areas_of_interest' => ['required', 'array', 'min:1'],
            'areas_of_interest.*' => ['string'],
            'availability' => ['required', 'in:full_time,part_time,weekends,occasional'],
            'experience' => ['nullable', 'string', 'max:3000'],
            'id_proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:4096'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_phone' => ['required', 'regex:/^[6-9][0-9]{9}$/'],
            'consent' => ['accepted'],
        ], [
            'consent.accepted' => 'You must accept the volunteer code of conduct to continue.',
            'mobile.regex' => 'Mobile number 10 digit ka ho aur 6-9 se start ho (jaise 9876543210).',
            'emergency_contact_phone.regex' => 'Emergency phone bhi 10 digit ka valid mobile hona chahiye.',
            'pincode.digits' => 'Enter a valid 6-digit PIN code.',
        ]);

        $photoPath = $request->file('photo')->store('volunteers/photos', 'public');
        $proofPath = $request->file('id_proof')->store('volunteers/id-proofs');

        Volunteer::create([
            ...collect($data)->except(['photo', 'id_proof', 'consent'])->all(),
            'photo_path' => $photoPath,
            'id_proof_path' => $proofPath,
            'status' => 'pending',
        ]);

        return back()->with('success',
            'Application submitted! Our team will review it shortly — once approved you can log in and download your volunteer ID card.');
    }
}
