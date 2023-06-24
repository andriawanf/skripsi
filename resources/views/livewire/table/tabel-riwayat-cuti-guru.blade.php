<form action="" class="font-poppins">

    <div>
        <div class="flex flex-col lg:flex-row gap-3 justify-between items-start lg:items-center w-full mb-3 text-[10px]">
            <h1 class="font-semibold text-lg">Riwayat Cuti Guru</h1>
            <div class="flex flex-row items-center space-x-4 mb-3 self-end">
                <div
                    class="px-4 py-2 bg-gradient-to-r from-[#B4E080] to-[#8AC054] hover:bg-gradient-to-br text-sm font-medium rounded-lg flex flex-row space-x-2 justify-center items-center">
                    <i class='bx bxs-printer'></i>
                    <a href="{{ route('cetakLaporan') }}">Cetak Laporan Cuti</a>
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
                            class="block w-40 lg:w-80 p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500"
                            placeholder="Search Mockups, Logos...">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="relative w-full overflow-x-auto shadow-md rounded-lg sm:rounded-lg">
        <table class="w-full table-auto text-sm text-left text-gray-900 dark:text-gray-400">
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
                    <th scope="col" class="px-6 py-3 whitespace-nowrap" wire:click="sortOrder('subkategori_id')">
                        Sub-Kategori {!! $orderColumn == 'subkategori_id' ? $sortLink : '' !!}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap" wire:click="sortOrder('tanggal_mulai')">
                        Tanggal Mulai {!! $orderColumn == 'tanggal_mulai' ? $sortLink : '' !!}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap" wire:click="sortOrder('tanggal_akhir')">
                        Tanggal Akhir {!! $orderColumn == 'tanggal_akhir' ? $sortLink : '' !!}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap" wire:click="sortOrder('durasi')">
                        Total Cuti {!! $orderColumn == 'durasi' ? $sortLink : '' !!}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        File Bukti
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        Alasan
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap" wire:click="sortOrder('status')">
                        status {!! $orderColumn == 'status' ? $sortLink : '' !!}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        Action
                    </th>
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

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $item->kategori->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ optional($item->subkategori)->nama_subkategoris ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->tanggal_mulai }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->tanggal_akhir }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->durasi }} Hari
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ asset('/storage/file_bukti/' . $item->file_bukti) }}"
                                    class="text-blue-500 hover:text-blue-700 hover:underline">{{ $item->file_bukti }}</a>
                            </td>
                            <td class="px-6 py-4 line-clamp-5 w-64">
                                {{ $item->alasan }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->status === 'Setuju')
                                    <p class="text-[#8AC054]">{{ $item->status }}</p>
                                @elseif ($item->status === 'Konfirmasi')
                                    <p class="text-[#4B89DA]">{{ $item->status }}</p>
                                @else
                                    <p class="text-red-500">{{ $item->status }}</p>
                                @endif
                            </td>
                            @if ($item->status == 'Pending' && Auth::user()->role == 'admin')
                                <td class="px-6 py-4">
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            @else
                                <td class="px-6 py-4">
                                    <button wire:click.prevent='exportDocx({{ $item->id }})'
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Download</button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <td scope="col" colspan="8"
                        class="py-6 font-medium w-full text-center text-gray-900 whitespace-nowrap dark:text-white">
                        Tidak ada riwayat pengajuan cuti
                    </td>
                @endif
            </tbody>
        </table>
    </div>
    <nav class="flex items-center justify-between py-4 px-4 w-full">
        <div class="flex items-center justify-between w-full">
            <div class="flex">
                <div class="flex justify-start">
                    <!-- Tombol Sebelumnya -->
                    @if ($cutiGuru->onFirstPage())
                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-200 rounded-lg cursor-not-allowed">
                            Sebelumnya
                        </span>
                    @else
                        <button wire:click.prevent="previousPage" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#8AC054] rounded-lg">
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
                                <span class="px-4 py-2 text-white bg-[#8AC054] rounded-lg">{{ $i }}</span>
                            @else
                                <button wire:click.prevent="gotoPage({{ $i }})" class="px-4 py-2 text-gray-500 bg-gray-200 rounded-lg hover:bg-gray-300">{{ $i }}</button>
                            @endif
                        @endfor
                    @endif
                </div>
            </div>
        
            <div class="flex">
                <div class="flex justify-end">
                    <!-- Tombol Selanjutnya -->
                    @if ($cutiGuru->hasMorePages())
                        <button wire:click.prevent="nextPage" class="inline-flex items-center px-4 py-2 text-sm font-medium bg-[#8AC054] rounded-lg">
                            Selanjutnya
                        </button>
                    @else
                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-200 rounded-lg cursor-not-allowed">
                            Selanjutnya
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </nav>

</form>
