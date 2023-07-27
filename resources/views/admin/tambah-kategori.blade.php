<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Kategori</title>
    {{-- vite --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    {{-- Logo --}}
    <link rel="shortcut icon" href="{{url('images/logo.png')}}" type="image/x-icon">
    {{-- font customs --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    {{-- flowbite cdn --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    {{-- icons cdn --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @livewireStyles
</head>

<body class="px-3 bg-[#F4F6F9] font-poppins selection:bg-[#8AC054] selection:text-white">
    {{-- loading spinner --}}
    <div id="loading-spinner" class="fixed z-50 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        <div class="square-circle-5"></div>
    </div>

    <livewire:layout.navbar />

    <main class="my-6 sm:ml-64" id="content" style="display: none">
        <livewire:layout.header />
        <div class="mb-6 sm:hidden">
            <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Data Cuti</h1>
            <p class="mt-1 text-sm font-medium text-gray-900 font-poppins">tabel data guru Mts At-Tarbiyah Gunungsari
            </p>
        </div>

        {{-- form dan tabel Kategori --}}
        <div class="mb-16 font-poppins">
            <div class="flex justify-between items-center w-full mb-3 text-[10px]">
                <h1 class="text-lg font-semibold">Pengaturan Data Kategori</h1>
                <button
                    class="hidden md:flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-[#B4E080] to-[#8AC054] hover:bg-gradient-to-br text-xs md:text-sm font-medium rounded-lg"
                    data-modal-target="addKategori" data-modal-show="addKategori"><i class='bx bx-plus' class="text-xs md:text-lg"></i><span>Tambah Kategori</span></button>
                <button
                    class="block md:hidden px-4 py-2 bg-gradient-to-r from-[#B4E080] to-[#8AC054] hover:bg-gradient-to-br text-xs md:text-sm font-medium rounded-lg"
                    data-modal-target="addKategori" data-modal-show="addKategori">+</button>
                <!-- Tambah kategori modal -->
                <div id="addKategori" tabindex="-1" aria-hidden="true"
                    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
                    <div class="relative w-full max-w-2xl bg-white shadow-lg rounded-xl">
                        <!-- Modal content -->
                        <form action="{{ route('store-data-kategori') }}" method="POST" enctype="multipart/form-data"
                            class="relative">
                            @csrf
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Tambah data Kategori
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="addKategori">
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
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="kategori"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">nama
                                            Kategori</label>
                                        <input type="text" name="nama" id="nama"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Nama kategori" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit"
                                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan
                                    data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if (session()->has('message'))
                <div id="toast-default"
                    class="flex items-center w-full p-4 text-black bg-[#8AC054] bg-opacity-30 rounded-lg shadow mb-6"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-black rounded-lg bg-white/25">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Fire icon</span>
                    </div>
                    <div class="ml-3 text-sm font-normal"><span class="font-medium">Sukses! </span>
                        {{ session('message') }}</div>
                    <button type="button"
                        class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-dismiss-target="#toast-default" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif
            {{-- tabel kategori --}}
            <div class="font-poppins">
                @if ($errors->any())
                    <div class="text-base font-medium text-red-700 font-poppins">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="relative overflow-x-auto rounded-lg shadow-lg sm:rounded-xl">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Kategori
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Sub-Kategori
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $item)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td scope="row"
                                        class="items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="text-base font-medium">{{ $loop->iteration }}</div>
                                    </td>
                                    <th scope="row"
                                        class="items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="text-base font-medium">{{ $item->nama }}</div>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->subkategori_nama ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <!-- Modal toggle -->
                                        <button type="button" data-modal-target="EditKategori-{{$item->id}}"
                                            data-modal-show="EditKategori-{{$item->id}}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                        </button>
                                        <!-- Edit kategori modal -->
                    <div id="EditKategori-{{$item->id}}" tabindex="-1" aria-hidden="true"
                    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
                    <div class="relative w-full max-w-2xl bg-white shadow-lg rounded-xl">
                        <!-- Modal content -->
                        <form action="{{route('update-data-kategori', $item->id)}}" method="POST"
                            enctype="multipart/form-data" class="relative">
                            @csrf
                            <!-- Modal header -->
                            <div
                                class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Edit data Kategori
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="EditKategori-{{$item->id}}">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="kategori"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">nama
                                            Kategori</label>
                                        <input type="text" name="nama" id="nama"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            value="{{$item->nama}}" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit"
                                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan
                                    data</button>
                            </div>
                        </form>
                    </div>
                </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $kategori->links() }}
                    
                </div>

            </div>
        </div>
    </main>
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
