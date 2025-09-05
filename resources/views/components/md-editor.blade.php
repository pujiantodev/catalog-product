@props([
    "id" => "md-" . Str::random(6),
    "name" => "content",
    "value" => "",
    "placeholder" => "Tulis Markdown di sini…",
    "height" => "380px",
    "readonly" => false,
    "disabled" => false,
    "showToolbar" => true,
])

@php
    $previewId = "preview-" . $id;
@endphp

<div
    x-data="mdEditor({
                initial: @js($value),
                readonly: @js($readonly),
                disabled: @js($disabled),
                height: @js($height),
            })"
    class="space-y-3"
>
    <!-- Toolbar -->
    <template x-if="@js($showToolbar)">
        <div class="flex flex-wrap items-center gap-1">
            <!-- Formatting -->
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="wrap('**','**')"
                :disabled="isReadOnly"
            >
                <b>B</b>
            </button>
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="wrap('*','*')"
                :disabled="isReadOnly"
            >
                <i>I</i>
            </button>
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="insertPrefix('# ')"
                :disabled="isReadOnly"
            >
                H1
            </button>
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="insertPrefix('## ')"
                :disabled="isReadOnly"
            >
                H2
            </button>
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="insertPrefix('### ')"
                :disabled="isReadOnly"
            >
                H3
            </button>
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="listify('- ')"
                :disabled="isReadOnly"
            >
                • List
            </button>
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="listify((i)=> (i+1)+'. ')"
                :disabled="isReadOnly"
            >
                1. List
            </button>
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="wrap('`','`')"
                :disabled="isReadOnly"
            >
                Code
            </button>
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="wrap('[','](https://)')"
                :disabled="isReadOnly"
            >
                Link
            </button>

            <span class="mx-2 text-gray-300">|</span>

            <!-- Media -->
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="insertImage()"
                :disabled="isReadOnly"
            >
                Image
            </button>
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="insertYouTube()"
                :disabled="isReadOnly"
            >
                YouTube
            </button>
            <button
                type="button"
                class="rounded border px-2 py-1 text-sm"
                @click="insertVideo()"
                :disabled="isReadOnly"
            >
                Video
            </button>

            <span class="mx-2 text-gray-300">|</span>

            <!-- View toggles -->
            <div class="inline-flex overflow-hidden rounded border">
                <button
                    type="button"
                    class="dark: px-3 py-1 text-sm"
                    :class="viewMode==='edit' ? 'bg-gray-200 dark:bg-gray-500' : 'bg-white dark:bg-gray-800'"
                    @click="setView('edit')"
                >
                    Edit
                </button>
                <button
                    type="button"
                    class="border-l px-3 py-1 text-sm"
                    :class="viewMode==='split' ? 'bg-gray-200 dark:bg-gray-500' : 'bg-white dark:bg-gray-800'"
                    @click="setView('split')"
                >
                    Split
                </button>
                <button
                    type="button"
                    class="border-l px-3 py-1 text-sm"
                    :class="viewMode==='preview' ? 'bg-gray-200 dark:bg-gray-500' : 'bg-white dark:bg-gray-800'"
                    @click="setView('preview')"
                >
                    Preview
                </button>
            </div>

            <button
                type="button"
                class="ml-2 rounded border px-2 py-1 text-sm"
                @click="clearAll()"
                :disabled="isReadOnly"
            >
                Clear
            </button>
            <a
                href="https://www.markdownguide.org/basic-syntax/"
                target="_blank"
            >
                <button
                    type="button"
                    class="ml-2 rounded border bg-blue-200 px-2 py-1 text-sm hover:cursor-pointer dark:border-none dark:bg-blue-500"
                    :disabled="isReadOnly"
                >
                    Panduan
                </button>
            </a>
        </div>
    </template>

    <!-- Editor + Preview -->
    <div
        class="grid gap-4"
        :class="viewMode==='split' ? 'md:grid-cols-2 grid-cols-1' : 'grid-cols-1'"
    >
        <!-- Textarea -->
        <div x-show="viewMode !== 'preview'">
            <textarea
                id="{{ $id }}"
                name="{{ $name }}"
                x-ref="ta"
                x-model="raw"
                placeholder="{{ $placeholder }}"
                :readonly="isReadOnly"
                :disabled="isReadOnly"
                class="w-full rounded-md border border-gray-300 bg-white p-3 text-sm transition focus:border-blue-500 focus:ring-1 focus:ring-blue-500 disabled:opacity-60 dark:border-gray-500 dark:bg-gray-700"
                :style="`height: ${height};`"
            ></textarea>
        </div>

        <!-- Preview -->
        <div x-show="viewMode !== 'edit'">
            <div
                id="{{ $previewId }}"
                class="prose max-w-none overflow-auto rounded-md border bg-gray-50 p-4 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-200 dark:prose-invert"
                :style="`min-height: ${height};`"
                x-html="rendered"
            ></div>
        </div>
    </div>
