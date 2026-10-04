<aside class="flex w-56 shrink-0 flex-col bg-slate-900 text-slate-200">
    <div class="flex h-16 items-center border-b border-slate-700 px-4">
        <a
            href="{{ $brandHref }}"
            wire:navigate
            @class([
                'flex min-w-0 text-white',
                'flex-col items-start justify-center gap-0.5' => $subtitle,
                'items-center' => ! $subtitle,
            ])
        >
            @if ($logo)
                <img src="{{ $logo }}" alt="{{ config('app.name') }}" class="h-8 w-auto max-w-full object-contain">
            @else
                <span class="truncate text-sm font-semibold tracking-wide">{{ config('app.name') }}</span>
            @endif
            @if ($subtitle)
                <span class="truncate text-xs leading-tight text-slate-400">{{ $subtitle }}</span>
            @endif
        </a>
    </div>
    <nav class="flex-1 space-y-1 px-2 py-3 text-sm">
        @foreach ($nav as $item)
            <a
                href="{{ $item['href'] }}"
                wire:navigate
                @class([
                    'block rounded px-3 py-2',
                    'bg-slate-800 text-white' => $item['is_active'],
                    'text-slate-300 hover:bg-slate-800 hover:text-white' => ! $item['is_active'],
                ])
            >
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
</aside>
