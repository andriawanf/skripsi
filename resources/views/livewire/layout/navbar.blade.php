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

    <div class="flex flex-row items-center justify-center p-2 mt-2 space-x-3 sm:hidden">
        {{-- notifikasi --}}
        <button type="button" class="relative inline-flex items-center mr-2 text-sm font-medium text-center text-white"
            data-popover-target="data-notifikasi">
            <i class='text-gray-900 bx bxs-bell bx-sm'></i>
            <span class="sr-only">Notifications</span>
            <div
                class="absolute inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-600 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">
                @if ($unreadNotificationsCount > 0)
                    <span class="badge">{{ $unreadNotificationsCount }}</span>
                @else
                    <span class="badge">0</span>
                @endif
            </div>
        </button>
        <div data-popover id="data-notifikasi" role="tooltip"
            class="absolute z-10 invisible text-sm font-medium text-gray-900 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 w-96 font-poppins dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
            <div class="p-3">
                <ul class="space-y-4">
                    @forelse ($notifications as $notification)
                        <div class="flex flex-row items-baseline justify-between space-x-2">
                            <li class="w-full pb-2 border-b border-gray-300 notification">
                                {{ $notification->data['message'] }}</li>
                            <button wire:click="markAsRead('{{ $notification->id }}')"
                                class="px-3 py-2 text-white bg-red-600 rounded-lg w-fit hover:bg-red-800 text-medium">Baca</button>
                        </div>
                    @empty
                        <li class="w-full pb-2 text-center border-b border-gray-300 notification">Tidak ada notifikasi
                            baru untuk anda</li>
                    @endforelse

                </ul>
            </div>
            <div data-popper-arrow></div>
        </div>
        {{--  --}}

        {{-- foto profil user --}}
        @if (auth()->user()->foto == 'images/logo.png')
                <img src="{{ url('/' . auth()->user()->foto) }}" alt="foto profile"
                    class="object-cover w-10 h-10 rounded-full" data-popover-target="foto-profil-user">
            @else
                <img src="{{ asset('storage/foto-profil/' . auth()->user()->foto) }}" alt="foto profile"
                    class="object-cover w-10 h-10 rounded-full" data-popover-target="foto-profil-user">
            @endif
            <div data-popover id="foto-profil-user" role="tooltip"
                class="absolute z-10 invisible inline-block text-sm font-medium text-gray-900 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 w-44 font-poppins dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                <div class="p-3">
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('pengaturan') }}" class="text-gray-900 rounded-lg hover:bg-gray-100">
                                <span class="">Pengaturan profil</span>
                            </a>
                        </li>
                        <li>
                            <div class="w-full h-[1px] bg-gray-300"></div>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="GET">
                                <button
                                    class="w-full px-3 py-2 text-white bg-red-600 rounded-lg hover:bg-red-800 text-medium">Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div data-popper-arrow></div>
            </div>
    </div>
</div>

<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 flex flex-col justify-between w-64 h-screen px-3 py-4 overflow-y-auto transition-transform -translate-x-full border-r border-gray-200 shadow-md sm:translate-x-0 font-poppins bg-gray-50 dark:bg-gray-800"
    aria-label="Sidebar">
    <div class="h-full">
        <a href="#" class="flex flex-col pl-2.5 pb-5 border-b">
            <h1 class="text-3xl font-bold text-[#8AC054]">CIGU</h1>
            <p class="text-xs font-medium">Website Pengajuan Cuti Guru</p>
        </a>
        <ul class="pt-5 space-y-4 text-xs font-medium">
            @if (Auth::user()->role == 'user')
                <li class="{{ '/' == request()->path() ? 'active' :  '' }} rounded-xl">
                    <a href="{{ route('home') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F4F6F9]">
                        <img src="{{ url('images/home.svg') }}" alt="beranda">
                        <span class="ml-3">Beranda</span>
                    </a>
                </li>
            @elseif (Auth::user()->role == 'admin')
                <li class="{{ 'admin/dashboard-admin' == request()->path() ? 'active' :  '' }} rounded-xl">
                    <a href="{{ route('admin') }}"
                        class="flex items-center p-2 text-gray-900 rounded-xl dark:text-white hover:bg-[#F4F6F9]">
                        <img src="{{ url('images/home.svg') }}" alt="beranda">
                        <span class="ml-3">Beranda</span>
                    </a>
                </li>
            @else
                <li class="{{ 'kepalaSekolah/dashboard' == request()->path() ? 'active' :  '' }} rounded-xl">
                    <a href="{{ route('kepala_sekolah') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F4F6F9]">
                        <img src="{{ url('images/home.svg') }}" alt="beranda">
                        <span class="ml-3">Beranda</span>
                    </a>
                </li>
            @endif
            <li class="{{ 'form-cuti-tahunan' == request()->path() ? 'active' :  '' }} rounded-xl">
                @if (Auth::user()->role == 'user')
                    <a href="{{ route('cuti-tahunan') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-[#F4F6F9]"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <img src="{{ url('images/calendar.svg') }}" alt="pengajuan cuti">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Pengajuan Cuti</span>
                    </a>
                @endif
            </li>
            @if (Auth::user()->role == 'user')
                <li class="{{ 'riwayat-pengajuan-cuti' == request()->path() ? 'active' :  '' }} rounded-xl">
                    <a href="{{ route('riwayat-cuti') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F4F6F9]">
                        <img src="{{ url('images/inbox.svg') }}" alt="">
                        <span class="flex-1 ml-3 whitespace-nowrap">Riwayat Cuti</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'kepala_sekolah')
                <li  class="{{ 'riwayat-cuti-guru' == request()->path() ? 'active' :  '' }} rounded-xl">
                    <a href="{{ route('riwayat-cuti-guru') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F4F6F9]">
                        <img src="{{ url('images/envelope.svg') }}" alt="">
                        <span class="flex-1 ml-3 whitespace-nowrap">Riwayat Cuti Guru</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-900 rounded-lg group hover:bg-[#F4F6F9] group"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <img src="{{ url('images/calendar.svg') }}" alt="pengajuan cuti">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Data Cuti</span>
                        <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li  class="{{ 'tambah-kategori' == request()->path() ? 'active' :  '' }} rounded-xl">
                            <a href="{{ route('tambah-kategori') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-[#F4F6F9]">
                                Data Kategori Cuti</a>
                        </li>
                        <li  class="{{ 'Tambah-subkategori' == request()->path() ? 'active' :  '' }} rounded-xl">
                            <a href="{{ route('tambah-subkategori') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-[#F4F6F9]">
                                Data Sub-kategori Cuti</a>
                        </li>
                    </ul>
                </li>
                @endif
                <li  class="{{ 'data-guru' == request()->path() ? 'active' :  '' }} rounded-xl">
                    <a href="{{ route('data-guru') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F4F6F9]">
                        <img src="{{ url('images/users-three.svg') }}" alt="">
                        <span class="flex-1 ml-3 whitespace-nowrap">Data Guru</span>
                    </a>
                </li>
            @endif
            <li  class="{{ 'pengaturan' == request()->path() ? 'active' :  '' }} rounded-xl">
                <a href="{{ route('pengaturan') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F4F6F9]">
                    <img src="{{ url('images/settings.svg') }}" alt="">
                    <span class="flex-1 ml-3 whitespace-nowrap">Pengaturan</span>
                </a>
            </li>
        </ul>
    </div>
    <form action="{{ route('logout') }}" method="GET">
        <button class="w-full px-3 py-2 text-white bg-red-600 rounded-lg hover:bg-red-800 text-medium">Keluar</button>
    </form>
</aside>
