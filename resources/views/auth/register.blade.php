<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
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
    @livewireStyles
</head>

<body>
    <div class="min-h-screen selection:bg-[#8AC054] selection:text-white flex">
        <div class=" z-10 inset-0 bg-no-repeat bg-cover items-center fixed" style="background-image: url({{url('images/bg-3.jpeg')}});">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        </div>
        <div class="w-full z-20 bg-[#F4F6F9] m-0 lg:m-24 px-6 py-6 lg:rounded-3xl">
            <div class="w-full flex flex-row justify-center items-center mb-9 gap-4 lg:gap-6">
                <img src="{{ url('images/logo.png') }}" alt="logo sekolah" class="w-16 lg:w-24">
                <h1 class="font-poppins font-semibold text-md lg:text-2xl text-left text-gray-900 mt-3 w-96"> <span
                        class="text-[#8AC054]">CIGU</span> - Website Pengajuan Cuti Guru Mts
                    At-Tarbiyah</h1>
            </div>
            <div class="flex flex-col space-y-6 lg:mt-20">
                <div>
                    <h1 class="font-poppins font-semibold text-xl lg:text-2xl text-gray-900">Registrasi Akun</h1>
                    <p class="font-poppins font-medium text-xs lg:text-lg text-gray-900 mt-2">Nikmati kemudahan membuat cuti dengan
                        praktis dan
                        efisien dalam genggaman Anda - Registrasi sekarang juga!</p>
                </div>
                @if ($errors->any())
                    <div class="font-poppins text-red-700 text-base font-medium">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="font-poppins" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="name" 
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Nama pengguna</label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize"
                            placeholder="masukan nama pengguna anda" required>
                    </div>
                    <div class="mb-6">
                        <label for="nip" 
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Nomor Induk Pegawai (NIP)</label>
                        <input type="text" id="nip" name="nip"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="masukan NIP anda" required>
                    </div>
                    <div class="mb-6">
                        <label for="jabatan" 
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize"
                            placeholder="masukan jabatan anda" required>
                    </div>
                    <div class="mb-6">
                        <label for="pangkat" 
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Pangkat</label>
                        <input type="text" id="pangkat" name="pangkat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize"
                            placeholder="masukan pangkat anda" required>
                    </div>
                    <div class="mb-6">
                        <label for="satuan_organisasi" 
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Satuan Organisasi</label>
                        <input type="text" id="satuan_organisasi" name="satuan_organisasi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize"
                            placeholder="masukan satuan organisasi anda" required>
                    </div>
                    <div class="mb-6">
                        <label for="email" 
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">email</label>
                        <input type="email" id="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@gmail.com" required>
                    </div>
                    <div class="mb-6">
                        <label for="password"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">password</label>
                        <input type="password" id="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="********" required>
                    </div>
                    <div class="mb-12">
                        <label for="role"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">role</label>
                        <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="kepala_sekolah">Kepala Sekolah</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="text-gray-900 bg-gradient-to-r from-[#B4E080] to-[#8AC054] focus:ring-4 focus:outline-none focus:ring-gren-300 font-medium rounded-xl text-sm w-full px-5 py-2.5 text-center">Submit</button>
                </form>
                <div class="mt-12 text-sm font-display font-semibold text-gray-700 text-center">Already have an account ? <a href="{{route('login')}}" class="cursor-pointer text-[#B4E080] hover:text-[#8AC054]">Login</a>
                </div>
            </div>
        </div>
    </div>


    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
