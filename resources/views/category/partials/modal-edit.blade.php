<!-- Modal Edit -->
<div
    x-data="{ category: { id: null, name: '' } }"
    x-on:open-modal.window="
        if ($event.detail.name === 'edit-category') {
            category = $event.detail.data
            $dispatch('open-modal', 'edit-category') // trigger modal tampil
        }
    "
>
    <x-modal name="edit-category" :show="false" maxWidth="lg" focusable>
        <form
            :action="`/categories/${category.id}`"
            method="POST"
            class="space-y-4 p-6"
        >
            @csrf
            @method("PATCH")
            <div class="space-y-2">
                <x-input-label value="Nama Kategori" />
                <x-text-input id="name" name="name" x-model="category.name" />
            </div>
            <div class="space-y-2">
                <x-primary-button>Simpan</x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
