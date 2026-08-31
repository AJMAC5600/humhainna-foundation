<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') | Hum Hain Na Foundation</title>
    @include('partials.design')
</head>
<body class="bg-background text-on-background antialiased">

<div class="flex min-h-screen">
    <aside class="w-64 fixed inset-y-0 left-0 hidden lg:flex flex-col bg-primary-container text-on-primary p-4 space-y-1 z-40 overflow-y-auto">
        <a href="{{ route('admin.home') }}" class="mb-6 px-4 py-4 block">
            <span class="font-headline-md font-bold block">HHNF Admin</span>
            <span class="font-label-sm text-label-sm opacity-70">{{ auth()->user()->name }}</span>
        </a>
        @foreach ([
            'Dashboard' => ['admin.home', 'dashboard'],
            'Volunteers' => ['admin.volunteers.index', 'groups'],
            'Tasks' => ['admin.tasks.index', 'assignment'],
            'Certificates' => ['admin.certificates.index', 'workspace_premium'],
            'Events' => ['admin.events.index', 'event'],
            'Gallery' => ['admin.gallery.index', 'photo_library'],
            'Donations' => ['admin.donations.index', 'volunteer_activism'],
            'Feedback' => ['admin.feedbacks.index', 'reviews'],
            'Messages' => ['admin.messages.index', 'mail'],
            'Blog / News' => ['admin.blog.index', 'article'],
            'Site Content' => ['admin.content.edit', 'tune'],
        ] as $label => [$route, $icon])
            <a href="{{ route($route) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs($route) || (request()->routeIs('admin.*') && str_starts_with(request()->route()->getName(), str_replace('.index', '', $route))) ? 'bg-surface-tint/60 font-semibold' : 'hover:bg-white/10' }}">
                <span class="material-symbols-outlined text-xl">{{ $icon }}</span>
                <span class="font-label-sm text-label-sm">{{ $label }}</span>
                @if ($route === 'admin.messages.index' && ($n = \App\Models\ContactMessage::unread()->count()))
                    <span class="ml-auto bg-secondary-container text-white text-xs px-2 py-0.5 rounded-full">{{ $n }}</span>
                @endif
                @if ($route === 'admin.volunteers.index' && ($n = \App\Models\Volunteer::where('status', 'pending')->count()))
                    <span class="ml-auto bg-warning-amber text-primary-container text-xs px-2 py-0.5 rounded-full font-semibold">{{ $n }}</span>
                @endif
            </a>
        @endforeach
        <div class="mt-auto space-y-1 pt-4 border-t border-white/10">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-white/10"><span class="material-symbols-outlined text-xl">arrow_back</span><span class="font-label-sm text-label-sm">View Website</span></a>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-white/10 text-left"><span class="material-symbols-outlined text-xl">logout</span><span class="font-label-sm text-label-sm">Logout</span></button></form>
        </div>
    </aside>

    {{-- Mobile top bar --}}
    <div class="lg:hidden fixed top-0 w-full z-50 bg-primary-container h-16 flex items-center justify-between px-margin-mobile text-on-primary shadow-md">
        <span class="font-headline-md font-bold">HHNF Admin</span>
        <button onclick="document.getElementById('mobile-admin-nav').classList.toggle('hidden')" aria-label="Menu" class="p-2"><span class="material-symbols-outlined">menu</span></button>
    </div>
    <div id="mobile-admin-nav" class="hidden lg:hidden fixed top-16 w-full z-50 bg-primary-container text-on-primary p-4 space-y-1 max-h-[75vh] overflow-y-auto">
        @foreach (['Dashboard' => 'admin.home', 'Volunteers' => 'admin.volunteers.index', 'Tasks' => 'admin.tasks.index', 'Certificates' => 'admin.certificates.index', 'Events' => 'admin.events.index', 'Gallery' => 'admin.gallery.index', 'Donations' => 'admin.donations.index', 'Feedback' => 'admin.feedbacks.index', 'Messages' => 'admin.messages.index', 'Blog / News' => 'admin.blog.index', 'Site Content' => 'admin.content.edit'] as $label => $route)
            <a href="{{ route($route) }}" class="block px-4 py-3 rounded-lg font-label-sm text-label-sm hover:bg-white/10 {{ request()->routeIs($route) ? 'bg-surface-tint/60 font-semibold' : '' }}">{{ $label }}</a>
        @endforeach
        <form method="POST" action="{{ route('logout') }}">@csrf<button class="w-full text-left px-4 py-3 rounded-lg font-label-sm text-label-sm hover:bg-white/10">Logout</button></form>
    </div>

    <main class="flex-1 lg:ml-64 p-margin-mobile md:p-margin-desktop w-full pt-20 lg:pt-0 min-h-screen">
        <div class="max-w-container-max mx-auto space-y-gutter">
            @if (session('success'))
                <div data-autodismiss class="p-4 rounded-lg bg-success-green/10 border border-success-green/30 text-success-green font-label-sm text-label-sm flex items-start gap-2">
                    <span class="material-symbols-outlined">check_circle</span>{{ session('success') }}
                </div>
            @endif
            @if (session('volunteer_password'))
                <div class="p-4 rounded-lg bg-warning-amber/10 border border-warning-amber/40 font-label-sm text-label-sm text-on-background">
                    <strong>New volunteer login created.</strong> Share these credentials with the volunteer:<br>
                    Email: <span class="font-mono-id">{{ session('volunteer_email') }}</span>
                    Password: <span class="font-mono-id tracking-wider">{{ session('volunteer_password') }}</span>
                    <span class="block mt-1 opacity-70">This message will disappear after refresh — copy it now.</span>
                </div>
            @endif
            @yield('content')
        </div>
    </main>
</div>

<script>
    document.querySelectorAll('[data-autodismiss]').forEach(el => {
        setTimeout(() => { el.classList.add('opacity-0', 'transition-opacity', 'duration-500'); setTimeout(() => el.remove(), 500); }, 6000);
    });
</script>
@stack('scripts')
</body>
</html>
