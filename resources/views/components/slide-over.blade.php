@props([
    'title',
    'open' => 'showCreatePanel',
    'openMethod' => 'openCreatePanel',
    'closeMethod' => 'closeCreatePanel',
    'maxWidth' => 'md',
])

@php
    $maxWidthClass = match ($maxWidth) {
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
        default => 'max-w-md',
    };
@endphp

<div
    x-data="{ open: @entangle($open) }"
    x-on:keydown.escape.window="if (open) $wire.{{ $closeMethod }}()"
>
    <div
        x-show="open"
        x-cloak
        x-transition.opacity.duration.200ms
        class="fixed inset-0 z-40 bg-slate-900/40"
        @click="$wire.{{ $closeMethod }}()"
        style="display: none;"
    ></div>

    <div
        x-show="open"
        x-cloak
        x-transition:enter="transform transition ease-out duration-200"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in duration-150"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        @class([
            'fixed inset-y-0 right-0 z-50 flex w-full flex-col border-l border-slate-200 bg-white shadow-xl',
            $maxWidthClass,
        ])
        style="display: none;"
        role="dialog"
        aria-modal="true"
        aria-label="{{ $title }}"
    >
        <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
            <h2 class="truncate text-sm font-semibold text-slate-900">{{ $title }}</h2>
            <button
                type="button"
                wire:click="{{ $closeMethod }}"
                class="rounded px-2 py-1 text-lg leading-none text-slate-500 hover:bg-slate-100 hover:text-slate-800"
                aria-label="Close"
            >
                &times;
            </button>
        </div>
        <div class="flex-1 overflow-y-auto px-4 py-4">
            {{ $slot }}
        </div>
    </div>
</div>
