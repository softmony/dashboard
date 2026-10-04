@props([
    'status' => null,
])

@php
    $message = $status ?? session('status');
@endphp

@if ($message)
    <p {{ $attributes->class('rounded border border-emerald-200 bg-emerald-50 px-3 py-2 text-sm text-emerald-800') }} role="status">
        {{ $message }}
    </p>
@endif
