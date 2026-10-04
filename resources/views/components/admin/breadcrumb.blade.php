@props([
    'items' => [],
])

<nav {{ $attributes->class('text-sm text-slate-500') }} aria-label="Breadcrumb">
    <ol class="flex flex-wrap items-center gap-3">
        @foreach ($items as $index => $item)
            @php
                $label = $item['label'] ?? '';
                $url = $item['url'] ?? null;
                $isLast = $index === array_key_last($items);
            @endphp

            @if ($index > 0)
                <li aria-hidden="true" class="text-slate-300">/</li>
            @endif

            <li @class(['min-w-0' => $isLast, 'font-medium text-slate-900' => $isLast])>
                @if (! $isLast && $url)
                    <a href="{{ $url }}" class="hover:text-slate-800" wire:navigate>{{ $label }}</a>
                @else
                    <span class="truncate" @if ($isLast) aria-current="page" @endif>{{ $label }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
