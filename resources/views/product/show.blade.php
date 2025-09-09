<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl leading-tight font-semibold text-gray-800 dark:text-gray-200"
        >
            {{ $product->name }}
        </h2>
        <div class="mt-6">daftar sub menu</div>
    </x-slot>

    <x-card class="space-y-8">
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
                    :value="$product->name"
                    readonly
                />
            </div>
            <div
                class="flex flex-col space-y-2 md:flex-row md:justify-between md:space-x-2"
            >
                <div class="w-full space-y-2">
                    <x-input-label for="brand" value="Brand" />
                    <x-text-input
                        id="brand"
                        name="brand"
                        :value="$product->brand?->name"
                        readonly
                    />
                </div>
                <div class="w-full space-y-2">
                    <x-input-label for="category" value="Kategori" />
                    <x-text-input
                        id="category"
                        name="category"
                        :value="$product->category?->name"
                        readonly
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
                        :value="$product->defaultVariant->sku"
                        readonly
                    />
                </div>
                <div class="space-y-2">
                    <x-input-label for="stock" value="Stok" class="required" />
                    <x-text-input
                        type="number"
                        id="stock"
                        name="stock"
                        :value="$product->defaultVariant->stock"
                        readonly
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
                        :value="$product->defaultVariant->price"
                        readonly
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
                        :value="$product->defaultVariant->weight"
                        readonly
                    />
                </div>
                <div class="space-y-2">
                    <x-input-label for="length" value="Panjang (m)" />
                    <x-text-input
                        type="number"
                        id="length"
                        name="length"
                        :value="$product->defaultVariant->length"
                        readonly
                    />
                </div>
                <div class="space-y-2">
                    <x-input-label for="width" value="Lebar (m)" />
                    <x-text-input
                        type="number"
                        id="width"
                        name="width"
                        :value="$product->defaultVariant->width"
                        readonly
                    />
                </div>
                <div class="space-y-2">
                    <x-input-label for="height" value="Tinggi (m)" />
                    <x-text-input
                        type="number"
                        id="height"
                        name="height"
                        :value="$product->defaultVariant->height"
                        readonly
                    />
                </div>
            </div>
        </section>
    </x-card>
    <x-card class="mt-6">
        <div class="space-y-2">
            <x-input-label for="description" value="Deskripsi" />
            <x-markdown :content="$product->description" />
        </div>
    </x-card>
</x-app-layout>
