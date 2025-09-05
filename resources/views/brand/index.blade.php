<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl leading-tight font-semibold text-gray-800 dark:text-gray-200"
        >
            {{ __("Daftar Brand") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <x-card class="space-y-4">
                {{-- filter dan tombol --}}
                <section class="flex flex-col md:flex-row">
                    <x-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'add-brand')"
                    >
                        <i
                            data-lucide="circle-plus"
                            class="mr-2 h-4 w-auto"
                        ></i>
                        Tambah Brand
                    </x-button>
                </section>
                {{-- data table --}}
                @include("brand.partials.table")
            </x-card>

            <section>
                <x-modal
                    name="add-brand"
                    :show="false"
                    maxWidth="lg"
                    focusable
                >
                    @include("brand.partials.create-form")
                </x-modal>
            </section>
        </div>
    </div>
</x-app-layout>
