<div {{ $attributes->class('grid gap-6 lg:grid-cols-[minmax(0,1fr)_26rem]') }}>
    <div class="min-w-0">{{ $slot }}</div>
    @isset($aside)
        <div class="min-w-0">{{ $aside }}</div>
    @endisset
</div>
