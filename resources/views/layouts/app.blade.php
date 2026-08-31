<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hum Hain Na Foundation')</title>
    <meta name="description" content="@yield('meta_description', 'Hum Hain Na Foundation — an NGO working across education, health, environment and relief. Volunteer, donate, create change.')">
    @include('partials.design')
</head>
<body class="bg-background text-on-background antialiased flex flex-col min-h-screen">

<header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md shadow-sm">
    <div class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto h-20">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <span class="font-headline-md text-headline-md font-bold text-primary-container">Hum Hain Na</span>
        </a>
        <nav class="hidden lg:flex gap-8 items-center h-full">
            @foreach ([
                'Home' => route('home'),
                'About' => route('about'),
                'Our Work' => route('gallery.index'),
                'Events' => route('events.index'),
                'Volunteer' => route('volunteer.apply.form'),
            ] as $label => $href)
                <a class="font-label-sm text-label-sm {{ request()->url() === $href ? 'text-primary-container border-b-2 border-primary-container pb-1 translate-y-[2px] font-semibold' : 'text-on-surface-variant hover:text-primary-container' }} transition-colors h-full flex items-center" href="{{ $href }}">{{ $label }}</a>
            @endforeach
        </nav>
        <div class="flex items-center gap-3">
            @auth
                <a href="{{ auth()->user()->isAdmin() ? route('admin.home') : route('dashboard.home') }}" aria-label="Account" title="My account" class="text-on-surface-variant hover:text-primary-container transition-colors flex items-center">
                    <span class="material-symbols-outlined text-2xl">account_circle</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="hidden md:block font-label-sm text-label-sm text-on-surface-variant hover:text-primary-container transition-colors">Login</a>
            @endauth
            <a href="{{ route('donate.show') }}" class="bg-secondary text-on-secondary font-label-sm text-label-sm px-6 py-2.5 rounded-lg shadow-sm hover:opacity-90 hover:-translate-y-0.5 transition-all active:scale-95 inline-block">
                Donate Now
            </a>
            <button onclick="document.getElementById('mobile-nav').classList.toggle('hidden')" aria-label="Menu" class="lg:hidden text-on-surface-variant">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </div>
    </div>
    <div id="mobile-nav" class="hidden lg:hidden bg-surface border-t border-outline-variant/30 px-margin-mobile py-4 space-y-1">
        @foreach ([
            'Home' => route('home'),
            'About' => route('about'),
            'Our Work' => route('gallery.index'),
            'Achievements' => route('achievements'),
            'Events' => route('events.index'),
            'Volunteer' => route('volunteer.apply.form'),
            'Certificates & Verification' => route('certificates.info'),
            'Blog / News' => route('blog.index'),
            'FAQ' => route('faq'),
            'Contact' => route('contact.show'),
        ] as $label => $href)
            <a class="block font-label-sm text-label-sm px-4 py-3 rounded-lg {{ request()->url() === $href ? 'bg-surface-container-low text-primary-container font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low' }}" href="{{ $href }}">{{ $label }}</a>
        @endforeach
        <div class="pt-2 border-t border-outline-variant/20">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left font-label-sm text-label-sm px-4 py-3 rounded-lg text-error">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block font-label-sm text-label-sm px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-low">Login</a>
        @endauth
        </div>
    </div>
</header>

<main class="flex-grow pt-24">
    @yield('content')
</main>

{{-- Footer Shared Component --}}
<footer class="w-full py-section-gap-sm mt-auto bg-primary-container">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter px-margin-desktop max-w-container-max mx-auto">
        <div class="md:col-span-4 flex flex-col gap-4">
            <span class="font-headline-md text-headline-md text-on-primary">Hum Hain Na Foundation</span>
            <p class="font-body-md text-body-md text-on-primary/80">{{ \App\Models\Setting::get('footer_note', '© '.now()->year.' Hum Hain Na Foundation. All rights reserved.') }}</p>
            <div class="flex gap-4 pt-2">
                @foreach ([
                    ['facebook', \App\Models\Setting::get('social_facebook')],
                    ['photo_camera', \App\Models\Setting::get('social_instagram')],
                    ['alternate_email', \App\Models\Setting::get('social_twitter')],
                    ['smart_display', \App\Models\Setting::get('social_youtube')],
                    ['business_center', \App\Models\Setting::get('social_linkedin')],
                ] as [$icon, $url])
                    @if ($url)
                        <a href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ $icon }}" class="text-on-primary/70 hover:text-on-primary transition-colors"><span class="material-symbols-outlined">{{ $icon }}</span></a>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="md:col-span-8 grid grid-cols-2 sm:grid-cols-3 gap-x-8 gap-y-4 md:justify-items-end content-start mt-4 md:mt-0">
            <a class="font-label-sm text-label-sm text-on-primary/80 hover:text-on-primary hover:underline transition-all" href="{{ route('about') }}">About Us</a>
            <a class="font-label-sm text-label-sm text-on-primary/80 hover:text-on-primary hover:underline transition-all" href="{{ route('achievements') }}">Achievements</a>
            <a class="font-label-sm text-label-sm text-on-primary/80 hover:text-on-primary hover:underline transition-all" href="{{ route('events.index') }}">Events</a>
            <a class="font-label-sm text-label-sm text-on-primary/80 hover:text-on-primary hover:underline transition-all" href="{{ route('volunteer.apply.form') }}">Get Involved</a>
            <a class="font-label-sm text-label-sm text-on-primary/80 hover:text-on-primary hover:underline transition-all" href="{{ route('certificates.info') }}">Verify Certificate / ID</a>
            <a class="font-label-sm text-label-sm text-on-primary/80 hover:text-on-primary hover:underline transition-all" href="{{ route('privacy') }}">Privacy Policy</a>
            <a class="font-label-sm text-label-sm text-on-primary/80 hover:text-on-primary hover:underline transition-all" href="{{ route('terms') }}">Terms of Service</a>
            <a class="font-label-sm text-label-sm text-on-primary/80 hover:text-on-primary hover:underline transition-all" href="{{ route('feedback.show') }}">Feedback</a>
            <a class="font-label-sm text-label-sm text-on-primary/80 hover:text-on-primary hover:underline transition-all" href="{{ route('contact.show') }}">Contact Us</a>
        </div>
    </div>
</footer>

@php($wa = \App\Models\Setting::get('whatsapp_number'))
@if ($wa)
<a href="https://wa.me/{{ preg_replace('/\D/', '', $wa) }}?text={{ urlencode('Hello Hum Hain Na Foundation!') }}"
   target="_blank" rel="noopener"
   aria-label="Chat with us on WhatsApp"
   class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-success-green text-white rounded-full shadow-[0_8px_20px_rgba(16,185,129,0.35)] flex items-center justify-center hover:scale-105 transition-transform">
    <span class="material-symbols-outlined text-2xl">chat</span>
</a>
@endif

<script>
    // Auto-hide success banners after 6s
    document.querySelectorAll('[data-autodismiss]').forEach(el => {
        setTimeout(() => { el.classList.add('opacity-0', 'transition-opacity', 'duration-500'); setTimeout(() => el.remove(), 500); }, 6000);
    });
</script>
@stack('scripts')
</body>
</html>
