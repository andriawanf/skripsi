<header class="hidden sm:block sm:mb-7">
    <div class="flex flex-row items-start justify-between space-x-20">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 capitalize font-poppins">Hallo, {{ Auth::user()->name }} 👋
            </h1>
            <p class="mt-1 text-sm font-medium text-gray-900 font-poppins">Selamat datang di <span
                    class="text-[#8AC054]">CIGU</span> - webiste pengajuan cuti guru Mts At-Tarbiyah Gunungsari
            </p>
        </div>
        <div class="relative flex-row items-center justify-center hidden p-2 mt-2 space-x-2 sm:flex">
            {{-- <i class='text-gray-900 bx bxs-bell bx-sm'></i> --}}
            <button type="button"
                class="relative inline-flex items-center p-2 mr-2 text-sm font-medium text-center text-white bg-white border border-gray-300 rounded-lg shadow-sm"
                data-popover-target="data-notif">
                <i class='text-xl text-gray-900 bx bxs-bell'></i>
                <span class="sr-only">Notifications</span>
                <div
                    class="absolute inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-600 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">
                    @if ($unreadNotificationsCount > 0)
                        <span class="badge animate-pulse">{{ $unreadNotificationsCount }}</span>
                    @else
                        <span class="badge">0</span>
                    @endif
                </div>
            </button>
            <div data-popover id="data-notif" role="tooltip"
                class="absolute z-50 invisible text-sm font-medium text-gray-900 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 w-96 font-poppins dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
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
                            <li class="w-full pb-2 text-center border-b border-gray-300 notification">Tidak ada
                                notifikasi baru untuk anda</li>
                        @endforelse

                    </ul>
                </div>
                <div data-popper-arrow></div>
            </div>
            @if (auth()->user()->foto == 'images/logo.png')
                <img src="{{ url('/' . auth()->user()->foto) }}" alt="foto profile"
                    class="object-cover w-10 h-10 rounded-lg" data-popover-target="user-profile">
            @else
                <img src="{{ asset('storage/foto-profil/' . auth()->user()->foto) }}" alt="foto profile"
                    class="object-cover w-10 h-10 rounded-lg" data-popover-target="user-profile">
            @endif
            <div data-popover id="user-profile" role="tooltip"
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
</header>
