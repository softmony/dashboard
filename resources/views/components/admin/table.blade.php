<div {{ $attributes->class('overflow-hidden rounded border border-slate-200 bg-white') }}>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            @isset($head)
                <thead class="bg-slate-50 text-left text-xs font-medium uppercase tracking-wide text-slate-500">
                    <tr>{{ $head }}</tr>
                </thead>
            @endisset
            <tbody class="divide-y divide-slate-100">
                {{ $slot }}
            </tbody>
        </table>
    </div>
    @isset($footer)
        <div class="border-t border-slate-100 px-4 py-2">
            {{ $footer }}
        </div>
    @endisset
</div>
