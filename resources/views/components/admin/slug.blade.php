@props([
    'regenerate' => 'regenerateSlug',
])

<div class="flex overflow-hidden rounded border border-slate-300 bg-white focus-within:border-slate-900">
    <input {{ $attributes->class('min-w-0 flex-1 border-0 bg-transparent px-3 py-2 font-mono text-sm text-slate-900 focus:outline-none') }} />
    <button
        type="button"
        class="flex w-9 shrink-0 items-center justify-center border-l border-slate-300 bg-white text-slate-700 hover:bg-slate-50"
        wire:click="{{ $regenerate }}"
        aria-label="Regenerate slug"
    >
        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M3 12a9 9 0 0 1 15.5-6.3L21 8" />
            <path d="M21 3v5h-5" />
            <path d="M21 12a9 9 0 0 1-15.5 6.3L3 16" />
            <path d="M3 21v-5h5" />
        </svg>
    </button>
</div>
