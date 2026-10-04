@props([
    'variant' => 'primary',
    'type' => 'button',
    'size' => 'md',
])

@php
    $padding = $size === 'sm' ? 'px-3 py-2' : 'px-4 py-2';

    $classes = match ($variant) {
        'secondary' => "rounded border border-slate-300 bg-white {$padding} text-sm text-slate-700 hover:bg-slate-50 disabled:cursor-default disabled:opacity-60",
        'danger' => "rounded border border-red-300 bg-white {$padding} text-sm text-red-700 hover:bg-red-50 disabled:cursor-default disabled:opacity-60",
        'link' => 'border-0 bg-transparent p-0 text-sm text-slate-900 underline',
        default => "rounded bg-slate-900 {$padding} text-sm font-medium text-white hover:bg-slate-700 disabled:cursor-default disabled:opacity-60",
    };
@endphp

<button type="{{ $type }}" {{ $attributes->class($classes) }}>
    {{ $slot }}
</button>
