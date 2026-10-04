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
    <div class="flex min-h-screen">
        <x-admin.sidebar />

        <div class="flex min-w-0 flex-1 flex-col">
            <header class="flex items-center justify-between border-b border-slate-200 bg-white px-6 py-3">
                <div class="text-sm font-medium text-slate-700">
                    {{ $header ?? ($title ?? config('dashboard.brand_subtitle', 'Admin')) }}
                </div>
                <x-admin.account.menu />
            </header>

            <main class="flex-1 px-6 py-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @foreach (config('dashboard.account.footer_livewire', []) as $footerComponent)
        @livewire($footerComponent)
    @endforeach

    @livewireScripts
</body>
</html>
