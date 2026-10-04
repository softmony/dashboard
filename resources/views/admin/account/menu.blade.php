<div
    class="relative"
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
>
    <button
        type="button"
        class="inline-flex size-9 shrink-0 items-center justify-center overflow-hidden rounded-full bg-slate-800 text-xs font-semibold leading-none text-white hover:bg-slate-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-400 focus-visible:ring-offset-2"
        @click="open = ! open"
        :aria-expanded="open.toString()"
        aria-haspopup="menu"
        aria-label="Account menu"
    >
        {{ $initials }}
    </button>

    <div
        x-show="open"
        x-cloak
        @click.outside="open = false"
        x-transition.opacity.duration.150ms
        class="absolute right-0 z-50 mt-2 w-56 origin-top-right rounded border border-slate-200 bg-white py-1 shadow-lg"
        role="menu"
        style="display: none;"
    >
        <div class="border-b border-slate-100 px-3 py-2">
            <p class="truncate text-sm font-medium text-slate-900">{{ $displayName }}</p>
            @if ($email)
                <p class="truncate text-xs text-slate-500">{{ $email }}</p>
            @endif
        </div>
        @foreach ($menu as $menuItem)
            @if (! empty($menuItem['dispatch']))
                <button
                    type="button"
                    class="block w-full px-3 py-2 text-left text-sm text-slate-700 hover:bg-slate-50"
                    role="menuitem"
                    @click="open = false; Livewire.dispatch(@js($menuItem['dispatch']))"
                >
                    {{ $menuItem['label'] ?? 'Action' }}
                </button>
            @elseif (! empty($menuItem['route']))
                <a
                    href="{{ route($menuItem['route']) }}"
                    class="block w-full px-3 py-2 text-left text-sm text-slate-700 hover:bg-slate-50"
                    role="menuitem"
                    wire:navigate
                >
                    {{ $menuItem['label'] ?? 'Link' }}
                </a>
            @elseif (! empty($menuItem['url']))
                <a
                    href="{{ $menuItem['url'] }}"
                    class="block w-full px-3 py-2 text-left text-sm text-slate-700 hover:bg-slate-50"
                    role="menuitem"
                >
                    {{ $menuItem['label'] ?? 'Link' }}
                </a>
            @endif
        @endforeach
        <form method="POST" action="{{ route($logoutRoute) }}">
            @csrf
            <button
                type="submit"
                class="block w-full px-3 py-2 text-left text-sm text-slate-700 hover:bg-slate-50"
                role="menuitem"
            >
                Log out
            </button>
        </form>
    </div>
</div>
