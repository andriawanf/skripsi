<header class="hidden sm:block sm:mb-7">
    <div class="flex flex-row justify-between items-start space-x-20">
        <div>
            <h1 class="font-poppins font-semibold text-2xl text-gray-900 capitalize">Hallo, {{ Auth::user()->name }} 👋</h1>
            <p class="font-poppins font-medium text-sm text-gray-900 mt-1">Selamat datang di <span
                    class="text-[#8AC054]">CIGU</span> - webiste pengajuan cuti guru Mts At-Tarbiyah Gunungsari
            </p>
        </div>
        <div class="flex-row justify-center items-center space-x-2 p-2 mt-2 hidden sm:flex relative">
            {{-- <i class='bx bxs-bell bx-sm text-gray-900'></i> --}}
            <button type="button"
                class="relative inline-flex items-center text-sm font-medium text-center text-white mr-2 p-2 bg-white shadow-sm border border-gray-300 rounded-lg"
                data-popover-target="data-notif">
                <i class='bx bxs-bell text-xl text-gray-900'></i>
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
            <div data-popover id="data-notif" role="tooltip"
                class="absolute z-50 invisible w-96 font-poppins font-medium text-sm text-gray-900 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                <div class="p-3">
                    <ul class="space-y-4">
                        @forelse ($notifications as $notification)
                        <div class="flex flex-row space-x-2 justify-between items-baseline">
                            <li class="notification border-b border-gray-300 pb-2 w-full">{{ $notification->data['message'] }}</li>
                            <button wire:click="markAsRead('{{ $notification->id }}')"
                                class="px-3 py-2 w-fit bg-red-600 hover:bg-red-800 rounded-lg text-medium text-white">Baca</button>
                        </div>
                        @empty
                            <li class="notification border-b border-gray-300 pb-2 w-full text-center">Tidak ada notifikasi baru untuk anda</li>
                        @endforelse

                    </ul>
                </div>
                <div data-popper-arrow></div>
            </div>
            @if (auth()->user()->foto == 'images/logo.png')
                <img src="{{ url('/' . auth()->user()->foto) }}" alt="foto profile"
                    class="w-10 h-10 rounded-full object-cover" data-popover-target="user-profile">
            @else
                <img src="{{ asset('storage/foto-profil/' . auth()->user()->foto) }}" alt="foto profile"
                    class="w-10 h-10 rounded-full object-cover" data-popover-target="user-profile">
            @endif
            <div data-popover id="user-profile" role="tooltip"
                class="absolute z-10 invisible inline-block w-44 font-poppins font-medium text-sm text-gray-900 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
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
                                    class="px-3 py-2 w-full bg-red-600 hover:bg-red-800 rounded-lg text-medium text-white">Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div data-popper-arrow></div>
            </div>
        </div>
    </div>
</header>
