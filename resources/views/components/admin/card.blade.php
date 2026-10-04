@props([
    'padded' => true,
])

<div {{ $attributes->class(['rounded border border-slate-200 bg-white', 'p-4' => $padded]) }}>
    @isset($header)
        <div @class([
            'flex items-center justify-between border-b border-slate-100 px-4 py-2',
            '-mx-4 -mt-4 mb-4' => $padded,
        ])>
            {{ $header }}
        </div>
    @endisset

    {{ $slot }}
</div>
