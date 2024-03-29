<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
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

<body class="px-3 bg-[#F4F6F9] font-poppins selection:bg-[#8AC054] selection:text-white overflow-x-hidden">
    {{-- loading spinner --}}
    <div id="loading-spinner" class="fixed z-50 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        <div class="square-circle-5"></div>
    </div>

    <livewire:layout.navbar />

    <main class="my-6 sm:ml-64" id="content" style="display: none">
        <livewire:layout.header />
        <div class="mb-6 sm:hidden">
            <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Hallo, {{ Auth::user()->name }}👋</h1>
            <p class="mt-1 text-sm font-medium text-gray-900 font-poppins">Selamat datang di <span
                    class="text-[#8AC054]">CIGU</span> - webiste pengajuan cuti guru Mts At-Tarbiyah Gunungsari</p>
        </div>

        <div class="flex justify-center w-full space-x-2 mb-9">
            <div class="grid w-full grid-cols-2 gap-2">
                <livewire:card.card-sisa-cuti-user />
                <livewire:card.card-riwayat-cuti-user />
                <livewire:card.card-ajukan-cuti-user />
            </div>
            <livewire:card.profile-user />
        </div>

        <div class="font-poppins">

            <div class="block sm:hidden">
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
