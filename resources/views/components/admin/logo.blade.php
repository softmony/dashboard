@props([
    'size' => 'size-5',
])

<svg
    {{ $attributes->class($size.' shrink-0') }}
    viewBox="0 0 24 24"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
    aria-hidden="true"
    stroke="currentColor"
    stroke-width="1.5"
>
    <rect x="3.75" y="3.75" width="16.5" height="16.5" rx="2" stroke-linejoin="round" />
    <path d="M9.75 5.25v13.5" stroke-linecap="butt" />
    <path d="M9.75 9.75h9" stroke-linecap="butt" />
</svg>
