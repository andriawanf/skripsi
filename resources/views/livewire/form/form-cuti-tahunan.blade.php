<form enctype="multipart/form-data">
    @csrf
    <div class="mb-6">
        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Guru</label>
        <select id="dataUser" wire:model='dataUser'
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Pilih Guru</option>
            @foreach ($dataUsers as $guru)
                <option value="{{ $guru->id }}">{{ $guru->name }}</option>
            @endforeach
        </select>
        @error('dataGuru')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, tidak!</span>
                {{ $message }}</p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
            Cuti</label>
        <select id="dataGuru" wire:model='kategori_id'
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Pilih Kategori Cuti</option>
            @foreach ($kategoris as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
        @error('kategori_id')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, tidak!</span>
                {{ $message }}</p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub-Kategori
            Cuti</label>
        <select id="subkategori" wire:model='subkategori_id'
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-900 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Pilih Subkategori Cuti</option>
            @foreach ($subkategoriList as $item)
                <option value="{{ $item['id'] }}">{{ $item['nama_subkategoris'] }}</option>
            @endforeach
        </select>
        @error('subkategori_id')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, tidak!</span>
                {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
            Cuti</label>
        <div class="flex items-center">
            <div class="relative w-full">
                <input id="tanggal_mulais" type="date" wire:model='tanggal_mulais' wire:ignore
                    class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="pilih tanggal mulai">
            </div>
            <span class="mx-3 text-sm font-medium text-gray-900">sampai</span>
            <div class="relative w-full">
                <input id="tanggal_akhirs" type="date" wire:model='tanggal_akhirs' wire:ignore
                    class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Pilih tanggal akhir">
            </div>
        </div>
        @error('tanggal_mulais')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, tidak!</span>
                {{ $message }}</p>
        @enderror
        @error('tanggal_akhirs')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, tidak!</span>
                {{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-6">
        <label for="fileBuktiCuti" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload File Bukti</label>
        <input wire:model='fileBuktiCuti' id="fileBuktiCuti" name="fileBuktiCuti"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        id="foto" type="file">
        @error('fileBuktiCuti')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, tidak!</span>
                {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Tanda Tangan</label>
        <input wire:model='file_tanda_tangan'
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        id="foto" type="file">
        @error('file_tanda_tangan')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, tidak!</span>
                {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alasan</label>
        <textarea id="alasanCuti" rows="4" wire:model='alasanCuti' name="alasanCuti"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Tuliskan alasan anda disini..."></textarea>
        @error('alasanCuti')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, tidak!</span>
                {{ $message }}</p>
        @enderror
    </div>
    {{-- <div class="w-1/2 mb-6 flex gap-4 items-center">
        <div>
            <canvas id="signaturePad" class="w-full bg-white border border-gray-300 rounded-xl"></canvas>
            <input type="hidden" id="signatureInput" wire:model="signature">
        </div>
        <button id="cancelSignature" class="px-3 py-1.5 text-center text-sm text-white font-poppins font-medium bg-red-600 h-12 rounded-lg">Hapus</button>
    </div> --}}
    <button type="submit" wire:click.prevent='submitForm'
        class="bg-gradient-to-r from-[#B4E080] to-[#8AC054] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-xl text-sm text-white hover:text-gray-900 px-5 py-2.5 text-center w-full">Ajukan
        Cuti</button>
</form>
<script src="https://unpkg.com/signature_pad"></script>
<script>
    var canvas = document.getElementById('signaturePad');
    var signaturePad = new SignaturePad(canvas);

    document.getElementById('signatureInput').value = signaturePad.toDataURL();

    document.getElementById('cancelSignature').addEventListener('click', function(event) {
        event.preventDefault();
        signaturePad.clear();
        document.getElementById('signatureInput').value = '';
    })
    // Livewire.on('clearSignature', function() {
    //     signaturePad.clear();
    //     document.getElementById('signatureInput').value = '';
    // });
</script>
