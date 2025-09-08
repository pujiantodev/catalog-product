<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl leading-tight font-semibold text-gray-800 dark:text-gray-200"
        >
            Daftar Produk
        </h2>
    </x-slot>

    <div class="">
        <x-card class="space-y-4">
            <section class="flex flex-col space-y-4 md:space-y-2">
                <div class="w-full">
                    <a href="{{ route("products.create") }}">
                        <x-button>
                            <i
                                data-lucide="circle-plus"
                                class="mr-2 h-4 w-auto"
                            ></i>
                            Tambah Barang
                        </x-button>
                    </a>
                </div>
                <div class="w-full">
                    {{-- filter dan tombol --}}
                    {{-- @include("category.partials.filter") --}}
                </div>
            </section>
            {{-- data table --}}
            @include("product.partials.table")
        </x-card>
    </div>
</x-app-layout>
