@props([
    'colspan' => 1,
])

<tr>
    <td colspan="{{ $colspan }}" {{ $attributes->class('px-4 py-8 text-center text-slate-500') }}>
        {{ $slot }}
    </td>
</tr>
