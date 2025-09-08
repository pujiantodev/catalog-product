<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl leading-tight font-semibold text-gray-800 dark:text-gray-200"
        >
            {{ __("Daftar Kategori") }}
        </h2>
    </x-slot>

    <div
        class="flex flex-col items-start justify-between space-y-4 p-2 md:flex-row md:space-x-2 md:p-0"
    >
        <div class="w-full md:w-1/4">
            @include("layouts.navigation-setting-catalog")
        </div>
        <div class="w-full md:w-3/4">
            <x-card class="space-y-4">
                <section class="flex flex-col space-y-4 md:space-y-2">
                    <div class="w-full">
                        <x-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'add-category')"
                        >
                            <i
                                data-lucide="circle-plus"
                                class="mr-2 h-4 w-auto"
                            ></i>
                            Tambah Kategori
                        </x-button>
                    </div>
                    <div class="w-full">
                        {{-- filter dan tombol --}}
                        @include("category.partials.filter")
                    </div>
                </section>
                {{-- data table --}}
                @include("category.partials.table")
            </x-card>

            <section>
                <x-modal
                    name="add-category"
                    :show="false"
                    maxWidth="lg"
                    focusable
                >
                    @include("category.partials.create-form")
                </x-modal>
            </section>
        </div>
    </div>
</x-app-layout>
