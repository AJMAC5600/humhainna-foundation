@extends('layouts.volunteer')

@section('title', 'My Profile')

@section('content')
<header>
    <h2 class="font-headline-lg text-headline-lg text-on-background">My Profile</h2>
    <p class="font-body-md text-body-md text-on-surface-variant mt-2">Keep your details current — they appear on your ID card and certificates.</p>
</header>

@if (! $volunteer)
    <div class="bg-surface-container-low rounded-xl p-10 text-center border border-outline-variant/30">
        <span class="material-symbols-outlined text-4xl text-outline-variant">person_search</span>
        <p class="font-body-lg text-body-lg text-on-surface-variant mt-3">No volunteer profile linked to this account.</p>
    </div>
@else
    <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data" class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-surface-container p-6 md:p-8 space-y-gutter max-w-3xl">
        @csrf
        @method('PUT')
        @if (session('success'))
            <div class="p-4 rounded-lg bg-success-green/10 border border-success-green/30 text-success-green font-label-sm text-label-sm">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="p-4 rounded-lg bg-error-container border border-error/30 font-label-sm text-label-sm">{{ $errors->first() }}</div>
        @endif

        <div class="flex items-center gap-6">
            @if ($volunteer->photo_path)
                <img src="{{ asset('storage/'.$volunteer->photo_path) }}" alt="" class="w-20 h-20 rounded-full object-cover border-2 border-outline-variant/30"/>
            @endif
            <div class="flex flex-col gap-1">
                <label class="font-label-sm text-label-sm text-on-background" for="photo">Profile photo</label>
                <input id="photo" name="photo" type="file" accept="image/*" class="text-sm file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-surface-container-low file:text-primary-container file:font-semibold"/>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="full_name">Full Name *</label>
                <input id="full_name" name="full_name" required value="{{ old('full_name', $volunteer->full_name) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="mobile">Mobile *</label>
                <input id="mobile" name="mobile" required value="{{ old('mobile', $volunteer->mobile) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="email">Email *</label>
                <input id="email" name="email" type="email" required value="{{ old('email', $volunteer->email) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="blood_group">Blood Group</label>
                <select id="blood_group" name="blood_group" class="rounded-lg border-outline-variant/50 bg-surface px-4 py-3">
                    <option value="">—</option>
                    @foreach (['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
                        <option value="{{ $bg }}" @selected(old('blood_group', $volunteer->blood_group) === $bg)>{{ $bg }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2 flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="address">Address</label>
                <textarea id="address" name="address" rows="2" class="rounded-lg border-outline-variant/50 px-4 py-3">{{ old('address', $volunteer->address) }}</textarea>
            </div>
            @foreach ([['city', 'City'], ['state', 'State'], ['pincode', 'PIN Code'], ['education', 'Education'], ['occupation', 'Occupation']] as [$field, $label])
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm text-label-sm text-on-background" for="{{ $field }}">{{ $label }}</label>
                    <input id="{{ $field }}" name="{{ $field }}" value="{{ old($field, $volunteer->$field) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
                </div>
            @endforeach
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="availability">Availability</label>
                <select id="availability" name="availability" class="rounded-lg border-outline-variant/50 bg-surface px-4 py-3 capitalize">
                    <option value="">—</option>
                    @foreach (['full_time' => 'Full-time', 'part_time' => 'Part-time', 'weekends' => 'Weekends only', 'occasional' => 'Occasional'] as $v => $l)
                        <option value="{{ $v }}" @selected(old('availability', $volunteer->availability) === $v)>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="emergency_contact_name">Emergency Contact Name</label>
                <input id="emergency_contact_name" name="emergency_contact_name" value="{{ old('emergency_contact_name', $volunteer->emergency_contact_name) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="emergency_contact_phone">Emergency Contact Phone</label>
                <input id="emergency_contact_phone" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $volunteer->emergency_contact_phone) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
            </div>
            <div class="md:col-span-2 flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="experience">Experience / Skills</label>
                <textarea id="experience" name="experience" rows="3" class="rounded-lg border-outline-variant/50 px-4 py-3">{{ old('experience', $volunteer->experience) }}</textarea>
            </div>
        </div>

        <button class="bg-primary-container text-on-primary font-label-sm text-label-sm px-8 py-3.5 rounded-lg hover:bg-on-background transition-colors">Save Changes</button>
    </form>
@endif
@endsection
