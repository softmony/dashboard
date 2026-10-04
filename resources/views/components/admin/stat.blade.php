@props([
    'label',
    'value',
    'href' => null,
])

@php
    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" wire:navigate @endif
    {{ $attributes->class('block rounded border border-slate-200 bg-white p-4 hover:bg-slate-50') }}
>
    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">{{ $label }}</p>
    <p class="mt-1 text-2xl font-semibold text-slate-900">{{ $value }}</p>
</{{ $tag }}>
