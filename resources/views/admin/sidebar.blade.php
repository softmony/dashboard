<aside class="flex w-56 shrink-0 flex-col bg-slate-900 text-slate-200">
    <div class="border-b border-slate-700 px-4 py-4">
        <a href="{{ $brandHref }}" class="text-sm font-semibold tracking-wide text-white" wire:navigate>
            {{ config('app.name') }}
        </a>
        @if ($subtitle)
            <p class="mt-0.5 text-xs text-slate-400">{{ $subtitle }}</p>
        @endif
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
