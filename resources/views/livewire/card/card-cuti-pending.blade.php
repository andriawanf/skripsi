<div class="w-full h-fit relative overflow-hidden bg-gradient-to-tr from-[#B4E080] to-[#8AC054] rounded-2xl shadow-md border border-[#8AC054]">
    <svg class="absolute bottom-0 left-0 mb-0" viewBox="0 0 375 283" fill="none"
        style="transform: scale(1.5); opacity: 0.2;">
        <rect x="180" y="230" width="152" height="152" rx="10" transform="rotate(-45 159.52 175)"
            fill="white" />
        <rect x="38" y="163" width="152" height="152" rx="10" transform="rotate(-45 0 107.48)"
            fill="white" />
    </svg>
    <div class="flex flex-row space-x-4 sm:space-x-6 justify-center items-center space-y-1 sm:space-y-2 p-4 mt-2 sm:mt-1 w-full h-auto z-10 relative">
        <div class="py-1 px-1.5 sm:py-1.5 sm:px-3 bg-white/20 shadow-md border border-white/25 backdrop-blur-sm rounded-xl">
            <i class='bx bxs-time bx-md sm:bx-lg text-[#1e1e1e] mt-0.5'></i>
        </div>
        <div class="w-full flex flex-col text-[#1e1e1e] space-y-1">
            <p class="text-xs sm:text-lg font-semibold">Cuti Pending</p>
            <h1 class="text-2xl sm:text-2xl md:text-4xl font-bold">{{ $cutiPending->count() }}</h1>
        </div>
    </div>
</div>
