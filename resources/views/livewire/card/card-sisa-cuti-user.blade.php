{{-- <div class="w-full h-auto flex flex-col justify-center items-center space-y-2 p-4 bg-gradient-to-tr from-[#8AC054] to-[#B4E080] rounded-xl font-poppins">
    <p class="text-xs font-semibold">Sisa Cuti</p>
    <h1 class="text-3xl font-bold">{{ $user->saldo_cuti }}</h1>
    <p class="text-xs font-semibold">Per Tahun</p>
</div> --}}
<div class="w-full h-auto relative overflow-hidden bg-gradient-to-tr from-[#B4E080] to-[#8AC054] rounded-2xl shadow-md border border-[#8AC054]">
    <svg class="absolute bottom-0 left-0 mb-0" viewBox="0 0 375 283" fill="none"
        style="transform: scale(1.5); opacity: 0.2;">
        <rect x="180" y="230" width="152" height="152" rx="10" transform="rotate(-45 159.52 175)"
            fill="white" />
        <rect x="38" y="163" width="152" height="152" rx="10" transform="rotate(-45 0 107.48)"
            fill="white" />
    </svg>
    <div class="flex flex-row space-x-4 sm:space-x-6 justify-center items-center space-y-1 sm:space-y-2 p-4 mt-2 sm:mt-1 w-full h-auto z-10 relative">
        <div class="py-1 px-1.5 sm:py-1.5 sm:px-3 bg-white/20 shadow-md border border-white/25 backdrop-blur-sm rounded-xl">
            <i class='bx bxs-credit-card-alt bx-md sm:bx-lg text-[#1e1e1e]'></i>
        </div>
        <div class="flex flex-col text-[#1e1e1e] space-y-1">
            <p class="text-xs sm:text-lg font-semibold">Sisa Cuti Anda</p>
            <h1 class="text-2xl sm:text-2xl md:text-4xl font-bold">{{ $user->saldo_cuti }}</h1>
        </div>
    </div>
</div>
