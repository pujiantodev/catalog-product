<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl leading-tight font-semibold text-gray-800 dark:text-gray-200"
        >
            {{ $product->name }}
        </h2>
    </x-slot>

    <form action="{{ route("products.update", $product->id) }}" method="post">
        @csrf
        @method("PUT")
        <x-card class="space-y-8 overflow-auto p-6">
            <section class="space-y-4">
                <div class="space-y-2">
                    <x-input-label
                        for="name"
                        value="Nama Barang"
                        class="required"
                    />
                    <x-text-input
                        id="name"
                        name="name"
                        :value="old('name') ?? $product->name"
                    />
                    <x-input-error
                        class="mt-2"
                        :messages="$errors->get('name')"
                    />
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
                            :placeholder="$product->brand?->name ?? 'Pilih Brand...'"
                        />
                    </div>
                    <div class="w-full space-y-2">
                        <x-input-label for="name" value="Kategori" />
                        <x-select3
                            id="category"
                            name="category"
                            :endpoint="route('api.public.categories.list')"
                            :placeholder="$product->category?->name ??'Pilih Kategori...'"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div class="space-y-2">
                        <x-input-label
                            for="sku"
                            value="Nomor SKU"
                            class="required"
                        />
                        <x-text-input
                            type="text"
                            id="sku"
                            name="sku"
                            :value="old('sku') ?? $product->defaultVariant?->sku"
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('sku')"
                        />
                    </div>
                    <div class="space-y-2">
                        <x-input-label
                            for="stock"
                            value="Stok"
                            class="required"
                        />
                        <x-text-input
                            type="number"
                            id="stock"
                            name="stock"
                            :value="old('stock') ?? $product->defaultVariant?->stock"
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('stock')"
                        />
                    </div>
                    <div class="space-y-2">
                        <x-input-label
                            for="price"
                            value="Harga (Rp.)"
                            class="required text-green-400 dark:text-green-600"
                        />
                        <x-text-input
                            id="price"
                            name="price"
                            :value="old('price') ?? $product->defaultVariant?->price"
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('price')"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                    <div class="space-y-2">
                        <x-input-label
                            for="weight"
                            value="Berat (gram)"
                            class="required"
                        />
                        <x-text-input
                            type="number"
                            id="weight"
                            name="weight"
                            :value="old('weight')  ?? $product->defaultVariant?->weight"
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('weight')"
                        />
                    </div>
                    <div class="space-y-2">
                        <x-input-label for="length" value="Panjang (m)" />
                        <x-text-input
                            type="number"
                            id="length"
                            name="length"
                            :value="old('length')  ?? $product->defaultVariant?->length"
                        />
                    </div>
                    <div class="space-y-2">
                        <x-input-label for="width" value="Lebar (m)" />
                        <x-text-input
                            type="number"
                            id="width"
                            name="width"
                            :value="old('width')  ?? $product->defaultVariant?->width"
                        />
                    </div>
                    <div class="space-y-2">
                        <x-input-label for="height" value="Tinggi (m)" />
                        <x-text-input
                            type="number"
                            id="height"
                            name="height"
                            :value="old('height')  ?? $product->defaultVariant?->height"
                        />
                    </div>
                </div>
                <div class="space-y-2">
                    <x-primary-button>Udate</x-primary-button>
                </div>
            </section>
        </x-card>
        <x-card class="mt-6">
            <div class="space-y-2">
                <x-input-label for="description" value="Deskripsi" />
                <x-markdown-editor
                    id="description"
                    name="description"
                    :value="old('description')  ?? $product->description"
                />
            </div>
        </x-card>
    </form>
</x-app-layout>
