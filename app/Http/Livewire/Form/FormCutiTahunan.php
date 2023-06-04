<?php

namespace App\Http\Livewire\Form;

use App\Models\Cuti;
use App\Models\Guru;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\User;
use App\Notifications\NotifikasiPengajuanCuti;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class FormCutiTahunan extends Component
{
    public $dataUser, $kategori_id, $subkategori_id, $tanggal_mulais, $tanggal_akhirs, $alasanCuti, $status, $signature;
    public $subkategoriList = [];

    use WithPagination;

    public function render()
    {
        $dataGurus = Guru::all();
        $dataUsers = User::all();
        $kategoris = Kategori::all();
        return view('livewire.form.form-cuti-tahunan', compact('dataGurus', 'dataUsers', 'kategoris'));
    }
    // public function mount()
    // {
    //     // Mengambil data guru dan kategori
    //     $this->dataGuru = Guru::all();
    //     $this->kategori = Kategori::all();
    // }

    protected function rules()
    {
        return [
            'dataUser' => 'required',
            'kategori_id' => 'required',
            'subkategori_id' => 'required',
            'tanggal_mulais' => 'required|date',
            'tanggal_akhirs' => 'required|date|after_or_equal:tanggal_mulais',
            'alasanCuti' => 'required',
        ];
    }

    public function submitForm()
    {
        // Validasi input
        $this->validate([
            'dataUser' => 'required',
            'kategori_id' => 'required',
            'subkategori_id' => 'nullable',
            'alasanCuti' => 'required',
            // 'durasi_cuti' => 'required',
            'tanggal_mulais' => 'required|date',
            'tanggal_akhirs' => 'required|date|after_or_equal:tanggal_mulais',
        ], [
            'dataUser.required' => 'Isi nama Guru dengan benar!',
            'kategori_id.required' => 'Isi kategori dengan benar!',
            'subkategori_id.required' => 'Isi sub-kategori dengan benar!',
            'alasanCuti.required' => 'Isi alasan dengan benar!',
            'tanggal_mulais.required' => 'Isi tanggal mulai dengan benar!',
            'tanggal_akhirs.required' => 'Isi tanggal akhir dengan benar!',
        ]);

        // Simpan data cuti ke database
        // $cuti = new Cuti();
        $start = Carbon::parse($this->tanggal_mulais);
        $end = Carbon::parse($this->tanggal_akhirs);
        $durasiCuti = $end->diffInDays($start) + 1;

        $pengajuanCuti = Cuti::create([
            "user_id" => $this->dataUser,
            "kategori_id" => $this->kategori_id,
            "subkategori_id" => $this->subkategori_id,
            "tanggal_mulai" => $this->tanggal_mulais,
            "tanggal_akhir" => $this->tanggal_akhirs,
            "alasan" => $this->alasanCuti,
            "durasi" => $durasiCuti,
        ]);

        // Kirim notifikasi ke admin
        $admin = User::where('role', 'admin')->first();
        $admin->notify(new NotifikasiPengajuanCuti('Terdapat pengajuan cuti baru dari Guru'));
        
        // Tampilkan notifikasi sukses
        session()->flash('message', 'Pengajuan cuti berhasil disimpan dan sedang dalam proses.');
        // Reset input form
        $this->reset();
        return redirect()->route('cuti-tahunan');
    }

    private function resetInputFields()
    {
        $this->dataUser = '';
        $this->alasanCuti = '';
        $this->kategori_id = '';
        $this->subkategori_id = '';
        // $this->tanggal_mulais = '';
        // $this->tanggal_akhirs = '';
    }

    public function ignoreTanggal()
    {
        $this->resetValidation('tanggal_mulais');
        $this->resetValidation('tanggal_akhirs');
    }

    public function updatedKategoriId($value)
    {
        $this->subkategoriList = Subkategori::where('kategori_id', $value)->get()->toArray();
    }

    public function cancelSignature()
    {
        $this->reset('signature');
        $this->emit('clearSignature');
    }
}
