@props([
    'mono' => false,
])

<input {{ $attributes->class([
    'w-full rounded border border-slate-300 px-3 py-2 text-sm text-slate-900',
    'font-mono' => $mono,
]) }} />
