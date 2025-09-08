<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl leading-tight font-semibold text-gray-800 dark:text-gray-200"
        >
            Buat Barang Baru
        </h2>
    </x-slot>

    <form action="{{ route("products.store") }}" method="post">
        @csrf
        <x-card class="space-y-8">
            <section class="space-y-4">
                <div class="space-y-2">
                    <x-input-label
                        for="name"
                        value="Nama Barang"
                        class="required"
                    />
                    <x-text-input id="name" name="name" />
                </div>
                <div
                    class="flex flex-col space-y-2 md:flex-row md:justify-between md:space-x-2"
                >
                    <div class="w-full space-y-2">
                        <x-input-label for="brand" value="Brand" />
                        <x-select3
                            id="brand"
                            name="brand"
                            :endpoint="route('api.public.brands.list')"
                            :placeholder="'Pilih Brand...'"
                        />
                    </div>
                    <div class="w-full space-y-2">
                        <x-input-label for="name" value="Kategori" />
                        <x-select3
                            id="category"
                            name="category"
                            :endpoint="route('api.public.categories.list')"
                            :placeholder="'Pilih Kategori...'"
                        />
                    </div>
                </div>
                <div class="space-y-2">
                    <x-input-label for="description" value="Deskripsi" />
                    <x-markdown-editor id="description" name="description" />
                </div>
                <hr class="my-12 dark:border-gray-500" />
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div class="space-y-2">
                        <x-input-label
                            for="sku"
                            value="Nomor SKU"
                            class="required"
                        />
                        <x-text-input type="text" id="sku" name="sku" />
                    </div>
                    <div class="space-y-2">
                        <x-input-label
                            for="stock"
                            value="Stok"
                            class="required"
                        />
                        <x-text-input type="number" id="stock" name="stock" />
                    </div>
                    <div class="space-y-2">
                        <x-input-label
                            for="price"
                            value="Harga (Rp.)"
                            class="required text-green-400 dark:text-green-600"
                        />
                        <x-text-input id="price" name="price" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                    <div class="space-y-2">
                        <x-input-label
                            for="weight"
                            value="Berat (gram)"
                            class="required"
                        />
                        <x-text-input id="weight" name="weight" />
                    </div>
                    <div class="space-y-2">
                        <x-input-label for="length" value="Panjang (m)" />
                        <x-text-input id="length" name="length" />
                    </div>
                    <div class="space-y-2">
                        <x-input-label for="width" value="Lebar (m)" />
                        <x-text-input id="width" name="width" />
                    </div>
                    <div class="space-y-2">
                        <x-input-label for="height" value="Tinggi (m)" />
                        <x-text-input id="height" name="height" />
                    </div>
                </div>

                <div class="space-y-2">
                    <x-primary-button>Simpan</x-primary-button>
                </div>
            </section>
        </x-card>
    </form>
</x-app-layout>
