@extends('layouts.admin')

@section('title', $event->exists ? 'Edit Event' : 'New Event')

@section('content')
<a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container hover:text-secondary mb-6"><span class="material-symbols-outlined text-sm">arrow_back</span> All events</a>

<form method="POST" action="{{ $event->exists ? route('admin.events.update', $event) : route('admin.events.store') }}" enctype="multipart/form-data" class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant/30 p-6 md:p-8 space-y-gutter max-w-3xl">
    @csrf
    @if ($event->exists) @method('PUT') @endif

    <div class="flex flex-col gap-1.5">
        <label class="font-label-sm text-label-sm text-on-background" for="title">Event Title *</label>
        <input id="title" name="title" required value="{{ old('title', $event->title) }}" placeholder="e.g. Free Health Checkup Camp" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="category">Category *</label>
            <select id="category" name="category" required class="rounded-lg border-outline-variant/50 bg-surface px-4 py-3 capitalize">
                @foreach (['education','health','environment','relief','fundraising','women','other'] as $cat)
                    <option value="{{ $cat }}" @selected(old('category', $event->category) === $cat)>{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="banner">Banner Image</label>
            <input type="file" id="banner" name="banner" accept="image/*" class="text-sm file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-surface-container-low file:text-primary-container file:font-semibold"/>
            @if ($event->banner_path)<img src="{{ asset('storage/'.$event->banner_path) }}" alt="" class="mt-2 h-20 w-32 object-cover rounded-md border border-outline-variant/40"/>@endif
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="starts_at">Starts At *</label>
            <input type="datetime-local" id="starts_at" name="starts_at" required value="{{ old('starts_at', $event->exists ? $event->starts_at->format('Y-m-d\TH:i') : '') }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="ends_at">Ends At</label>
            <input type="datetime-local" id="ends_at" name="ends_at" value="{{ old('ends_at', $event->exists && $event->ends_at ? $event->ends_at->format('Y-m-d\TH:i') : '') }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="md:col-span-2 flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="location">Location *</label>
            <input id="location" name="location" required value="{{ old('location', $event->location) }}" placeholder="Venue name and address" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="map_link">Google Map Embed Link</label>
            <input id="map_link" name="map_link" type="url" value="{{ old('map_link', $event->map_link) }}" placeholder="https://www.google.com/maps/embed?…" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="grid grid-cols-2 gap-gutter">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="volunteers_required">Volunteers Needed</label>
                <input type="number" min="1" id="volunteers_required" name="volunteers_required" value="{{ old('volunteers_required', $event->volunteers_required) }}" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="status">Status *</label>
                <select id="status" name="status" required class="rounded-lg border-outline-variant/50 bg-surface px-4 py-3 capitalize">
                    @foreach (['upcoming','ongoing','completed'] as $s)
                        <option value="{{ $s }}" @selected(old('status', $event->status ?? 'upcoming') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="md:col-span-2 flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="volunteer_roles">Volunteer Roles Needed</label>
            <input id="volunteer_roles" name="volunteer_roles" value="{{ old('volunteer_roles', $event->volunteer_roles) }}" placeholder="e.g. Registration desk, crowd management" class="rounded-lg border-outline-variant/50 px-4 py-3"/>
        </div>
        <div class="md:col-span-2 flex flex-col gap-1.5">
            <label class="font-label-sm text-label-sm text-on-background" for="description">Description *</label>
            <textarea id="description" name="description" rows="6" required class="rounded-lg border-outline-variant/50 px-4 py-3">{{ old('description', $event->description) }}</textarea>
        </div>
    </div>

    <label class="inline-flex items-center gap-2 cursor-pointer">
        <input type="hidden" name="registration_open" value="0"/>
        <input type="checkbox" name="registration_open" value="1" @checked(old('registration_open', $event->registration_open ?? true)) class="rounded border-outline-variant text-primary-container focus:ring-primary-container/30"/>
        <span class="font-label-sm text-label-sm">Open registrations on the website</span>
    </label>

    <button class="block bg-primary-container text-on-primary font-label-sm text-label-sm px-8 py-3 rounded-lg hover:bg-on-background transition-colors">{{ $event->exists ? 'Update Event' : 'Publish Event' }}</button>
</form>
@endsection
