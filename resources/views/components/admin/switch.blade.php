@props([
    'label' => 'Active',
    'on' => false,
])

<button
    type="button"
    {{ $attributes->class('inline-flex items-center gap-3 border-0 bg-transparent p-0 text-sm font-medium text-slate-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900 disabled:cursor-default') }}
    role="switch"
    aria-checked="{{ $on ? 'true' : 'false' }}"
>
    <span>{{ $label }}</span>
    <span
        @class([
            'relative inline-flex h-6 w-11 shrink-0 rounded-full',
            'bg-slate-900' => $on,
            'bg-slate-300' => ! $on,
        ])
        aria-hidden="true"
    >
        <span @class([
            'pointer-events-none absolute top-0.5 left-0.5 size-5 rounded-full bg-white shadow-sm transition-transform',
            'translate-x-5' => $on,
        ])></span>
    </span>
</button>
