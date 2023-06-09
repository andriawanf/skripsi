<form class="font-poppins">
    <div class="mb-6">
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="foto">Foto
                Profil</label>
            <div class="flex flex-col sm:flex-row gap-3 items-center justify-center w-full">
                @if ($foto)
                    <img src="{{ $foto->temporaryUrl() }}" alt="foto profil" class="w-28 h-28 rounded-xl object-cover shadow-lg">
                @else
                    <img src="{{ asset('storage/foto-profil/' . auth()->user()->foto) }}" alt="foto profil" class="w-28 h-28 rounded-xl object-cover shadow-lg">
                @endif
                <input wire:model='foto'
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="foto" type="file">
            </div>
        </div>
        <div class="mb-6">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                Pengguna</label>
            <input type="text" id="text" wire:model='nama'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize">
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
            <input type="email" id="email" wire:model='emailUser'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-6">
            <label for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">password<span class="text-red-600">*</span> </label>
            <input type="password" id="password" wire:model='passUser'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="********" required>
        </div>
        <button type="button" wire:click.prevent='updateProfile'
            class="bg-gradient-to-r from-[#B4E080] to-[#8AC054] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-xl text-sm text-white hover:text-gray-900 px-5 py-2.5 text-center w-full mt-6">Simpan</button>
    </div>
</form>
