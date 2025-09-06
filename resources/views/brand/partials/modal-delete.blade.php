<!-- Modal Hapus -->
<div
    x-data="{ brand: { id: null, name: '' } }"
    x-on:open-modal.window="
        if ($event.detail.name === 'delete-brand') {
            brand = $event.detail.data
            $dispatch('open-modal', 'delete-brand') // trigger modal tampil
        }
    "
>
    <x-modal name="delete-brand" maxWidth="lg" :show="false">
        <form
            :action="`/brands/${brand.id}`"
            method="POST"
            class="space-y-4 p-6"
        >
            @csrf
            @method("DELETE")
            <div class="space-y-2">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Yakin akan menghapus brand:
                    <strong x-text="brand.name"></strong>
                    ?
                </h2>
            </div>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __("Cancel") }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __("Delete Brand") }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>
