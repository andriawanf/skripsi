<?php

namespace App\Http\Livewire\Table;

use App\Models\Cuti;
use App\Models\Guru as ModelsDataGuru;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DataGuru extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $nama, $jabatan, $pangkat, $satuan_organisasi, $nip, $saldo_cuti, $foto, $guru_id, $userAccount;
    public $pagination = 10;

    public function render()
    {
        if (Auth::user()->role == 'admin') {
            $users = User::where('role', 'user')->paginate($this->pagination);
        } elseif(Auth::user()->role == 'kepala_sekolah') {
            $users = User::where('role', 'admin')
            ->orWhere('role', 'user')
            ->paginate($this->pagination);
        }
        
        return view('livewire.table.data-guru', compact('users'));
    }

    protected function rules()
    {
        return [
            'nama' => 'required',
            'nip' => 'required|min:12',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'satuan_organisasi' => 'required',
            'saldo_cuti' => 'required|max:12',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }

    private function resetInputFields()
    {
        $this->nama = '';
        $this->nip = '';
        $this->jabatan = '';
        $this->pangkat = '';
        $this->satuan_organisasi = '';
        $this->saldo_cuti = '';
        $this->foto = '';
    }
    public function closeModal()
    {
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $gurus = User::findOrFail($id);
        $this->guru_id = $gurus->id;
        $this->nama = $gurus->name;
        $this->nip = $gurus->nip;
        $this->jabatan = $gurus->jabatan;
        $this->pangkat = $gurus->pangkat;
        $this->satuan_organisasi = $gurus->satuan_organisasi;
        $this->saldo_cuti = $gurus->saldo_cuti;
        $this->foto = $gurus->foto;
        
    }

    public function update()
    {
        // validasi form
        // $this = $this->validate();
        $this->validate([
            'nama' => 'required',
            'nip' => 'required|min:12',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'satuan_organisasi' => 'required',
            'saldo_cuti' => 'required|max:12',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $guru = User::findOrFail($this->guru_id);
        $guru->update([
            'nama' => $this->nama,
            'nip' => $this->nip,
            'jabatan' => $this->jabatan,
            'pangkat' => $this->pangkat,
            'satuan_organisasi' => $this->satuan_organisasi,
            'saldo_cuti' => $this->saldo_cuti,
        ]);

        session()->flash('message','Data Guru Berhasil Diperbaharui!');
        $this->resetInputFields();
        return redirect()->route('data-guru');
    }

    public function confirmDelete($userId)
    {
        $this->userAccount = $userId;
    }

    public function delete()
    {
        $userid = User::find($this->userAccount);
        
        // Hapus data cuti terkait dengan guru
        Cuti::where('user_id', $userid->id)->delete();
        $userid->delete();
        session()->flash('message', 'Data berhasil dihapus.');
        return redirect()->route('data-guru');
    }
}
