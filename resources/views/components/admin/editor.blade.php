@props([
    'property',
    'value' => '',
])

@once
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css">
    <style>
        .dashboard-editor .ql-toolbar {
            border: 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .dashboard-editor .ql-container {
            border: 0;
            font-family: inherit;
            font-size: 14px;
        }
        .dashboard-editor .ql-editor {
            min-height: 240px;
        }
    </style>
@endonce

<div
    wire:ignore
    {{ $attributes->class('dashboard-editor overflow-hidden rounded border border-slate-300 bg-white') }}
    x-data="{
        init() {
            const boot = () => {
                if (this.$refs.editor.classList.contains('ql-container')) {
                    return;
                }
                const quill = new Quill(this.$refs.editor, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ header: [2, 3, false] }],
                            ['bold', 'italic', 'underline'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            ['blockquote', 'link'],
                            ['clean'],
                        ],
                    },
                });
                const initial = @js($value);
                if (initial) {
                    quill.clipboard.dangerouslyPasteHTML(initial);
                }
                const sync = () => this.$wire.set(@js($property), quill.getSemanticHTML());
                quill.on('text-change', sync);
                this.$el.closest('form')?.addEventListener('submit', sync, true);
            };
            if (window.Quill) {
                boot();
                return;
            }
            const timer = setInterval(() => {
                if (! window.Quill) {
                    return;
                }
                clearInterval(timer);
                boot();
            }, 30);
        },
    }"
>
    <div x-ref="editor"></div>
</div>

@once
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
@endonce
