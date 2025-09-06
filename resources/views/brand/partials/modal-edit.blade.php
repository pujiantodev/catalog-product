<!-- Modal Edit -->
<div
    x-data="{ brand: { id: null, name: '' } }"
    x-on:open-modal.window="
        if ($event.detail.name === 'edit-brand') {
            brand = $event.detail.data
            $dispatch('open-modal', 'edit-brand') // trigger modal tampil
        }
    "
>
    <x-modal name="edit-brand" :show="false" maxWidth="lg" focusable>
        <form
            :action="`/brands/${brand.id}`"
            method="POST"
            class="space-y-4 p-6"
        >
            @csrf
            @method("PATCH")
            <div class="space-y-2">
                <x-input-label value="Nama Brand" />
                <x-text-input id="name" name="name" x-model="brand.name" />
            </div>
            <div class="space-y-2">
                <x-primary-button>Simpan</x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
