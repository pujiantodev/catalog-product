<section>
    <form
        x-data="searchForm"
        x-init="init"
        :action="action"
        method="GET"
        class="flex flex-col items-center space-y-2 space-x-2 md:flex-row md:items-center md:justify-between"
    >
        <div class="w-full md:w-2/3">
            <x-text-input
                class="w-full"
                type="search"
                name="search"
                placeholder="Cari brand..."
                x-model="query"
            />
        </div>
        <div class="w-full md:w-1/3">
            <x-button type="submit">Cari</x-button>
            <a href="{{ route("brands.index") }}">
                <x-button type="button" variant="secondary">reset</x-button>
            </a>
        </div>
    </form>
    @if (request("search"))
        <p class="mt-1 text-sm text-gray-500">
            Menampilkan hasil untuk:
            <strong>{{ request("search") }}</strong>
        </p>
    @endif
</section>
@push("scripts")
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('searchForm', () => ({
                query: '',
                action: '{{ route("brands.index") }}',
                timeout: null,

                init() {
                    this.$watch('query', (value) => {
                        clearTimeout(this.timeout);
                        this.timeout = setTimeout(() => {
                            if (value.trim() !== '') {
                                this.$root.submit();
                            }
                        }, 1000); // debounce 1000ms
                    });
                },
            }));
        });
    </script>
@endpush
