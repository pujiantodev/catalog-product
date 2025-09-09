@props([
    "name" => "name",
    "endpoint" => null,
    "placeholder" => "Cari...",
])

<div x-data="remoteSelect('{{ $endpoint }}')" class="relative w-full">
    <div
        @click="toggleDropdown()"
        class="flex cursor-pointer items-center justify-between rounded-lg border bg-white px-3 py-2 dark:border-gray-500 dark:bg-gray-700"
    >
        <span x-text="selected?.name || '{{ $placeholder }}'"></span>
        <button
            type="button"
            x-show="selected"
            @click.stop.prevent="clearSelection()"
            class="text-gray-400 hover:text-red-500"
        >
            &times;
        </button>
    </div>

    <div
        x-show="open"
        @click.outside="open = false"
        class="fixed z-10 mt-2 w-auto max-w-screen rounded-lg border bg-gray-50 p-4 md:w-[300px] dark:border-gray-500 dark:bg-gray-700"
    >
        <x-text-input
            type="search"
            x-model="search"
            x-ref="searchInput"
            x-on:input="watchSearch()"
            autofocus
            placeholder="{{ $placeholder }}"
        />

        <ul class="mt-2 max-h-60 overflow-y-auto">
            <template x-for="item in filtered" :key="item.id">
                <li
                    @click="select(item)"
                    :class="{'bg-blue-100': selected?.id === item.id}"
                    class="cursor-pointer rounded-lg px-3 py-2 hover:bg-green-100 dark:bg-gray-700 dark:hover:bg-gray-800"
                >
                    <span x-text="item.name"></span>
                </li>
            </template>
        </ul>
    </div>
    <input type="hidden" name="{{ $name }}" :value="selected?.id" />
</div>

@push("scripts")
    <script>
        function remoteSelect(url) {
            return {
                open: false,
                search: '',
                selected: null,
                items: [],
                timeout: null,

                init() {
                    this.fetchItems(); // initial load (optional)
                },
                toggleDropdown() {
                    this.open = !this.open;
                    if (this.open) {
                        this.$nextTick(() => {
                            this.$refs.searchInput?.focus();
                        });
                    }
                },

                fetchItems() {
                    if (!url) return;

                    fetch(`${url}?q=${encodeURIComponent(this.search)}`)
                        .then((res) => res.json())
                        .then((data) => {
                            this.items = Array.isArray(data)
                                ? data
                                : data.data || [];
                        })
                        .catch((err) => console.error('Fetch error:', err));
                },

                get filtered() {
                    return this.items;
                },

                select(item) {
                    this.selected = item;
                    this.open = false;
                    this.search = '';
                    this.items = []; // optional: clear list after select
                },

                clearSelection() {
                    this.selected = null;
                    this.fetchItems();
                },

                // Debounced search watcher
                watchSearch() {
                    clearTimeout(this.timeout);
                    this.timeout = setTimeout(() => {
                        this.fetchItems();
                    }, 300); // debounce delay (ms)
                },
            };
        }
    </script>
@endpush
