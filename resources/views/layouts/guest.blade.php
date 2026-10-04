<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Sign in' }} — {{ config('app.name') }}</title>
    @if ($vite = config('dashboard.vite'))
        @vite($vite)
    @endif
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <div class="flex min-h-screen flex-col items-center justify-center px-4 py-10">
        <div class="mb-6 text-center">
            <p class="text-lg font-semibold text-slate-900">{{ config('app.name') }}</p>
            @if ($tagline = config('dashboard.guest_tagline'))
                <p class="text-sm text-slate-500">{{ $tagline }}</p>
            @endif
        </div>
        {{ $slot }}
    </div>
    @livewireScripts
</body>
</html>
