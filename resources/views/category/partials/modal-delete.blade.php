<!-- Modal Hapus -->
<div
    x-data="{ category: { id: null, name: '' } }"
    x-on:open-modal.window="
        if ($event.detail.name === 'delete-category') {
            category = $event.detail.data
            $dispatch('open-modal', 'delete-category') // trigger modal tampil
        }
    "
>
    <x-modal name="delete-category" maxWidth="lg" :show="false">
        <form
            :action="`/categories/${category.id}`"
            method="POST"
            class="space-y-4 p-6"
        >
            @csrf
            @method("DELETE")
            <div class="space-y-2">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Yakin akan menghapus kategory:
                    <strong x-text="category.name"></strong>
                    ?
                </h2>
            </div>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __("Batal") }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __("Hapus") }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>
