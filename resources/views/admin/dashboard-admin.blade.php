<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Admin</title>
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
<body class="px-3 bg-[#F4F6F9] font-poppins selection:bg-[#8AC054] selection:text-white">
    <livewire:layout.navbar />

    <main class="my-6 sm:ml-64">
        <livewire:layout.header />
        <div class="mb-6 sm:hidden">
            <h1 class="font-poppins font-semibold text-2xl text-gray-900">Hallo, {{ Auth::user()->name }}👋</h1>
            <p class="font-poppins font-medium text-sm text-gray-900 mt-1">Selamat datang di <span
                    class="text-[#8AC054]">CIGU</span> - webiste pengajuan cuti guru Mts At-Tarbiyah Gunungsari</p>
        </div>
        <div class="mb-12 flex justify-center w-full space-x-2">
            <div class="grid grid-cols-2 gap-2 w-full">
                <livewire:card.card-sisa-cuti-user />
                <livewire:card.cardjumlah-guru />
                <livewire:card.card-cuti-pending />
                <livewire:card.card-jumlah-pengajuan-cuti-guru />
            </div>
            <livewire:card.profile-user />
        </div>

        <div class="font-poppins">
            {{-- <div class="flex justify-between items-center w-full mb-3 text-[10px]">
                <h1 class="font-semibold text-lg">Riwayat Pengajuan Cuti</h1>
                <a href="#" class="flex gap-1 justify-center items-center text-gray-400 hover:text-gray-900">
                    <p class="font-normal text-xs">Lihat</p>
                    <i class='bx bx-right-arrow-alt'></i>
                </a>
            </div> --}}

            <div class="sm:hidden">
                <livewire:card.card-list-riwayat-cuti-user />
            </div>
            <div class="hidden sm:block">
                <livewire:table.table-riwayat-pengajuan-cuti-user />
            </div>
        </div>
    </main>

    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>