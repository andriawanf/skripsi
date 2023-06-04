<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    {{-- vite --}}
    @vite('resources/css/app.css')
    {{-- font customs --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    {{-- flowbite cdn --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    @livewireStyles
</head>

<body>
    {{-- <img src="{{url('images/bg-login.jpg')}}" alt="background login" class=" h-screen w-full"> --}}
    <main class="px-3 bg-[#F4F6F9] bg-opacity-25 min-h-screen selection:bg-[#8AC054] selection:text-white">
        <div class="w-full flex flex-col justify-center items-center py-9 sm:py-16">
            <img src="{{ url('images/logo.png') }}" alt="logo sekolah" class="w-24">
            <h1 class="font-poppins font-semibold text-lg text-center text-gray-900 mt-3"> <span
                    class="text-[#8AC054]">CIGU</span> - Website Pengajuan Cuti Guru Mts
                At-Tarbiyah</h1>
        </div>
        <div class="flex flex-col space-y-6 sm:mx-64 sm:mt-20">
            <div>
                <h1 class="font-poppins font-semibold text-2xl text-gray-900">Login</h1>
                <p class="font-poppins font-medium text-[10px] text-gray-900 mt-2">Nikmati kemudahan membuat cuti dengan
                    praktis dan
                    efisien dalam genggaman Anda - Login sekarang juga!</p>
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
            <form class="font-poppins" action="{{ route('login') }}" method="POST">
                @csrf
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
                <div class="flex items-start mb-6">
                    <a href="#" for="remember"
                        class="text-sm font-semibold text-right text-gray-900 dark:text-gray-300 w-full">Lupa sandi?</a>
                </div>
                <button type="submit"
                    class="text-gray-900 bg-gradient-to-r from-[#B4E080] to-[#8AC054] focus:ring-4 focus:outline-none focus:ring-gren-300 font-medium rounded-xl text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
            </form>
        </div>
    </main>


    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
