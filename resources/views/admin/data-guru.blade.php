<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- vite --}}
    @vite('resources/css/app.css')
    {{-- font customs --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    {{-- flowbite cdn --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    {{-- icons cdn --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @livewireStyles
</head>

<body class="px-3 bg-[#F4F6F9] font-poppins selection:bg-[#8AC054] selection:text-white">
    <livewire:layout.navbar />

    <main class="my-6 sm:ml-64">
        <livewire:layout.header />
        <div class="mb-6 sm:hidden">
            <h1 class="font-poppins font-semibold text-2xl text-gray-900">Data Guru</h1>
            <p class="font-poppins font-medium text-sm text-gray-900 mt-1">tabel data guru Mts At-Tarbiyah Gunungsari
            </p>
        </div>

        <div class="font-poppins">
            <div class="flex justify-between items-center w-full mb-3 text-[10px]">
                <h1 class="font-semibold text-lg">Data Guru</h1>
                <div class="flex flex-row space-x-2">
                    <button
                        class="px-4 py-2 bg-gradient-to-r from-[#B4E080] to-[#8AC054] hover:bg-gradient-to-br text-sm font-medium rounded-lg flex flex-row space-x-2 items-center"
                        data-modal-target="addGuru" data-modal-show="addGuru">
                        <i class='bx bx-plus' class="text-lg"></i>
                        <span>Tambah Data Guru</span>
                    </button>
                    <div
                        class="px-4 py-2 bg-gradient-to-r from-[#B4E080] to-[#8AC054] hover:bg-gradient-to-br text-sm font-medium rounded-lg flex flex-row space-x-2 justify-center items-center">
                        <i class='bx bxs-printer'></i>
                        <a href="{{ route('download-data-guru') }}">Cetak Laporan</a>
                    </div>
                </div>
                <!-- Edit user modal -->
                <div id="addGuru" tabindex="-1" aria-hidden="true"
                    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
                    <div class="relative w-full max-w-2xl bg-white rounded-xl shadow-lg">
                        <!-- Modal content -->
                        <form action="{{ route('store-data-guru') }}" method="POST" enctype="multipart/form-data"
                            class="relative">
                            @csrf
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Edit user
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="addGuru">
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
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                            Pengguna</label>
                                        <input type="text" name="name" id="name"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="name pengguna" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="nip"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                                        <input type="text" name="nip" id="nip"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Nomor induk pegawai" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="jabatan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                                        <input type="text" name="jabatan" id="jabatan"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Guru" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="pangkat"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pangkat</label>
                                        <input type="text" name="pangkat" id="pangkat"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Guru" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="satuan_organisasi"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan
                                            Organisasi</label>
                                        <input type="text" name="satuan_organisasi" id="satuan_organisasi"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Guru" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="saldo_cuti"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saldo
                                            Cuti</label>
                                        <input type="number" name="saldo_cuti" id="saldo_cuti"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="1 - 12" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="email"
                                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">email</label>
                                        <input type="email" id="email" name="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="name@gmail.com" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="password"
                                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">password</label>
                                        <input type="password" id="password" name="password"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="********" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="role"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                        <select name="role" id="role"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            required>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                            <option value="kepala_sekolah">Kepala Sekolah</option>
                                        </select>
                                        {{-- <input name="foto"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('foto') is-invalid @enderror"
                                            id="foto" type="file"> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan
                                    data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="font-poppins">
                @if ($errors->any())
                    <div class="font-poppins text-red-700 text-base font-medium">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('message'))
                    <div id="toast-default"
                        class="flex items-center w-full p-4 text-black bg-[#8AC054] bg-opacity-30 rounded-lg shadow"
                        role="alert">
                        <div
                            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-black bg-white/25 rounded-lg">
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
                <livewire:table.data-guru />
            </div>
        </div>
    </main>

    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script>
        window.addEventListener('close-modal', event => {

            $('#editUserModal').modal('hide');
        })
    </script>
</body>

</html>
