<form action="" class="font-poppins">

    <div>
        <div class="flex flex-col lg:flex-row gap-3 justify-between items-start lg:items-center w-full mb-3 text-[10px]">
            <h1 class="font-semibold text-lg">Riwayat Cuti Guru</h1>
            <div class="flex flex-row items-center space-x-4 mb-3 self-end">
                <a href="{{ route('download-laporan') }}"
                    class="text-center font-medium text-gray-900 py-2 px-4 bg-gradient-to-r from-[#B4E080] to-[#8AC054] hover:bg-gradient-to-br rounded-lg">
                    <p class="font-normal text-xs">Cetak laporan cuti</p>
                </a>
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
                    <th scope="col" class="px-6 py-3 whitespace-nowrap sort" wire:click="sortOrder('user_id')">Nama Guru {!! $orderColumn == 'user_id' ? $sortLink : '' !!}
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
                                {{ $loop->iteration }}
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
                            <td class="px-6 py-4 line-clamp-5 w-64">
                                {{ $item->alasan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->status }}
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
    <div class="flex items-center justify-end py-4 px-4 mt-2" aria-label="Table navigation">
        Menampilkan {{ $cutiGuru->count() }} dari {{ $cutiGuruTotal }} hasil
    {{ $cutiGuru->links() }}
    </div>

</form>
