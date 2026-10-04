@props([
    'title',
    'description' => null,
])

<div {{ $attributes->class('flex items-center justify-between gap-4') }}>
    <div class="min-w-0">
        <h1 class="text-xl font-semibold text-slate-900">{{ $title }}</h1>
        @if ($description)
            <p class="text-sm text-slate-500">{{ $description }}</p>
        @endif
    </div>
    @unless ($slot->isEmpty())
        <div class="shrink-0">{{ $slot }}</div>
    @endunless
</div>
