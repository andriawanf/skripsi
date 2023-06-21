<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
    <div id="loading-spinner" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
        <div class="square-circle-5"></div>
    </div>

    <livewire:layout.navbar />

    <main class="my-6 md:ml-64" id="content" style="display: none">
        <livewire:layout.header />
        <div class="mb-6">
            <h1 class="font-poppins font-semibold text-lg text-gray-900">Pengaturan Profil</h1>
            <p class="font-poppins font-medium text-sm text-gray-900 mt-1">Atur profil anda dengan baik dan benar!</p>
        </div>

        <livewire:form.pengaturan-profil-user />
    </main>


    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>