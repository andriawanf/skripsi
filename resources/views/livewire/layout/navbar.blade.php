<div class="flex flex-row justify-between">
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 text-sm text-gray-900 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <div class="flex flex-row justify-center items-center space-x-3 p-2 mt-2 sm:hidden">
        <i class='bx bxs-bell bx-sm text-gray-900'></i>
        <img src="{{ url('images/foto.jpg') }}" alt="foto profile" class="w-10 h-10 rounded-full object-cover"
            data-popover-target="popover-user-profile">
        <div data-popover id="popover-user-profile" role="tooltip"
            class="absolute z-10 invisible inline-block w-36 font-poppins font-medium text-sm text-gray-900 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
            <div class="p-3">
                <ul class="space-y-3">
                    <li>Profile</li>
                    <li>Pengaturan</li>
                    <li>Keluar</li>
                </ul>
            </div>
            <div data-popper-arrow></div>
        </div>
    </div>
</div>

<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 font-poppins flex flex-col justify-between px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800 shadow-md border-r border-gray-200"
    aria-label="Sidebar">
    <div class="h-full">
        <a href="#" class="flex flex-col pl-2.5 pb-5 border-b">
            <h1 class="text-3xl font-bold text-[#8AC054]">CIGU</h1>
            <p class="font-medium text-xs">Website Pengajuan Cuti Guru</p>
        </a>
        <ul class="space-y-4 font-medium pt-5 text-xs">
            @if (Auth::user()->role == 'user')
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <img src="{{ url('images/home.svg') }}" alt="beranda">
                        <span class="ml-3">Beranda</span>
                    </a>
                </li>
            @elseif (Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('admin') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <img src="{{ url('images/home.svg') }}" alt="beranda">
                        <span class="ml-3">Beranda</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('kepala_sekolah') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <img src="{{ url('images/home.svg') }}" alt="beranda">
                        <span class="ml-3">Beranda</span>
                    </a>
                </li>
            @endif
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <img src="{{ url('images/calendar.svg') }}" alt="pengajuan cuti">
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Pengajuan Cuti</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    @if (Auth::user()->role == 'user')
                        <li>
                            <a href="{{ route('cuti-tahunan') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Ajukan
                                Cuti</a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'kepala_sekolah')
                        <li>
                            <a href="{{ route('tambah-kategori') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tambah
                                Data Kategori</a>
                        </li>
                        <li>
                            <a href="{{ route('tambah-subkategori') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tambah
                                Data Sub-kategori</a>
                        </li>
                    @endif
                </ul>
            </li>
            @if (Auth::user()->role == 'user')
                <li>
                    <a href="{{ route('riwayat-cuti') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <img src="{{ url('images/inbox.svg') }}" alt="">
                        <span class="flex-1 ml-3 whitespace-nowrap">Riwayat Cuti</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'kepala_sekolah')
                <li>
                    <a href="{{ route('riwayat-cuti-guru') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <img src="{{ url('images/envelope.svg') }}" alt="">
                        <span class="flex-1 ml-3 whitespace-nowrap">Riwayat Cuti Guru</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('data-guru') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <img src="{{ url('images/users-three.svg') }}" alt="">
                        <span class="flex-1 ml-3 whitespace-nowrap">Data Guru</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('pengaturan') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="{{ url('images/settings.svg') }}" alt="">
                    <span class="flex-1 ml-3 whitespace-nowrap">Pengaturan</span>
                </a>
            </li>
        </ul>
    </div>
    <form action="{{ route('logout') }}" method="GET">
        <button class="px-3 py-2 w-full bg-red-600 hover:bg-red-800 rounded-lg text-medium text-white">Keluar</button>
    </form>
</aside>
