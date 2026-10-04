{{-- Wrap a screen. Children open the dialog with Alpine ask(). --}}
<div
    x-data="{
        open: false,
        title: 'Confirm',
        message: '',
        method: null,
        params: [],
        ask(opts = {}) {
            this.method = opts.method ?? null;
            this.params = Array.isArray(opts.params) ? opts.params : [];
            this.title = opts.title ?? 'Confirm';
            this.message = opts.message ?? 'Are you sure?';
            this.open = true;
            this.$nextTick(() => this.$refs.confirmBtn?.focus());
        },
        cancel() {
            this.open = false;
            this.method = null;
            this.params = [];
        },
        async confirm() {
            const method = this.method;
            const params = this.params;
            this.cancel();
            if (method) {
                await $wire.call(method, ...params);
            }
        },
    }"
    @keydown.escape.window="if (open) cancel()"
    @confirm-ask.window="ask($event.detail)"
>
    {{ $slot }}

    <template x-teleport="body">
        <div
            x-show="open"
            x-cloak
            class="fixed inset-0 z-[80] flex items-center justify-center p-4"
            role="dialog"
            aria-modal="true"
            aria-labelledby="confirm-title"
            style="display: none;"
        >
            <div
                x-show="open"
                x-transition.opacity.duration.150ms
                class="absolute inset-0 bg-slate-900/40"
                @click="cancel()"
            ></div>

            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-1"
                class="relative z-10 w-full max-w-sm rounded border border-slate-200 bg-white p-5 shadow-xl"
                @click.stop
            >
                <h2 id="confirm-title" class="text-sm font-semibold text-slate-900" x-text="title"></h2>
                <p class="mt-2 text-sm text-slate-600" x-text="message"></p>

                <div class="mt-5 flex justify-end gap-2">
                    <button
                        type="button"
                        class="rounded border border-slate-300 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50"
                        @click="cancel()"
                    >
                        {{ $cancelLabel }}
                    </button>
                    <button
                        type="button"
                        x-ref="confirmBtn"
                        @class([
                            'rounded px-3 py-2 text-sm font-medium text-white',
                            'bg-red-600 hover:bg-red-700' => $danger,
                            'bg-slate-900 hover:bg-slate-700' => ! $danger,
                        ])
                        @click="confirm()"
                    >
                        {{ $confirmLabel }}
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>