</div>

@once
    @push("styles")
        <link
            rel="stylesheet"
            href="https://unpkg.com/highlight.js@11.9.0/styles/github.min.css"
        />
    @endpush

    @push("scripts")
        <script src="https://unpkg.com/markdown-it@13.0.2/dist/markdown-it.min.js"></script>
        <script src="https://unpkg.com/dompurify@3.1.6/dist/purify.min.js"></script>
        <script src="https://unpkg.com/highlight.js@11.9.0/lib/common.min.js"></script>

        <script>
            function mdEditor({
                initial = '',
                readonly = false,
                disabled = false,
                height = '380px',
            }) {
                const md = window.markdownit({
                    linkify: true,
                    breaks: false,
                    html: false, // tetap false: kita inject HTML embed sendiri, lalu sanitize
                    highlight(str, lang) {
                        try {
                            if (window.hljs && lang && hljs.getLanguage(lang)) {
                                return hljs.highlight(str, { language: lang })
                                    .value;
                            }
                        } catch (_) {}
                        return '';
                    },
                });

                // helper: ambil ID YouTube dari url
                const youtubeId = (url) => {
                    try {
                        const u = new URL(url);
                        if (u.hostname === 'youtu.be')
                            return u.pathname.slice(1);
                        if (u.hostname.endsWith('youtube.com')) {
                            if (u.pathname === '/watch')
                                return u.searchParams.get('v');
                            if (u.pathname.startsWith('/embed/'))
                                return u.pathname.split('/')[2];
                            if (u.pathname.startsWith('/shorts/'))
                                return u.pathname.split('/')[2];
                        }
                    } catch (e) {}
                    return null;
                };

                // transform link <a> ke embed video/iframe sebelum sanitize
                const transformMedia = (html) => {
                    // YouTube anchors -> iframe responsif
                    html = html.replace(
                        /<a[^>]*href="([^"]+)"[^>]*>([^<]*)<\/a>/gi,
                        (m, href, text) => {
                            const id = youtubeId(href);
                            if (!id) return m;
                            const src = `https://www.youtube.com/embed/${id}`;
                            return `
<div class="aspect-video w-full my-4">
  <iframe class="w-full h-full" src="${src}" title="YouTube video"
          loading="lazy" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen referrerpolicy="strict-origin-when-cross-origin"></iframe>
</div>`;
                        },
                    );

                    // file video langsung (.mp4/.webm) -> <video controls>
                    html = html.replace(
                        /<a[^>]*href="([^"]+\.(mp4|webm))"[^>]*>([^<]*)<\/a>/gi,
                        (m, href) => {
                            return `
<video controls class="w-full my-4 rounded" style="max-height: 60vh;" preload="metadata">
  <source src="${href}" type="video/${href.toLowerCase().endsWith('.webm') ? 'webm' : 'mp4'}">
  Browser Anda tidak mendukung pemutar video.
</video>`;
                        },
                    );

                    return html;
                };

                // Konfigurasi DOMPurify agar mengizinkan tag media yang kita sisipkan
                const purifyCfg = {
                    ADD_TAGS: ['iframe', 'video', 'source'],
                    ADD_ATTR: [
                        'allow',
                        'allowfullscreen',
                        'frameborder',
                        'controls',
                        'src',
                        'type',
                        'width',
                        'height',
                        'loading',
                        'referrerpolicy',
                        'class',
                        'style',
                    ],
                    // Batasi iframe hanya dari youtube
                    ALLOWED_URI_REGEXP: /^(?:(?:(?:https?|data):)|(?:\/\/))/i,
                };

                return {
                    raw: initial,
                    height,
                    viewMode: 'split', // 'edit' | 'preview' | 'split'
                    get isReadOnly() {
                        return !!(readonly || disabled);
                    },

                    // Rendered preview (Markdown -> transform media -> sanitize)
                    get rendered() {
                        let html = md.render(this.raw || '');
                        html = transformMedia(html);
                        const safe = window.DOMPurify
                            ? DOMPurify.sanitize(html, purifyCfg)
                            : html;
                        queueMicrotask(() => {
                            if (window.hljs) {
                                document
                                    .querySelectorAll(
                                        '#{{ $previewId }} pre code',
                                    )
                                    .forEach((el) => hljs.highlightElement(el));
                            }
                        });
                        return safe;
                    },

                    // View controls
                    setView(mode) {
                        this.viewMode = mode;
                        if (mode !== 'preview')
                            queueMicrotask(() => this.$refs.ta?.focus());
                    },

                    // Toolbar helpers
                    clearAll() {
                        if (!this.isReadOnly) this.raw = '';
                    },
                    _selection() {
                        const ta = this.$refs.ta;
                        return ta
                            ? {
                                  ta,
                                  start: ta.selectionStart,
                                  end: ta.selectionEnd,
                              }
                            : null;
                    },
                    wrap(prefix, suffix) {
                        if (this.isReadOnly) return;
                        const sel = this._selection();
                        if (!sel) return;
                        const { ta, start, end } = sel;
                        const selected = this.raw.slice(start, end) || 'teks';
                        const replaced = prefix + selected + (suffix ?? prefix);
                        this.raw =
                            this.raw.slice(0, start) +
                            replaced +
                            this.raw.slice(end);
                        this.$nextTick(() => {
                            ta.focus();
                            ta.selectionStart = start + prefix.length;
                            ta.selectionEnd =
                                start + prefix.length + selected.length;
                        });
                    },
                    insertPrefix(prefix) {
                        if (this.isReadOnly) return;
                        const sel = this._selection();
                        if (!sel) return;
                        const { ta, start } = sel;
                        const before = this.raw.slice(0, start);
                        const lineStart = before.lastIndexOf('\n') + 1;
                        this.raw =
                            this.raw.slice(0, lineStart) +
                            prefix +
                            this.raw.slice(lineStart);
                        this.$nextTick(() => {
                            ta.focus();
                        });
                    },
                    listify(prefixBuilder) {
                        if (this.isReadOnly) return;
                        const sel = this._selection();
                        if (!sel) return;
                        const { ta, start, end } = sel;
                        const selection = this.raw.slice(start, end) || 'item';
                        const lines = selection.split('\n');
                        const mapped = lines
                            .map((ln, i) => {
                                const pref =
                                    typeof prefixBuilder === 'function'
                                        ? prefixBuilder(i)
                                        : prefixBuilder || '- ';
                                return pref + (ln || 'item');
                            })
                            .join('\n');
                        this.raw =
                            this.raw.slice(0, start) +
                            mapped +
                            this.raw.slice(end);
                        this.$nextTick(() => {
                            ta.focus();
                        });
                    },

                    // Media insertion
                    insertImage() {
                        if (this.isReadOnly) return;
                        const url = prompt('URL gambar (https://...)');
                        if (!url) return;
                        const alt = prompt('Alt text (opsional)') || 'image';
                        this._insertAtCursor(`![${alt}](${url})`);
                    },
                    insertYouTube() {
                        if (this.isReadOnly) return;
                        const url = prompt(
                            'URL YouTube (https://youtu.be/... atau https://www.youtube.com/watch?v=...)',
                        );
                        if (!url) return;
                        // Simpan sebagai link biasa; akan di-embed saat render
                        this._insertAtCursor(url);
                    },
                    insertVideo() {
                        if (this.isReadOnly) return;
                        const url = prompt('URL video (.mp4 / .webm)');
                        if (!url) return;
                        this._insertAtCursor(url); // di-embed saat render
                    },
                    _insertAtCursor(text) {
                        const sel = this._selection();
                        if (!sel) return;
                        const { ta, start, end } = sel;
                        this.raw =
                            this.raw.slice(0, start) +
                            text +
                            this.raw.slice(end);
                        this.$nextTick(() => {
                            ta.focus();
                            ta.selectionStart = ta.selectionEnd =
                                start + text.length;
                        });
                    },
                };
            }
        </script>
    @endpush
@endonce
