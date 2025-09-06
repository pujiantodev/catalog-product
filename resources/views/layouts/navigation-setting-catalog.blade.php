<x-card>
    <ul class="space-y-2 font-medium">
        <li>
            <x-nav-link2
                href="{{ route('brands.index') }}"
                :active="request()->routeIs('brands.*')"
            >
                Brand
            </x-nav-link2>
        </li>
        <li>
            <x-nav-link2 href="#">Kategori</x-nav-link2>
        </li>
    </ul>
</x-card>
