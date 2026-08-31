@extends('layouts.app')

@section('title', 'Login | Hum Hain Na Foundation')

@section('content')
<section class="max-w-md mx-auto px-margin-mobile pb-section-gap-lg">
    <div class="bg-surface rounded-2xl shadow-[0_8px_30px_rgba(9,22,74,0.08)] border border-outline-variant/20 overflow-hidden">
        <div class="h-2 w-full bg-gradient-to-r from-primary-container via-surface-tint to-secondary"></div>
        <form method="POST" action="{{ route('login.attempt') }}" class="p-8 md:p-10 space-y-6">
            @csrf
            <div class="text-center">
                <span class="material-symbols-outlined text-primary-container text-4xl">account_circle</span>
                <h1 class="font-headline-lg text-headline-lg text-on-background mt-2">Welcome Back</h1>
                <p class="font-label-sm text-label-sm text-on-surface-variant mt-1">Volunteers & team members log in here.</p>
            </div>

            @if ($errors->any())
                <div class="p-4 rounded-lg bg-error-container border border-error/30 font-label-sm text-label-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="email">Email</label>
                <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}" class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm"/>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-on-background" for="password">Password</label>
                <input id="password" name="password" type="password" required class="rounded-lg border-outline-variant/50 focus:border-primary-container focus:ring-primary-container/20 px-4 py-3 shadow-sm"/>
            </div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="rounded border-outline-variant text-primary-container focus:ring-primary-container/30"/>
                <span class="font-label-sm text-label-sm text-on-surface-variant">Remember me</span>
            </label>
            <button class="w-full bg-primary-container text-on-primary font-label-sm text-label-sm py-3.5 rounded-lg hover:bg-on-background transition-all">Log In</button>
            <p class="text-center text-xs text-on-surface-variant">Not a volunteer yet? <a href="{{ route('volunteer.apply.form') }}" class="underline text-primary-container">Apply now</a></p>
        </form>
    </div>
</section>
@endsection
