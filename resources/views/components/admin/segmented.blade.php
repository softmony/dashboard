@props([
    'label' => 'Choose one',
    'options' => [],
    'value' => null,
    'property',
])

<div {{ $attributes->class('flex overflow-hidden rounded border border-slate-300 bg-white') }} role="radiogroup" aria-label="{{ $label }}">
    @foreach ($options as $optionValue => $optionLabel)
        <button
            type="button"
            role="radio"
            wire:key="segment-{{ $property }}-{{ $optionValue }}"
            wire:click="$set('{{ $property }}', {{ \Illuminate\Support\Js::from($optionValue) }})"
            aria-checked="{{ $value == $optionValue ? 'true' : 'false' }}"
            @class([
                'min-w-0 flex-1 border-r border-slate-300 px-2 py-2 text-sm last:border-r-0',
                'bg-slate-900 text-white' => $value == $optionValue,
                'bg-white text-slate-700 hover:bg-slate-50' => $value != $optionValue,
            ])
        >{{ $optionLabel }}</button>
    @endforeach
</div>
