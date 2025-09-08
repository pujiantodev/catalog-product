@props([
    "id" => "md-" . Str::random(6),
    "name" => "content",
    "value" => "",
    "placeholder" => "Tulis Markdown di sini...",
    "minHeight" => "360px", // tinggi editor
    "autosave" => false,
    "autofocus" => false,
    "readonly" => false,
    "disabled" => false,
    "showToolbar" => true,
])

@php
    $previewId = "preview-" . $id;
@endphp

<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    {{-- Editor (textarea yang diubah jadi EasyMDE) --}}
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        @readonly($readonly)
        @disabled($disabled)
        class="w-full dark:bg-gray-700"
    >
{{ $value }}</textarea
    >

    {{-- Preview mandiri pakai Tailwind Typography --}}
    <div
        id="{{ $previewId }}"
        class="prose max-w-none overflow-auto rounded-md border p-4 dark:text-gray-300 dark:prose-invert"
        style="min-height: {{ $minHeight }}"
    >
        {{-- isi preview akan dirender via JS --}}
    </div>
</div>

@once
    @push("styles")
        {{-- EasyMDE style --}}
        <link
            rel="stylesheet"
            href="https://unpkg.com/easymde/dist/easymde.min.css"
        />
        {{-- Highlight.js style (untuk code block di preview) --}}
        <link
            rel="stylesheet"
            href="https://unpkg.com/highlight.js@11.9.0/styles/github.min.css"
        />
    @endpush

    @push("scripts")
        {{-- Editor, parser, sanitisasi, dan highlight --}}
        <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
        <script src="https://unpkg.com/markdown-it@13.0.2/dist/markdown-it.min.js"></script>
        <script src="https://unpkg.com/dompurify@3.1.6/dist/purify.min.js"></script>
        <script src="https://unpkg.com/highlight.js@11.9.0/lib/common.min.js"></script>
    @endpush
@endonce

@push("scripts")
    <script>
        (function () {
            const textarea = document.getElementById(@json($id));
            const preview  = document.getElementById(@json($previewId));
            if (!textarea) return;

            // Init Markdown-It
            const md = window.markdownit({
                linkify: true,
                breaks: false,
                html: false, // biar aman; kalau butuh HTML, tetap sanitasi ketat
                highlight: function (str, lang) {
                    try {
                        if (window.hljs && lang && hljs.getLanguage(lang)) {
                            return hljs.highlight(str, { language: lang }).value;
                        }
                    } catch (_) {}
                    return ''; // biarkan default escaping
                }
            });

            // Opsi EasyMDE
            const options = {
                element: textarea,
                minHeight: @json($minHeight),
                autofocus: @json($autofocus),
                forceSync: true,            // sinkron ke <textarea> untuk submit form
                spellChecker: false,
                renderingConfig: { singleLineBreaks: false, codeSyntaxHighlighting: false },
                toolbar: @json($showToolbar) ? [
                    'bold', 'italic', 'heading', '|',
                    'quote', 'unordered-list', 'ordered-list', '|',
                    'link', 'image', 'table', 'horizontal-rule', '|',
                    'preview', 'side-by-side', 'fullscreen', 'guide'
                ] : false,
                status: ['lines', 'words'],
            };

            // Autosave opsional
            @if($autosave)
            options.autosave = { enabled: true, uniqueId: @json($id), delay: 1000 };
            @endif

            const editor = new EasyMDE(options);

            // Readonly/disabled
            @if($readonly || $disabled)
                editor.codemirror.setOption('readOnly', 'nocursor');
            @endif

            // Render preview aman (Markdown -> HTML -> sanitize -> inject)
            function renderPreview() {
                const raw = editor.value();
                const html = md.render(raw ?? '');
                preview.innerHTML = window.DOMPurify ? DOMPurify.sanitize(html) : html;

                // Highlight semua blok kode di preview
                if (window.hljs) {
                    preview.querySelectorAll('pre code').forEach((el) => hljs.highlightElement(el));
                }
            }

            // Initial render + on change
            editor.codemirror.on('change', renderPreview);
            renderPreview();
        })();
    </script>
@endpush
