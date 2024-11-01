<form action="" class="font-poppins">

    @if (Request::is('riwayat-pengajuan-cuti'))
        <div class="flex flex-col items-center justify-between gap-4 mb-3 lg:mb-6 lg:flex-row lg:items-end">
            <div class="flex flex-col items-start justify-center sm:items-start">
                <h1 class="text-lg font-semibold text-gray-900 font-poppins">Riwayat Pengajuan Cuti</h1>
                <p class="mt-1 text-sm font-medium text-gray-900 font-poppins">List dari riwayat pengajuan cuti anda</p>
            </div>
            <div class="flex flex-row items-center gap-3 mb-3 lg:gap-4">
                <div
                    class="px-4 py-2 bg-gradient-to-r from-[#B4E080] to-[#8AC054] hover:bg-gradient-to-br text-sm font-medium rounded-lg flex flex-row space-x-2 justify-center items-center">
                    <i class='bx bxs-printer'></i>
                    <a href="{{ route('download-riwayat-cuti-guru') }}">Cetak Laporan Cuti</a>
                </div>
                <div>
                    <label for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="search" wire:model='searchTerm'
                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg lg:w-80 bg-gray-50 focus:ring-green-500 focus:border-green-500"
                            placeholder="Search Mockups, Logos...">
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex justify-between items-center w-full mb-3 text-[10px]">
            <h1 class="text-lg font-semibold">Riwayat Pengajuan Cuti</h1>
            <a href="{{ route('riwayat-cuti') }}"
                class="flex items-center justify-center gap-1 text-gray-400 hover:text-gray-900">
                <p class="text-xs font-normal">Lihat</p>
                <i class='bx bx-right-arrow-alt'></i>
            </a>
        </div>
    @endif
    <div class="relative w-full overflow-x-auto rounded-lg shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 table-auto dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap sort" wire:click="sortOrder('user_id')">Nama
                        Guru {!! $orderColumn == 'user_id' ? $sortLink : '' !!}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap sort" wire:click="sortOrder('kategori_id')">
                        Kategori {!! $orderColumn == 'kategori_id' ? $sortLink : '' !!}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap sort"
                        wire:click="sortOrder('subkategori_id')">
                        Sub-Kategori {!! $orderColumn == 'subkategori_id' ? $sortLink : '' !!}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap sort" wire:click="sortOrder('tanggal_mulai')">
                        Tanggal Mulai {!! $orderColumn == 'tanggal_mulai' ? $sortLink : '' !!}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap sort" wire:click="sortOrder('tanggal_akhir')">
                        Tanggal Akhir {!! $orderColumn == 'tanggal_akhir' ? $sortLink : '' !!}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap sort" wire:click="sortOrder('durasi')">
                        Total Cuti {!! $orderColumn == 'durasi' ? $sortLink : '' !!}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        Alasan
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap sort" wire:click="sortOrder('status')">
                        status {!! $orderColumn == 'status' ? $sortLink : '' !!}
                    </th>
                    @if (auth()->user()->role === 'user')
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                            Action
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="font-medium">
                @if ($cutiGuru->count())
                    @foreach ($cutiGuru as $item)
                        <tr
                            class="bg-white border-b border-gray-300 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $nomor++ }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->user->name }}
                            </th>

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->kategori->nama }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ optional($item->subkategori)->nama_subkategoris ?? '-' }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->tanggal_mulai }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->tanggal_akhir }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->durasi }} Hari
                            </td>
                            <td class="w-64 max-w-lg px-6 py-4 font-medium text-gray-900 line-clamp-5">
                                {{ $item->alasan }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if ($item->status === 'Setuju')
                                    <p class="text-[#8AC054]">{{ $item->status }}</p>
                                @elseif ($item->status === 'Konfirmasi')
                                    <p class="text-[#4B89DA]">{{ $item->status }}</p>
                                @else
                                    <p class="text-red-500">{{ $item->status }}</p>
                                @endif
                            </td>
                            @if (auth()->user()->role === 'user')
                                @if ($item->status == 'Pending' || $item->status == 'Konfirmasi')
                                    <td
                                        class="flex flex-col gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <button wire:click.prevent='editCuti({{ $item->id }})'
                                            class="px-4 py-2 bg-gradient-to-tr from-[#73B1F4] to-[#4B89DA] rounded-lg font-medium text-white hover:underline">Edit</button>
                                        <button wire:click.prevent='confirmDelete({{ $item->id }})'
                                            class="px-4 py-2 font-medium text-white bg-red-600 rounded-lg hover:underline">Hapus</button>
                                    </td>
                                @else
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <button wire:click.prevent='exportDocx({{ $item->id }})'
                                            class="px-4 py-2 bg-gradient-to-tr from-[#73B1F4] to-[#4B89DA] rounded-lg font-medium text-white hover:underline">Download</button>
                                    </td>
                                @endif
                            @endif
                        </tr>
                    @endforeach
                @else
                    <td scope="col" colspan="8"
                        class="w-full py-6 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">
                        Tidak ada riwayat pengajuan cuti
                    </td>
                @endif
            </tbody>
        </table>
    </div>
    @if (Request::is('riwayat-pengajuan-cuti'))
        <nav class="flex items-center justify-between w-full px-4 py-4">
            <div class="flex items-center justify-between w-full">
                <div class="flex">
                    <div class="flex justify-start">
                        <!-- Tombol Sebelumnya -->
                        @if ($cutiGuru->onFirstPage())
                            <span
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-200 rounded-lg cursor-not-allowed">
                                Sebelumnya
                            </span>
                        @else
                            <button wire:click.prevent="previousPage"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#8AC054] rounded-lg">
                                Sebelumnya
                            </button>
                        @endif
                    </div>
                </div>

                <div class="flex">
                    <div class="flex justify-center space-x-1">
                        <!-- Nomor Halaman -->
                        @if ($cutiGuru->lastPage() > 1)
                            @for ($i = 1; $i <= $cutiGuru->lastPage(); $i++)
                                @if ($i == $cutiGuru->currentPage())
                                    <span
                                        class="px-4 py-2 text-white bg-[#8AC054] rounded-lg">{{ $i }}</span>
                                @else
                                    <button wire:click.prevent="gotoPage({{ $i }})"
                                        class="px-4 py-2 text-gray-500 bg-gray-200 rounded-lg hover:bg-gray-300">{{ $i }}</button>
                                @endif
                            @endfor
                        @endif
                    </div>
                </div>

                <div class="flex">
                    <div class="flex justify-end">
                        <!-- Tombol Selanjutnya -->
                        @if ($cutiGuru->hasMorePages())
                            <button wire:click.prevent="nextPage"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium bg-[#8AC054] rounded-lg">
                                Selanjutnya
                            </button>
                        @else
                            <span
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-200 rounded-lg cursor-not-allowed">
                                Selanjutnya
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    @endif

    <!-- Main modal Edit -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Overlay -->
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-black bg-opacity-40 backdrop-filter backdrop-blur-sm"></div>
                </div>

                <!-- Modal Content -->
                <div
                    class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl rounded-xl sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
                    <!-- Modal Body -->
                    <div class="px-4 py-6 sm:p-8">
                        <h1 class="pb-3 text-lg font-semibold border-b border-gray-300 sm:text-2xl font-poppins">Edit
                            data cuti</h1>
                        <!-- Form Edit -->
                        <form wire:submit.prevent="updateCuti">
                            <div class="pt-6 mb-6">
                                <label for="kategori"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Guru</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    wire:model='dataUser'>
                                @error('dataGuru')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh,
                                            tidak!</span>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="kategori"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                                    Cuti</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    wire:model='kategori_dipilih' readonly>
                            </div>
                            <div class="mb-6">
                                <label for="kategori"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub-Kategori
                                    Cuti</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    @if ($subkategori_dipilih != null) value="{{ $subkategori_dipilih }}"
                                @else
                                    value="N/A" @endif
                                    readonly>
                            </div>
                            <div class="mb-6">
                                <label for="tanggal"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                    Cuti</label>
                                <div class="flex items-center">
                                    <div class="relative w-full">
                                        <input id="tanggal_mulais" type="date" wire:model='tanggal_mulais'
                                            wire:ignore
                                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="pilih tanggal mulai">
                                    </div>
                                    <span class="mx-3 text-sm font-medium text-gray-900">sampai</span>
                                    <div class="relative w-full">
                                        <input id="tanggal_akhirs" type="date" wire:model='tanggal_akhirs'
                                            wire:ignore
                                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Pilih tanggal akhir">
                                    </div>
                                </div>
                                @error('tanggal_mulais')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh,
                                            tidak!</span>
                                        {{ $message }}</p>
                                @enderror
                                @error('tanggal_akhirs')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh,
                                            tidak!</span>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="fileBuktiCuti"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload File
                                    Bukti</label>
                                <input wire:model.defer='fileBuktiCuti' id="fileBuktiCuti" name="fileBuktiCuti"
                                    class="block w-full text-sm text-gray-900 bg-white border border-gray-300 rounded-lg cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    value="{{ asset('storage/file_bukti/' . $cuti->file_bukti) }}" id="foto"
                                    type="file">
                                @error('fileBuktiCuti')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh,
                                            tidak!</span>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="number"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Tanda
                                    Tangan</label>
                                <input wire:model='file_tanda_tangan'
                                    class="block w-full text-sm text-gray-900 bg-white border border-gray-300 rounded-lg cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="foto" type="file">
                                @error('file_tanda_tangan')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh,
                                            tidak!</span>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="message"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alasan</label>
                                <textarea id="alasanCuti" rows="4" wire:model='alasanCuti' name="alasanCuti"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Tuliskan alasan anda disini..."></textarea>
                                @error('alasanCuti')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh,
                                            tidak!</span>
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-2">
                                <!-- Tombol Submit -->
                                <button wire:click.prevent="updateCuti"
                                    class="px-4 py-2 bg-gradient-to-tr from-[#73B1F4] to-[#4B89DA] rounded-lg font-medium text-white hover:underline">Simpan
                                    Perubahan</button>
                                <button class="px-4 py-2 font-medium text-white bg-red-600 rounded-lg hover:underline"
                                    wire:click.prevent="$set('showModal', false)">Batal</button>
                            </div>
                        </form>
                        <!-- Add the following class to make the modal scrollable -->
                        <div class="overflow-y-auto max-h-80">
                            <!-- Modal content that can be scrolled -->
                        </div>

                        <!-- End of Content -->
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Main modal Delete -->
    @if ($showModalHapus)
        <div wire:ignore.self
            class="fixed top-0 left-0 right-0 z-50 items-center justify-center w-full p-4 md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
            <div class="relative w-[32rem] bg-white rounded-xl shadow-lg">
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Anda yakin ingin menghapus
                        cuti ini?</h3>
                    <button wire:click.prevent='delete' type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Ya, Hapus
                    </button>
                    <button wire:click.prevent="$set('showModalHapus', false)"type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                </div>
            </div>
    @endif
</form>
