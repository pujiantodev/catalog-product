@props([
    "url",
    "name" => "search_select",
    "placeholder" => "Cari dan pilih...",
])

<div
    x-data="selectSearch('{{ $url }}', '{{ $name }}')"
    x-init="init()"
    class="relative"
>
    <input
        type="text"
        x-model="query"
        @input="debouncedSearch"
        class="w-full rounded border px-3 py-2"
        :placeholder="'{{ $placeholder }}'"
    />

    <ul
        x-show="options.length"
        @click.outside="options = []"
        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded border bg-white shadow dark:bg-gray-700"
    >
        <template x-for="option in options" :key="option.id">
            <li
                @click="select(option)"
                class="cursor-pointer px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-800"
                x-text="option.text"
            ></li>
        </template>
    </ul>

    <input type="hidden" :name="inputName" :value="selected?.id" />
</div>

@push("scripts")
    <script>
        function selectSearch(url, inputName) {
            return {
                query: '',
                options: [],
                selected: null,
                inputName,
                debounceTimer: null,
                isLoading: false,

                init() {
                    this.fetchOptions(); // preload default options
                },

                debouncedSearch() {
                    clearTimeout(this.debounceTimer);
                    this.debounceTimer = setTimeout(() => {
                        this.fetchOptions(this.query);
                    }, 400);
                },

                fetchOptions(search = '') {
                    this.isLoading = true;

                    fetch(`${url}?q=${encodeURIComponent(search)}`)
                        .then((res) => res.json())
                        .then((data) => {
                            this.options = data.map((item) => ({
                                id: item.id,
                                text: item.name,
                            }));
                        })
                        .finally(() => {
                            this.isLoading = false;
                        });
                },

                select(option) {
                    this.selected = option;
                    this.query = option.text;
                    this.options = [];
                },
            };
        }
    </script>
@endpush
