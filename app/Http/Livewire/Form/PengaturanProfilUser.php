<?php

namespace App\Http\Livewire\Form;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class PengaturanProfilUser extends Component
{
    public $user, $foto, $emailUser, $passUser, $nama;
    use WithFileUploads;

    public function mount()
    {
        $this->user = User::all();
        $this->nama = Auth::user()->name;
        $this->emailUser = Auth::user()->email;
    }

    public function render()
    {
        return view('livewire.form.pengaturan-profil-user');
    }

    public function updateProfile()
    {
        $this->validate([
            'foto' => 'image',
            'nama' => 'required',
            'emailUser' => 'required|email',
            'passUser' => 'required'
        ]);

        // Simpan foto ke dalam folder "foto-profil" dengan nama asli
        $foto = $this->foto->storeAs('public/foto-profil/', $this->foto->getClientOriginalName());
        
        // Simpan path foto profil ke tabel user
        User::find(Auth::user()->id)->update([
            'foto' => $this->foto->getClientOriginalName(),
            'name' => $this->nama,
            'email' => $this->emailUser,
            'password' => bcrypt($this->passUser)
        ]);

        session()->flash('message', 'Foto profil berhasil disimpan.');
        return redirect()->route('pengaturan');
    }
}
