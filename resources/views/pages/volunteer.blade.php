@extends('layouts.app')

@section('title', 'Volunteer With Us | Hum Hain Na Foundation')

@section('content')
{{-- Hero --}}
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center min-h-[520px] bg-surface-container-low rounded-[2rem] overflow-hidden relative shadow-sm border border-outline-variant/30">
        <div class="lg:col-span-5 p-8 md:p-12 flex flex-col justify-center z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container-high rounded-full w-fit mb-6 shadow-[0_2px_10px_rgba(9,22,74,0.04)] border border-outline-variant/50">
                <span class="w-2 h-2 rounded-full bg-success-green"></span>
                <span class="font-label-sm text-label-sm text-on-surface-variant">Join our active volunteers</span>
            </div>
            <h1 class="font-display-lg text-display-lg text-on-background mb-6">Become a <br/><span class="text-secondary">Change Maker</span></h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-8">
                Your time is the most valuable donation. Join the Hum Hain Na Foundation to drive transparent, community-led impact across education, health, and environment.
            </p>
            <div class="flex flex-wrap gap-4">
                <a class="bg-primary-container text-on-primary font-label-sm text-label-sm px-8 py-3 rounded-lg shadow-[0_4px_12px_rgba(9,22,74,0.15)] hover:bg-on-background transition-all flex items-center gap-2 hover:-translate-y-0.5" href="#register-form">
                    Register Now
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
                <a class="border border-outline bg-surface/50 backdrop-blur-sm text-on-background font-label-sm text-label-sm px-8 py-3 rounded-lg hover:bg-surface-variant transition-colors" href="#areas-of-work">
                    Explore Roles
                </a>
            </div>
        </div>
        <div class="lg:col-span-7 h-full min-h-[320px] relative bg-gradient-to-br from-primary-container via-surface-tint to-secondary">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 16px 16px;"></div>
        </div>
    </div>
</section>

