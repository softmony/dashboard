<div {{ $attributes->class('flex items-center justify-between gap-2 border-t border-slate-100 pt-4') }}>
    <div class="flex flex-wrap gap-2">{{ $slot }}</div>
    @isset($end)
        <div class="flex flex-wrap gap-2">{{ $end }}</div>
    @endisset
</div>
