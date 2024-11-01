<form action="" class="font-poppins">

    <div>
        <div class="flex flex-col lg:flex-row gap-3 justify-between lg:items-center w-full mb-3 text-[10px]">
            <h1 class="font-semibold text-lg">Riwayat Pending Cuti Guru</h1>
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
                        class="block w-full md:w-80 p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500"
                        placeholder="Search Mockups, Logos...">
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
                    <th scope="col" class="px-6 py-3 whitespace-nowrap" wire:click="sortOrder('user_id')">Nama Guru
                        {!! $orderColumn == 'user_id' ? $sortLink : '' !!}
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
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        File Bukti
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
                @if ($cutiPending->count())
                    {{-- table admin --}}
                    @foreach ($cutiPending as $item)
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
                            <td class="px-6 py-4 line-clamp-5 w-72">
                                {{ $item->alasan }}
                            </td>
                            <td class="px-6 py-4 ">
                                <a href="{{ asset('storage/file_bukti/' . $item->file_bukti) }}"
                                    class="text-blue-500 hover:text-blue-700 hover:underline">{{ $item->file_bukti }}</a>
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->status === 'Pending')
                                    <p class="text-orange-500">{{ $item->status }}</p>
                                @elseif ($item->status === 'Konfirmasi')
                                    <p class="text-[#4B89DA]">{{ $item->status }}</p>
                                @endif
                            </td>
                            @if ($item->status == 'Pending')
                                @if (Auth::user()->role == 'admin')
                                    <td class="px-6 py-4 flex flex-col gap-2">
                                        <button type="submit" wire:click.prevent='confirm({{ $item->id }})'
                                            class="px-4 py-2 rounded-lg font-medium text-white bg-blue-600 hover:underline">Konfirmasi</button>
                                        <button type="submit" wire:click.prevent='reject({{ $item->id }})'
                                            class="px-4 py-2 bg-red-600 rounded-lg font-medium text-white hover:underline">Tolak</button>
                                    </td>
                                @else
                                    <td class="px-6 py-4"></td>
                                @endif
                            @endif
                        </tr>
                    @endforeach
                    {{-- Table Kepsek --}}
                @elseif ($cutiKonfirmasi->count())
                    @foreach ($cutiKonfirmasi as $item)
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
                            <td class="px-6 py-4 ">
                                <a href="{{ asset('storage/file_bukti/' . $item->file_bukti) }}"
                                    class="text-blue-500 hover:text-blue-700 hover:underline">{{ $item->file_bukti }}</a>
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->status === 'Pending')
                                    <p class="text-orange-500">{{ $item->status }}</p>
                                @elseif ($item->status === 'Konfirmasi')
                                    <p class="text-[#4B89DA]">{{ $item->status }}</p>
                                @endif
                            </td>
                            @if ($item->status == 'Konfirmasi')
                                @if (Auth::user()->role == 'kepala_sekolah')
                                    <td class="px-6 py-4 flex flex-col gap-2">
                                        <button wire:click.prevent="prosesSetuju({{ $item->id }})"
                                            class="px-4 py-2 bg-blue-500 rounded-lg font-medium text-white hover:underline">Setuju</button>
                                        <button type="submit" wire:click='reject({{ $item->id }})'
                                            class="px-4 py-2 bg-red-600 rounded-lg font-medium text-white hover:underline">Tolak</button>
                                    </td>
                                @else
                                    <td class="px-6 py-4"></td>
                                @endif
                            @endif
                        </tr>
                    @endforeach
                @else
                    <td scope="col" colspan="8"
                        class="py-6 font-medium w-full text-center text-gray-900 whitespace-nowrap dark:text-white">
                        Tidak ada pengajuan cuti pending
                    </td>
                @endif
            </tbody>
        </table>
        <!-- Modal -->
        @if ($showModal)
            <div class="fixed inset-0 flex items-center justify-center z-50 font-poppins">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <div class="bg-white p-6 rounded-lg w-[32rem] relative z-10">
                    <h2 class="text-lg font-semibold">Input Tanda Tangan Persetujuan Cuti Guru</h2>
                    <div class="mt-4">
                        <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload file</span>
                        <input type="file" wire:model="fotoTandaTangan" aria-describedby="helper-text-explanation"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400"> <span
                                class="text-red-700">*</span>File foto tanda tangan harus dalam format .PNG </p>
                        @error('fotoTandaTangan')
                            <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4 flex justify-end space-x-2 font-poppins">
                        <button wire:click.prevent="approve"
                            class="bg-gradient-to-r from-[#B4E080] to-[#8AC054] text-white font-medium py-2 px-4 rounded-lg">
                            Setuju
                        </button>
                        <button wire:click.prevent="batal"
                            class="bg-red-600 text-white font-medium py-2 px-4 rounded-lg">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @if (Auth::user()->role == 'admin')
        <nav class="flex items-center justify-between py-4 px-4 w-full">
            <div class="flex items-center justify-between w-full">
                <div class="flex">
                    <div class="flex justify-start">
                        <!-- Tombol Sebelumnya -->
                        @if ($cutiPending->onFirstPage())
                            <span
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-200 rounded-md cursor-not-allowed">
                                Sebelumnya
                            </span>
                        @else
                            <button wire:click.prevent="previousPage"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#8AC054] rounded-md">
                                Sebelumnya
                            </button>
                        @endif
                    </div>
                </div>

                <div class="flex">
                    <div class="flex justify-center space-x-1">
                        <!-- Nomor Halaman -->
                        @if ($cutiPending->lastPage() > 1)
                            @for ($i = 1; $i <= $cutiPending->lastPage(); $i++)
                                @if ($i == $cutiPending->currentPage())
                                    <span
                                        class="px-4 py-2 text-white bg-[#8AC054] rounded-md">{{ $i }}</span>
                                @else
                                    <button wire:click.prevent="gotoPage({{ $i }})"
                                        class="px-4 py-2 text-gray-500 bg-gray-200 rounded-md hover:bg-gray-300">{{ $i }}</button>
                                @endif
                            @endfor
                        @endif
                    </div>
                </div>

                <div class="flex">
                    <div class="flex justify-end">
                        <!-- Tombol Selanjutnya -->
                        @if ($cutiPending->hasMorePages())
                            <button wire:click.prevent="nextPage"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium bg-[#8AC054] rounded-md">
                                Selanjutnya
                            </button>
                        @else
                            <span
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-200 rounded-md cursor-not-allowed">
                                Selanjutnya
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    @else
        <nav class="flex items-center justify-between py-4 px-4 w-full">
            <div class="flex items-center justify-between w-full">
                <div class="flex">
                    <div class="flex justify-start">
                        <!-- Tombol Sebelumnya -->
                        @if ($cutiKonfirmasi->onFirstPage())
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
                        @if ($cutiKonfirmasi->lastPage() > 1)
                            @for ($i = 1; $i <= $cutiKonfirmasi->lastPage(); $i++)
                                @if ($i == $cutiKonfirmasi->currentPage())
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
                        @if ($cutiKonfirmasi->hasMorePages())
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



</form>
