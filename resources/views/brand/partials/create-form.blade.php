<section>
    <form
        action="{{ route("brands.store") }}"
        method="POST"
        class="space-y-4 p-6"
    >
        @csrf
        <div class="space-y-2">
            <x-input-label value="Nama Brand" />
            <x-text-input autofocus id="name" name="name" />
        </div>
        <div class="space-y-2">
            <x-primary-button>Simpan</x-primary-button>
        </div>
    </form>
</section>
