<form action="">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
        <table class="w-full table-auto text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Foto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        NIP
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Pangkat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Satuan Organisasi
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        Saldo Cuti
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    <tr
                        class="bg-white border-b border-gray-300 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 text-base font-semibold text-gray-900">
                            {{ $nomor++ }}
                        </td>
                        <td class="px-6 py-4 text-base font-semibold text-gray-900">
                            @if ($item->foto == 'images/logo.png')
                                <img class="w-10 h-10 object-cover rounded-full" src="{{ url('/' . $item->foto) }}"
                                    alt="Jese image">
                            @else
                                <img class="w-10 h-10 object-cover rounded-full"
                                    src="{{ asset('storage/foto-profil/' . $item->foto) }}" alt="foto Profil">
                            @endif
                        </td>
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="pl-3">
                                <div class="text-base font-semibold">{{ $item->name }}</div>
                                <div class="font-normal text-gray-500">{{ $item->jabatan }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4 text-base font-semibold text-gray-900">
                            {{ $item->nip }}
                        </td>
                        <td class="px-6 py-4 text-base font-semibold text-gray-900">
                            {{ $item->pangkat }}
                        </td>
                        <td class="px-6 py-4 text-base font-semibold text-gray-900 whitespace-nowrap">
                            {{ $item->satuan_organisasi }}
                        </td>
                        <td class="px-6 py-4 text-base font-semibold text-gray-900">
                            {{ $item->saldo_cuti }}
                        </td>
                        <td class="px-6 py-4 text-base font-semibold text-gray-900">
                            {{ $item->email }}
                        </td>
                        <td class="px-6 py-4 flex flex-row gap-3">
                            <!-- Modal toggle -->
                            <button wire:click='edit({{ $item->id }})' type="button"
                                data-modal-target="editUserModal" data-modal-show="editUserModal"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                            <button wire:click='confirmDelete({{ $item->id }})' type="button" data-modal-target="DeleteUserModal" data-modal-show="DeleteUserModal"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav class="flex items-center justify-between py-4 px-4 w-full">
            <div class="flex items-center justify-between w-full">
                <div class="flex">
                    <div class="flex justify-start">
                        <!-- Tombol Sebelumnya -->
                        @if ($users->onFirstPage())
                            <span class="inline-flex items-center px-4 py-2 text-xs md:text-sm font-medium text-gray-500 bg-gray-200 rounded-lg cursor-not-allowed">
                                Sebelumnya
                            </span>
                        @else
                            <button wire:click.prevent="previousPage" class="inline-flex items-center px-4 py-2 text-xs md:text-sm font-medium text-white bg-[#8AC054] rounded-lg">
                                Sebelumnya
                            </button>
                        @endif
                    </div>
                </div>
            
                <div class="flex">
                    <div class="flex justify-center space-x-1">
                        <!-- Nomor Halaman -->
                        @if ($users->lastPage() > 1)
                            @for ($i = 1; $i <= $users->lastPage(); $i++)
                                @if ($i == $users->currentPage())
                                    <span class="px-4 py-2 text-white text-xs md:text-sm bg-[#8AC054] rounded-lg">{{ $i }}</span>
                                @else
                                    <button wire:click.prevent="gotoPage({{ $i }})" class="px-4 py-2 text-gray-500 text-xs md:text-sm bg-gray-200 rounded-lg hover:bg-gray-300">{{ $i }}</button>
                                @endif
                            @endfor
                        @endif
                    </div>
                </div>
            
                <div class="flex">
                    <div class="flex justify-end">
                        <!-- Tombol Selanjutnya -->
                        @if ($users->hasMorePages())
                            <button wire:click.prevent="nextPage" class="inline-flex items-center px-4 py-2 text-xs md:text-sm font-medium bg-[#8AC054] rounded-lg">
                                Selanjutnya
                            </button>
                        @else
                            <span class="inline-flex items-center px-4 py-2 text-xs md:text-sm font-medium text-gray-500 bg-gray-200 rounded-lg cursor-not-allowed">
                                Selanjutnya
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        <!-- Edit user modal -->
        <div id="editUserModal" tabindex="-1" aria-hidden="true" wire:ignore.self
            class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
            <div class="relative w-full max-w-2xl bg-white rounded-xl shadow-lg">
                <!-- Modal content -->
                <form class="relative" >
                    {{-- <input type="hidden" wire:model="guru_id"> --}}
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Edit user
                        </h3>
                        <button type="button" wire:click='closeModal'
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="editUserModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="nama"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">nama
                                    Pengguna</label>
                                <input type="text" wire:model='nama'
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Nama pengguna">
                                @error('nama')
                                    <span class="text-red-700">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="nip"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                                <input type="text" wire:model='nip'
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Nomor induk pegawai">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="jabatan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                                <input type="text" wire:model='jabatan'
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Guru">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="pangkat"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pangkat</label>
                                <input type="text" wire:model='pangkat'
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Guru">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="satuan_organisasi"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan
                                    Organisasi</label>
                                <input type="text" wire:model='satuan_organisasi'
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Guru">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="saldo_cuti"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saldo
                                    Cuti</label>
                                <input type="number" wire:model='saldo_cuti'
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="1 - 12">
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                <label for="foto"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto
                                    Profil</label>
                                <input wire:model='foto'
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('foto') is-invalid @enderror"
                                    id="foto" type="file">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" wire:click.prevent="update"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan data</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Delete user modal -->
        <div id="DeleteUserModal" tabindex="-1" aria-hidden="true" wire:ignore.self
            class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
            <div class="relative w-[32rem] bg-white rounded-xl shadow-lg">
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Anda yakin ingin menghapus cuti ini?</h3>
                    <button wire:click.prevent='delete' type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Ya, Hapus
                    </button>
                    <button wire:click.prevent="closeModal"type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                </div>
        </div>
        {{-- <livewire:card.modal-edit-data-guru /> --}}
    </div>
</form>
