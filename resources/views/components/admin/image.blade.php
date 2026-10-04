@props([
    'src' => null,
    'preview' => null,
    'inputId',
    'empty' => 'No image',
    'target' => null,
    'uploadLabel' => 'Upload',
    'uploadingLabel' => 'Uploading…',
])

@php
    $shown = $preview ?: $src;
@endphp

<div>
    <div class="flex h-[220px] w-full max-w-full items-center justify-center overflow-hidden rounded-md border border-slate-200 bg-slate-50 has-[img]:w-fit">
        @if ($shown)
            <img src="{{ $shown }}" alt="" class="block h-full w-auto max-w-full object-contain">
        @else
            <span class="text-xs text-slate-400">{{ $empty }}</span>
        @endif
    </div>
    <div class="mt-2 flex flex-wrap gap-2">
        <input
            id="{{ $inputId }}"
            type="file"
            wire:key="{{ $inputId }}"
            {{ $attributes->class('sr-only') }}
        />
        <button
            type="button"
            class="rounded bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700 disabled:cursor-default disabled:opacity-60"
            onclick="document.getElementById({{ \Illuminate\Support\Js::from($inputId) }}).click()"
            @if ($target) wire:loading.attr="disabled" wire:target="{{ $target }}" @endif
        >
            @if ($target)
                <span wire:loading.remove wire:target="{{ $target }}">{{ $uploadLabel }}</span>
                <span wire:loading wire:target="{{ $target }}">{{ $uploadingLabel }}</span>
            @else
                {{ $uploadLabel }}
            @endif
        </button>
        {{ $actions ?? '' }}
    </div>
</div>