{{-- Why Volunteer --}}
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg">
    <div class="text-center mb-12">
        <h2 class="font-headline-lg text-headline-lg text-on-background mb-4">Why Volunteer with Us?</h2>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto">Experience utility-driven transparency. We provide you with the tools, training, and tracking to see the direct result of your efforts.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-gutter auto-rows-auto md:auto-rows-[240px]">
        <div class="bg-primary-container text-on-primary rounded-xl p-8 flex flex-col justify-between shadow-[0_4px_16px_rgba(9,22,74,0.1)] lg:col-span-2 relative overflow-hidden group hover:shadow-[0_8px_24px_rgba(9,22,74,0.15)] transition-shadow">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 opacity-10 transform group-hover:scale-110 transition-transform duration-500">
                <span class="material-symbols-outlined" style="font-size: 200px;">volunteer_activism</span>
            </div>
            <div>
                <span class="material-symbols-outlined text-secondary mb-4 text-3xl !text-secondary-fixed-dim">public</span>
                <h3 class="font-headline-md text-headline-md mb-2">Verified Impact</h3>
                <p class="font-body-md text-body-md opacity-90 max-w-sm">Every hour logged translates to verifiable community upliftment, tracked through your volunteer dashboard.</p>
            </div>
            <div class="mt-4">
                <span class="font-display-lg text-display-lg leading-none">{{ \App\Models\Achievement::ofType('counter')->where('title', 'like', '%lives%')->value('value') ?? '5,000+' }}</span>
                <span class="font-label-sm text-label-sm uppercase tracking-wider block mt-1 opacity-80">Lives Touched</span>
            </div>
        </div>

        @foreach ([['school', 'Skill Building', 'Gain professional experience in logistics, teaching, and event management.'], ['badge', 'Official ID & Certificates', 'Receive an official foundation ID card and certificates of appreciation you can verify online.'], ['task_alt', 'Real Task Tracking', 'Assignments with clear deadlines and proof-based verification of your work.'], ['groups', 'Supportive Community', 'A network of compassionate people institutionalizing social welfare through structured action.'] ] as [$icon, $title, $desc])
            <div class="bg-surface rounded-xl p-6 border border-outline-variant/40 shadow-sm flex flex-col hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 rounded-full bg-surface-container-low flex items-center justify-center mb-4 text-primary-container">
                    <span class="material-symbols-outlined">{{ $icon }}</span>
                </div>
                <h3 class="font-headline-md text-headline-md mb-2 text-on-background !text-lg">{{ $title }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant text-sm flex-grow">{{ $desc }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- Areas of Work --}}
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-section-gap-lg" id="areas-of-work">
    <div class="flex justify-between items-end mb-8 border-b border-outline-variant/30 pb-4">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-background">Areas of Work</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2">Where your skills can make the most difference.</p>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
        @foreach ([['menu_book', 'Education Drives', 'Assist in weekend teaching programs, digital literacy workshops, and distributing school supplies to marginalized youth.', 'education'], ['medical_services', 'Health Camps', 'Support medical professionals with patient registration, crowd management, and basic vitals checking during community health camps.', 'health_camps'], ['local_shipping', 'Distribution Drives', 'Manage logistics, packing, and systematic distribution of food rations, clothing, and disaster relief materials.', 'distribution_drives'], ['forest', 'Environment', 'Participate in organized tree plantation drives, urban clean-ups, and sustainability awareness campaigns.', 'environment']] as [$icon, $title, $desc, $value])
            <div class="bg-surface rounded-xl overflow-hidden shadow-[0_2px_8px_rgba(9,22,74,0.06)] border border-outline-variant/20 hover:shadow-[0_8px_24px_rgba(9,22,74,0.12)] transition-all duration-300 p-6 flex flex-col h-full">
                <div class="w-12 h-12 rounded-full bg-surface-container-low flex items-center justify-center mb-4 text-primary-container">
                    <span class="material-symbols-outlined">{{ $icon }}</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-background !text-xl mb-2">{{ $title }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant text-sm mb-4 flex-grow">{{ $desc }}</p>
                <button type="button" onclick="checkInterest('{{ $value }}')" class="font-label-sm text-label-sm text-primary-container font-semibold inline-flex items-center gap-1 hover:text-secondary transition-colors w-fit">
                    Select Role <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </div>
        @endforeach
    </div>
</section>

{{-- Registration Form --}}
<section class="max-w-4xl mx-auto px-margin-mobile md:px-margin-desktop pb-section-gap-sm" id="register-form">
    <div class="bg-surface rounded-2xl shadow-[0_8px_30px_rgba(9,22,74,0.08)] border border-outline-variant/20 overflow-hidden relative">
        <div class="h-2 w-full bg-gradient-to-r from-primary-container via-surface-tint to-secondary"></div>
        <div class="p-6 md:p-12">
            <div class="mb-10 text-center">
                <span class="material-symbols-outlined text-primary-container text-4xl mb-4">app_registration</span>
                <h2 class="font-headline-lg text-headline-lg text-on-background mb-2">Volunteer Registration</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Complete this form to initiate your onboarding. Our team reviews every application.</p>
            </div>

            @if (session('success'))
                <div data-autodismiss class="mb-8 p-5 rounded-lg bg-success-green/10 border border-success-green/40 text-success-green font-body-md text-body-md flex items-start gap-3">
                    <span class="material-symbols-outlined">check_circle</span>{{ session('success') }}
                </div>
            @else
                <form action="{{ route('volunteer.apply') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    @if ($errors->any())
                        <div class="p-4 rounded-lg bg-error-container text-on-error-container border border-error/30 font-label-sm text-label-sm space-y-1">
                            <strong class="block">Please fix the highlighted fields:</strong>
                            @foreach ($errors->all() as $err)
                                <p>• {{ $err }}</p>
                            @endforeach
                        </div>
                    @endif

                    {{-- Personal details --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="full_name">Full Name *</label>
                            <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm" id="full_name" name="full_name" placeholder="Jane Doe" value="{{ old('full_name') }}" required type="text"/>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="dob">Date of Birth *</label>
                            <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm" id="dob" name="dob" value="{{ old('dob') }}" required type="date"/>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-sm text-label-sm text-on-background" for="photo">Profile Photo * <span class="text-on-surface-variant font-normal">(used on your official ID card)</span></label>
                        <input id="photo" name="photo" type="file" accept="image/*" required class="block w-full text-sm file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:bg-surface-container-low file:text-primary-container file:font-semibold hover:file:bg-surface-container-high cursor-pointer"/>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="gender">Gender *</label>
                            <select class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3" id="gender" name="gender" required>
                                <option value="">Select…</option>
                                @foreach (['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $v => $l)
                                    <option value="{{ $v }}" @selected(old('gender') === $v)>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="blood_group">Blood Group</label>
                            <select class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3" id="blood_group" name="blood_group">
                                <option value="">Select…</option>
                                @foreach (['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
                                    <option value="{{ $bg }}" @selected(old('blood_group') === $bg)>{{ $bg }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="mobile">Mobile Number *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-on-surface-variant">+91</span>
                                <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 pl-12 pr-4 py-3 w-full shadow-sm" id="mobile" name="mobile" placeholder="98765 43210" value="{{ old('mobile') }}" required type="tel"/>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-sm text-label-sm text-on-background" for="email">Email Address *</label>
                        <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm" id="email" name="email" placeholder="jane.doe@example.com" value="{{ old('email') }}" required type="email"/>
                    </div>

                    {{-- Address --}}
                    <fieldset class="border border-outline-variant/40 rounded-lg p-5 pt-4">
                        <legend class="font-label-sm text-label-sm font-semibold text-on-background px-2">Address *</legend>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <textarea class="md:col-span-3 rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3" name="address" rows="2" placeholder="House / street / area *" required>{{ old('address') }}</textarea>
                            <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3" name="city" placeholder="City *" value="{{ old('city') }}" required type="text"/>
                            <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3" name="state" placeholder="State *" value="{{ old('state') }}" required type="text"/>
                            <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3" name="pincode" placeholder="PIN code *" value="{{ old('pincode') }}" required inputmode="numeric" pattern="[0-9]{6}" title="6-digit PIN code"/>
                        </div>
                    </fieldset>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="education">Education Qualification</label>
                            <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm" id="education" name="education" placeholder="e.g. B.Tech, Class 12…" value="{{ old('education') }}" type="text"/>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="occupation">Occupation</label>
                            <input class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm" id="occupation" name="occupation" placeholder="e.g. Student, Teacher…" value="{{ old('occupation') }}" type="text"/>
                        </div>
                    </div>

                    {{-- Areas of interest --}}
                    <div class="flex flex-col gap-2 pt-2">
                        <label class="font-label-sm text-label-sm text-on-background mb-1">Areas of Interest * <span class="text-on-surface-variant font-normal">(choose any)</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach ([['education', 'Education / Teaching'], ['health_camps', 'Health Camps'], ['fundraising', 'Fundraising'], ['event_management', 'Event Management'], ['social_media', 'Social Media'], ['environment', 'Environment'], ['distribution_drives', 'Distribution Drives'], ['others', 'Others']] as [$value, $label])
                                <label class="relative flex cursor-pointer rounded-lg border {{ old('areas_of_interest') && in_array($value, old('areas_of_interest')) ? 'border-primary-container ring-1 ring-primary-container/30 bg-surface-container-low' : 'border-outline-variant/40 bg-surface' }} p-4 shadow-sm hover:bg-surface-container-low transition-colors">
                                    <input class="sr-only peer" name="areas_of_interest[]" type="checkbox" value="{{ $value }}" onchange="this.closest('label').classList.toggle('border-primary-container', this.checked); this.closest('label').classList.toggle('ring-1', this.checked); this.closest('label').classList.toggle('ring-primary-container/30', this.checked)" @checked(old('areas_of_interest') && in_array($value, old('areas_of_interest')))/>
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full border border-outline-variant peer-checked:border-[7px] peer-checked:border-primary-container transition-all flex-shrink-0"></div>
                                        <span class="font-body-md text-body-md text-on-background">{{ $label }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background" for="availability">Availability *</label>
                            <select class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3" id="availability" name="availability" required>
                                <option value="">Select…</option>
                                @foreach (['full_time' => 'Full-time', 'part_time' => 'Part-time', 'weekends' => 'Weekends only', 'occasional' => 'Occasional'] as $v => $l)
                                    <option value="{{ $v }}" @selected(old('availability') === $v)>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm text-label-sm text-on-background">Emergency Contact — Name & Phone *</label>
                            <div class="flex gap-3">
                                <input class="w-1/2 rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm" name="emergency_contact_name" placeholder="Name *" value="{{ old('emergency_contact_name') }}" required type="text"/>
                                <input class="w-1/2 rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm" name="emergency_contact_phone" placeholder="Phone *" value="{{ old('emergency_contact_phone') }}" required type="tel"/>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-sm text-label-sm text-on-background" for="experience">Previous Volunteering Experience</label>
                        <textarea class="rounded-lg border-outline-variant/50 bg-surface focus:border-primary-container focus:ring-primary-container/20 px-4 py-3" id="experience" name="experience" rows="3" placeholder="Optional — tell us where you've volunteered before…">{{ old('experience') }}</textarea>
                    </div>

                    {{-- ID proof --}}
                    <div class="flex flex-col gap-1.5 pt-2">
                        <label class="font-label-sm text-label-sm text-on-background">Upload ID Proof (Aadhaar / PAN / College ID) *</label>
                        <p class="text-xs text-on-surface-variant mb-2">Required for issuing your official volunteer ID card. Kept private & secure. Max size 2MB.</p>
                        <div class="mt-1 flex justify-center rounded-lg border border-dashed border-outline-variant/80 px-6 py-8 hover:bg-surface-container-low transition-colors cursor-pointer group">
                            <div class="text-center">
                                <span class="material-symbols-outlined text-4xl text-outline-variant group-hover:text-primary-container transition-colors mb-2">cloud_upload</span>
                                <div class="mt-2 flex text-sm leading-6 text-on-surface-variant justify-center">
                                    <label class="relative cursor-pointer rounded-md font-label-sm text-label-sm text-primary-container font-semibold hover:text-secondary transition-colors" for="id_proof">
                                        <span>Upload a file</span>
                                        <input class="sr-only" id="id_proof" name="id_proof" type="file" accept=".jpg,.jpeg,.png,.pdf" required/>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs leading-5 text-on-surface-variant mt-1">PNG, JPG or PDF up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    {{-- Consent --}}
                    <label class="flex items-start gap-3 pt-2 cursor-pointer">
                        <input type="checkbox" name="consent" value="1" required class="mt-1 rounded border-outline-variant text-primary-container focus:ring-primary-container/30"/>
                        <span class="font-body-md text-body-md text-on-surface-variant text-sm">I agree to the terms & conditions and code of conduct of Hum Hain Na Foundation, and confirm that the information provided is true.*</span>
                    </label>

                    <div class="pt-4">
                        <button class="w-full bg-primary-container text-on-primary font-label-sm text-label-sm py-4 rounded-lg shadow-sm hover:bg-on-background transition-all flex items-center justify-center gap-2 text-base" type="submit">
                            Submit Registration
                            <span class="material-symbols-outlined text-xl">how_to_reg</span>
                        </button>
                        <p class="text-center text-xs text-on-surface-variant mt-4">
                            Already applied? Once approved, <a class="underline hover:text-primary-container" href="{{ route('login') }}">log in to your dashboard</a>.
                        </p>
                    </div>
                </form>
            @endif
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function checkInterest(value) {
    const cb = document.querySelector(`input[name="areas_of_interest[]"][value="${value}"]`);
    if (!cb) return;
    cb.checked = true;
    const label = cb.closest('label');
    label.classList.add('border-primary-container','ring-1','ring-primary-container/30','bg-surface-container-low');
}
</script>
@endpush
