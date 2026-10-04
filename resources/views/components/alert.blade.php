@props([
    'type' => 'info',
    'title' => null,
])

@php
    $palette = match ($type) {
        'success' => 'border-emerald-300 bg-emerald-50 text-emerald-950',
        'warning' => 'border-amber-300 bg-amber-50 text-amber-950',
        'danger' => 'border-red-300 bg-red-50 text-red-950',
        default => 'border-slate-300 bg-slate-50 text-slate-900',
    };

    $role = $type === 'danger' || $type === 'warning' ? 'alert' : 'status';
@endphp

<div
    {{ $attributes->class("rounded border px-3 py-2.5 text-sm {$palette}") }}
    role="{{ $role }}"
>
    @if ($title)
        <p class="font-semibold">{{ $title }}</p>
    @endif
    <div @class(['mt-0.5' => (bool) $title, 'text-slate-700' => $type === 'info'])>
        {{ $slot }}
    </div>
</div>
