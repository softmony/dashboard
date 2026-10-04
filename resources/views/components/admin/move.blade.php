@props([
    'up',
    'down',
    'upDisabled' => false,
    'downDisabled' => false,
])

<div {{ $attributes->class('flex shrink-0 gap-1') }}>
    <button
        type="button"
        class="size-9 rounded-md border border-slate-200 bg-white text-base leading-none text-green-800 hover:bg-green-50 disabled:cursor-default disabled:bg-white disabled:text-slate-300 disabled:hover:bg-white"
        aria-label="Move up"
        wire:click="{{ $up }}"
        @disabled($upDisabled)
    >↑</button>
    <button
        type="button"
        class="size-9 rounded-md border border-slate-200 bg-white text-base leading-none text-red-700 hover:bg-red-50 disabled:cursor-default disabled:bg-white disabled:text-slate-300 disabled:hover:bg-white"
        aria-label="Move down"
        wire:click="{{ $down }}"
        @disabled($downDisabled)
    >↓</button>
</div>
