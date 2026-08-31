<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Volunteer Portal') | Hum Hain Na Foundation</title>
    @include('partials.design')
</head>
<body class="bg-background text-on-background antialiased flex">

<nav class="h-full w-64 fixed left-0 top-0 hidden lg:flex flex-col bg-surface-container-low shadow-md p-4 space-y-2 z-40">
    <a href="{{ route('home') }}" class="mb-8 px-4 flex items-center gap-3 mt-2">
        <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-headline-md font-bold">H</div>
        <div>
            <h1 class="font-headline-md text-headline-md text-primary-container leading-tight">Volunteer Portal</h1>
            <p class="font-label-sm text-label-sm text-on-surface-variant">Impact Tracker</p>
        </div>
    </a>
    <div class="flex-1 space-y-1">
        @foreach ([
            'Tasks & Impact' => ['dashboard.home', 'assignment'],
            'My ID Card' => ['dashboard.idcard.show', 'badge'],
            'Profile' => ['dashboard.profile.edit', 'person'],
            'Back to Website' => ['home', 'arrow_back'],
        ] as $label => [$route, $icon])
            @php($active = str_starts_with($route, 'dashboard') ? request()->routeIs(str_replace('.show', '.*', $route)) : request()->routeIs($route))
            <a href="{{ route($route) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ $active ? 'bg-primary-container text-on-primary-container font-bold translate-x-1' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                <span class="material-symbols-outlined">{{ $icon }}</span>
                <span class="font-label-sm text-label-sm">{{ $label }}</span>
            </a>
        @endforeach
    </div>
    <form method="POST" action="{{ route('logout') }}" class="px-2">
        @csrf
        <button class="w-full bg-primary text-on-primary rounded-lg py-3 font-label-sm text-label-sm hover:opacity-90 transition-opacity">Logout</button>
    </form>
</nav>

{{-- Mobile top bar --}}
<div class="lg:hidden fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md shadow-sm h-16 flex items-center justify-between px-margin-mobile">
    <span class="font-headline-md font-bold text-primary-container">Volunteer Portal</span>
    <button onclick="document.getElementById('mobile-dash-nav').classList.toggle('hidden')" aria-label="Menu" class="text-on-surface-variant"><span class="material-symbols-outlined">menu</span></button>
</div>
<div id="mobile-dash-nav" class="hidden lg:hidden fixed top-16 w-full z-50 bg-surface shadow-md p-4 space-y-1">
    <a href="{{ route('dashboard.home') }}" class="block px-4 py-3 rounded-lg font-label-sm text-label-sm {{ request()->routeIs('dashboard.home') ? 'bg-primary-container text-on-primary-container' : 'text-on-surface-variant' }}">Tasks & Impact</a>
    <a href="{{ route('dashboard.idcard.show') }}" class="block px-4 py-3 rounded-lg font-label-sm text-label-sm {{ request()->routeIs('dashboard.idcard.*') ? 'bg-primary-container text-on-primary-container' : 'text-on-surface-variant' }}">My ID Card</a>
    <a href="{{ route('dashboard.profile.edit') }}" class="block px-4 py-3 rounded-lg font-label-sm text-label-sm {{ request()->routeIs('dashboard.profile.*') ? 'bg-primary-container text-on-primary-container' : 'text-on-surface-variant' }}">Profile</a>
    <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg font-label-sm text-label-sm text-on-surface-variant">Back to Website</a>
    <form method="POST" action="{{ route('logout') }}">@csrf<button class="w-full text-left px-4 py-3 rounded-lg font-label-sm text-label-sm text-error">Logout</button></form>
</div>

<main class="flex-1 lg:ml-64 p-margin-mobile md:p-margin-desktop min-h-screen pt-20 lg:pt-0 w-full">
    <div class="max-w-container-max mx-auto space-y-section-gap-sm">
        @if (session('success'))
            <div data-autodismiss class="p-4 rounded-lg bg-success-green/10 border border-success-green/30 text-success-green font-label-sm text-label-sm flex items-start gap-2">
                <span class="material-symbols-outlined">check_circle</span>{{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>
</main>

<script>
    document.querySelectorAll('[data-autodismiss]').forEach(el => {
        setTimeout(() => { el.classList.add('opacity-0', 'transition-opacity', 'duration-500'); setTimeout(() => el.remove(), 500); }, 6000);
    });
</script>
@stack('scripts')
</body>
</html>
