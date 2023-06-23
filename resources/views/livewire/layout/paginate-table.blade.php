<div class="flex items-center justify-between">
    <div class="flex-1">
        <div class="flex justify-start">
            <!-- Tombol Sebelumnya -->
            @if ($items->onFirstPage())
                <span class="px-2 py-1 text-gray-500 bg-gray-200 rounded-md cursor-not-allowed">
                    Sebelumnya
                </span>
            @else
                <button wire:click="previousPage" class="px-2 py-1 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                    Sebelumnya
                </button>
            @endif
        </div>
    </div>

    <div class="flex-1">
        <div class="flex justify-center">
            <!-- Nomor Halaman -->
            @if ($items->lastPage() > 1)
                @for ($i = 1; $i <= $items->lastPage(); $i++)
                    @if ($i == $items->currentPage())
                        <span class="px-2 py-1 text-white bg-blue-500 rounded-md">{{ $i }}</span>
                    @else
                        <button wire:click="gotoPage({{ $i }})" class="px-2 py-1 text-gray-500 bg-gray-200 rounded-md hover:bg-gray-300">{{ $i }}</button>
                    @endif
                @endfor
            @endif
        </div>
    </div>

    <div class="flex-1">
        <div class="flex justify-end">
            <!-- Tombol Selanjutnya -->
            @if ($items->hasMorePages())
                <button wire:click="nextPage" class="px-2 py-1 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                    Selanjutnya
                </button>
            @else
                <span class="px-2 py-1 text-gray-500 bg-gray-200 rounded-md cursor-not-allowed">
                    Selanjutnya
                </span>
            @endif
        </div>
    </div>
</div>
