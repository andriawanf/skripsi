<div
    class="w-3/4 h-full lg:flex flex-col justify-center items-center space-y-2 py-6 bg-gradient-to-tr from-[#B4E080] to-[#8AC054] rounded-3xl shadow-md hidden border border-[#8AC054]/50 relative overflow-hidden">
    @if (auth()->user()->foto == 'images/logo.png')
        <img src="{{ url('/' . auth()->user()->foto) }}" alt="foto profile"
            class="w-24 h-24 rounded-full object-cover border-2 border-[#1e1e1e] z-10">
    @else
        <img src="{{ asset('storage/foto-profil/' . auth()->user()->foto) }}" alt="foto profile"
            class="w-24 h-24 rounded-full object-cover border-2 border-[#1e1e1e] z-10">
    @endif
    <h1 class="font-medium text-xl capitalize z-10">{{ auth()->user()->name }}</h1>
    <p class="font-normal text-sm z-10">{{ auth()->user()->jabatan }}</p>
    <a href="{{ route('pengaturan') }}"
        class="px-4 py-2 flex gap-2 font-medium text-white text-base font-poppins bg-gradient-to-tr from-[#73B1F4] to-[#4B89DA] rounded-lg hover:bg-gradient-to-br z-10">
        <img src="{{ url('images/sliders-h.svg') }}" alt="">
        <p>Atur Profil</p>
    </a>
    <svg class="absolute bottom-0 left-0 mb-0 z-0" viewBox="0 0 375 283" fill="none"
        style="transform: scale(1.5); opacity: 0.2;">
        <rect x="180" y="230" width="152" height="152" rx="10" transform="rotate(-45 159.52 175)"
            fill="white" />
        <rect x="38" y="163" width="152" height="152" rx="10" transform="rotate(-45 0 107.48)"
            fill="white" />
    </svg>
</div>
