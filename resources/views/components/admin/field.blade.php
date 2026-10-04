@props([
    'label' => null,
    'for' => null,
    'error' => null,
])

<div>
    @if ($label)
        <label @if ($for) for="{{ $for }}" @endif class="mb-1 block text-sm font-medium text-slate-600">
            {{ $label }}
        </label>
    @endif

    {{ $slot }}

    @if ($error)
        @error($error)
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    @endif
</div>
