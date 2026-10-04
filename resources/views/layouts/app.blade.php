<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    @if ($vite = config('dashboard.vite'))
        @vite($vite)
    @endif
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-3">
            <a
                href="{{ ($brand = config('dashboard.brand_route')) ? route($brand) : '#' }}"
                class="text-lg font-semibold tracking-tight"
            >
                {{ config('app.name') }}
            </a>
            @auth
                <form method="POST" action="{{ route(config('dashboard.logout_route', 'logout')) }}">
                    @csrf
                    <button type="submit" class="text-sm text-slate-600 hover:text-slate-900">Log out</button>
                </form>
            @endauth
        </div>
    </header>
    <main class="mx-auto max-w-5xl px-4 py-8">
        {{ $slot }}
    </main>
    @livewireScripts
</body>
</html>
