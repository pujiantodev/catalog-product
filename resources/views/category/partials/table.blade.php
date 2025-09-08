<section
    x-data="{ category: { id: null, name: '' } }"
    @keydown.escape.window="showModal = false"
>
    <div class="relative overflow-x-scroll md:overflow-x-clip">
        <table
            class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400"
        >
            <thead
                class="bg-gray-50 text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Brand</th>
                    <th scope="col" class="px-6 py-3">Slug</th>
                    <th scope="col" class="px-6 py-3">Tanggal dibuat</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $item)
                    <tr
                        class="border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium whitespace-nowrap text-gray-900 dark:text-white"
                        >
                            {{ $item->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->slug }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->created_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{-- todo: tombol hapus dan edit --}}
                            <button
                                id="dropdownMenuIconButton"
                                data-dropdown-toggle="dropdownDots-{{ $item->id }}"
                                class="inline-flex items-center rounded-lg bg-white p-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-gray-50 focus:outline-none dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                type="button"
                            >
                                <i data-lucide="ellipsis-vertical"></i>
                            </button>

                            <!-- Dropdown menu -->
                            <div
                                id="dropdownDots-{{ $item->id }}"
                                class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow-sm dark:divide-gray-600 dark:bg-gray-700"
                            >
                                <ul
                                    class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownMenuIconButton"
                                >
                                    <li>
                                        <a
                                            href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            @click.prevent="$dispatch('open-modal', { name: 'edit-category', data: { id: {{ $item->id }}, name: '{{ addslashes($item->name) }}' } })"
                                        >
                                            Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="#"
                                            class="block px-4 py-2 hover:bg-red-100 dark:hover:bg-red-600 dark:hover:text-white"
                                            @click.prevent="$dispatch('open-modal', { name: 'delete-category', data: { id: {{ $item->id }}, name: '{{ addslashes($item->name) }}' } })"
                                        >
                                            Hapus
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <div>Belum ada data</div>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
    @include("category.partials.modal-edit")
    @include("category.partials.modal-delete")
</section>
