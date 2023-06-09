<div
    class="w-3/4 h-auto lg:flex flex-col justify-center items-center space-y-2 p-4 bg-white rounded-xl shadow-sm hidden border border-gray-300">
    @if (auth()->user()->foto == 'images/logo.png')
        <img src="{{ url('/' . auth()->user()->foto) }}" alt="foto profile"
            class="w-24 h-24 rounded-full object-cover border-2 border-[#1e1e1e]">
    @else
        <img src="{{ asset('storage/foto-profil/' . auth()->user()->foto) }}" alt="foto profile"
            class="w-24 h-24 rounded-full object-cover border-2 border-[#1e1e1e]" >
    @endif
    <h1 class="font-medium text-xl capitalize">{{auth()->user()->name}}</h1>
    <p class="font-normal text-sm">{{auth()->user()->jabatan}}</p>
    <a href="{{route('pengaturan')}}"
        class="px-4 py-2 flex gap-2 font-medium text-white text-base font-poppins bg-gradient-to-tr from-[#73B1F4] to-[#4B89DA] rounded-lg hover:bg-gradient-to-br">
        <img src="{{ url('images/sliders-h.svg') }}" alt="">
        <p>Atur Profil</p>
    </a>
</div>
