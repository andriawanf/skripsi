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
    @livewireStyles
    <style type="text/css">
        .sort .sorticon {
            visibility: visible;
            cursor: pointer;
            color: #1e1e1e;
        }
    </style>
</head>

<body class="px-3 bg-[#F4F6F9] font-poppins selection:bg-[#8AC054] selection:text-white">
    <livewire:layout.navbar />

    <main class="my-6 sm:ml-64">
        <livewire:layout.header />
        <div class="mb-6 sm:hidden">
            <h1 class="font-poppins font-semibold text-2xl text-gray-900">Riwayat Cuti Guru</h1>
            <p class="font-poppins font-medium text-sm text-gray-900 mt-1">List riwayat cuti guru dan request pending
                cuti guru</p>
        </div>

        <div class="font-poppins mb-12 sm:mb-20">
            <div class="flex justify-between items-center w-full mb-3 text-[10px]">
                <h1 class="font-semibold text-lg">Riwayat Pending Cuti Guru</h1>
            </div>

            <div class="">
                @if (session()->has('message'))
                    <div class="p-4 mb-4 text-sm text-gray-900 rounded-lg bg-[#8AC054] bg-opacity-30" role="alert">
                        <span class="font-medium">Sukses! </span> {{ session('message') }}
                    </div>
                @elseif (session()->has('error'))
                    <div class="p-4 mb-4 text-sm text-gray-900 rounded-lg bg-[#8AC054] bg-opacity-30" role="alert">
                        <span class="font-medium">Gagal! </span> {{ session('error') }}
                    </div>
                @endif
                <livewire:table.tabel-riwayat-cuti-pending />
            </div>
        </div>
        <div class="font-poppins">


            <div>
                <livewire:table.tabel-riwayat-cuti-guru>
            </div>
        </div>
    </main>

    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
