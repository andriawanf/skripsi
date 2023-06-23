<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | CIGU</title>
    {{-- vite --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    {{-- Logo --}}
    <link rel="shortcut icon" href="{{ url('images/logo.png') }}" type="image/x-icon">
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

<body class="selection:bg-[#8AC054] selection:text-white">
    {{-- <img src="{{url('images/bg-login.jpg')}}" alt="background login" class=" h-screen w-full"> --}}
    {{-- <main class="px-3 bg-[#F4F6F9] bg-opacity-25 min-h-screen selection:bg-[#8AC054] selection:text-white">
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
    </main> --}}
    <div class="lg:flex lg:flex-row-reverse font-poppins">
        <div class="lg:w-1/2 xl:max-w-screen-sm py-12 z-20 bg-[#F4F6F9] lg:bg-[#F4F6F9]">
            <div class="flex justify-center lg:justify-start lg:px-12 px-3">
                <div class="cursor-pointer flex flex-col items-center">
                    <img src="{{ url('images/logo.png') }}" alt="logo sekolah" class="w-20">
                    <h1 class="font-poppins font-semibold text-lg text-center text-gray-900 mt-3"> <span
                            class="text-[#8AC054]">CIGU</span> - Website Pengajuan Cuti Guru Mts
                        At-Tarbiyah</h1>
                </div>
            </div>
            <div class="mt-12 px-5 sm:px-24 md:px-48 lg:px-12 lg:mt-20 xl:px-24 xl:max-w-2xl">
                <div>
                    <h1 class="font-poppins font-semibold text-2xl lg:text-3xl text-gray-900">Login</h1>
                    <p class="font-poppins font-medium text-xs sm:text-md md:text-md lg:text-md text-gray-900 mt-2">
                        Nikmati kemudahan membuat
                        cuti dengan
                        praktis dan
                        efisien dalam genggaman Anda - Login sekarang juga!</p>
                </div>
                <div class="mt-8">
                    @if ($errors->any())
                        <div class="font-poppins text-red-700 text-base font-medium mb-8">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><span><i class='bx bxs-error-circle'></i> </span> {{ $error }}</li>
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
                            <div class="relative">
                                <input type="password" id="password-input" name="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="********" required>
                                <button type="button" class="absolute top-1 bottom-0 right-2.5 text-xl font-medium"
                                    onclick="togglePasswordVisibility()"><i id="password-toggle-icon"
                                        class='bx bxs-show'></i></button>
                            </div>
                        </div>
                        <div class="flex items-start mb-6">
                            {{-- <a href="#" for="remember"
                                class="text-sm font-semibold text-right text-gray-900 dark:text-gray-300 w-full">Lupa sandi?</a> --}}
                        </div>
                        <button type="submit"
                            class="text-gray-900 bg-gradient-to-r from-[#B4E080] to-[#8AC054] focus:ring-4 focus:outline-none focus:ring-gren-300 font-medium rounded-xl text-sm w-full px-5 py-2.5 text-center">Submit</button>
                    </form>
                    {{-- <div class="mt-6 text-sm font-display font-semibold text-gray-700 text-center">
                        Don't have an account ? <a href="{{route('register')}}" class="cursor-pointer text-[#B4E080] hover:text-[#8AC054]">Register</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="hidden lg:flex max-w-full h-screen" style="background-image: url({{ url('images/bg-1.jpeg') }})">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            <div class="w-full px-24 z-10 text-white flex flex-row justify-center items-center">
                <img src="{{ url('images/logo.png') }}" alt="logo sekolah" class="w-28 mr-6">
                <div class="font-poppins">
                    <h1 class="text-5xl font-bold text-left tracking-wide">Website <span
                            class="text-[#8AC054]">CIGU</span></h1>
                    <p class="text-2xl mt-4">Inovasi Cerdas untuk Kemudahan Pengajuan Cuti Guru Mts At-Tarbiyah
                        Gunungsari.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password-input");
            var passwordToggleIcon = document.getElementById("password-toggle-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggleIcon.classList.remove("bx bxs-hide");
                passwordToggleIcon.classList.add("bx bxs-show");
            } else {
                passwordInput.type = "password";
                passwordToggleIcon.classList.remove("bx bxs-show");
                passwordToggleIcon.classList.add("bx bxs-hide");
            }
        }
    </script>
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
