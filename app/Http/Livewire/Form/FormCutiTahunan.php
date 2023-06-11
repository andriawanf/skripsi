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
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class FormCutiTahunan extends Component
{
    public $dataUser, $kategori_id, $subkategori_id, $tanggal_mulais, $tanggal_akhirs, $alasanCuti, $status, $signature, $file_tanda_tangan;
    public $fileBuktiCuti;
    public $subkategoriList = [];

    use WithPagination;
    use WithFileUploads;

    public function render()
    {
        $dataUsers = User::where('role', 'user')->get();
        $kategoris = Kategori::all();
        return view('livewire.form.form-cuti-tahunan', compact('dataUsers', 'kategoris'));
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
            'file_bukti_cuti' => 'required|file|mimes:pdf',
            'file_tanda_tangan' => 'required|image|mimes:png',
        ];
    }

    public function submitForm()
    {
        // Cek apakah ada pengajuan cuti yang masih pending
        $pendingCuti = Cuti::where('user_id', $this->dataUser)
            ->where('status', 'Pending')
            ->orWhere('status', 'Konfirmasi')
            ->count();

        if ($pendingCuti > 0) {
            session()->flash('error', 'Anda masih memiliki pengajuan cuti yang masih menunggu persetujuan.');
            return redirect()->route('cuti-tahunan');
        }

        // Validasi input
        $this->validate([
            'dataUser' => 'required',
            'kategori_id' => 'required',
            'subkategori_id' => 'nullable',
            'alasanCuti' => 'required',
            'tanggal_mulais' => 'required|date',
            'tanggal_akhirs' => 'required|date|after_or_equal:tanggal_mulais',
            'file_tanda_tangan' => 'required|image|mimes:png',
            'fileBuktiCuti' => 'required|file|mimes:pdf',
        ], [
            'dataUser.required' => 'Isi nama Guru dengan benar!',
            'kategori_id.required' => 'Isi kategori dengan benar!',
            'subkategori_id.required' => 'Isi sub-kategori dengan benar!',
            'alasanCuti.required' => 'Isi alasan dengan benar!',
            'tanggal_mulais.required' => 'Isi tanggal mulai dengan benar!',
            'tanggal_akhirs.required' => 'Isi tanggal akhir dengan benar!',
            'fileBuktiCuti.required' => 'Pilih file bukti cuti!',
            'fileBuktiCuti.file' => 'File bukti cuti harus dalam format yang valid!',
            'fileBuktiCuti.mimes' => 'File bukti cuti harus dalam format PDF, PNG, JPG, JPEG, DOC, atau DOCX!',
            'file_tanda_tangan.required' => 'Pilih file tanda tangan anda!',
            'file_tanda_tangan.file' => 'File bukti cuti harus dalam format yang valid!',
            'file_tanda_tangan.mimes' => 'File bukti cuti harus dalam format PNG!',
        ]);

        // Cek apakah tanggal cuti sudah diambil sebelumnya
        $existingCuti = Cuti::where('user_id', $this->dataUser)
            ->where(function ($query) {
                $query->whereBetween('tanggal_mulai', [$this->tanggal_mulais, $this->tanggal_akhirs])
                    ->orWhereBetween('tanggal_akhir', [$this->tanggal_mulais, $this->tanggal_akhirs])
                    ->orWhere(function ($query) {
                        $query->where('tanggal_mulai', '<=', $this->tanggal_mulais)
                            ->where('tanggal_akhir', '>=', $this->tanggal_akhirs);
                    });
            })
            ->count();

        if ($existingCuti > 0) {
            session()->flash('error', 'Anda sudah pernah mengambil cuti pada tanggal tersebut.');
            return redirect()->route('cuti-tahunan');
        }

        // Simpan data cuti ke database
        // $cuti = new Cuti();
        $start = Carbon::parse($this->tanggal_mulais);
        $end = Carbon::parse($this->tanggal_akhirs);
        $durasiCuti = $end->diffInDays($start) + 1;

        // simpan foto ttd
        $file_tanda_tangan = $this->file_tanda_tangan->storeAs('public/foto_ttd_guru/', $this->file_tanda_tangan->getClientOriginalName());

        $file_bukti_cuti_path = $this->fileBuktiCuti->storeAs('public/file_bukti/', $this->fileBuktiCuti->getClientOriginalName());

        $pengajuanCuti = Cuti::create([
            "user_id" => $this->dataUser,
            "kategori_id" => $this->kategori_id,
            "subkategori_id" => $this->subkategori_id,
            "tanggal_mulai" => $this->tanggal_mulais,
            "tanggal_akhir" => $this->tanggal_akhirs,
            "alasan" => $this->alasanCuti,
            "durasi" => $durasiCuti,
            "file_bukti" => $this->fileBuktiCuti->getClientOriginalName(),
            "file_ttd" => $this->file_tanda_tangan->getClientOriginalName(),
        ]);

        // Kirim notifikasi ke admin
        $guru = Auth::user()->name;
        $admin = User::where('role', 'admin')->first();
        $admin->notify(new NotifikasiPengajuanCuti('Terdapat pengajuan cuti baru dari ' . $guru));

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
