<?php

namespace App\Http\Livewire\Table;

use App\Models\Cuti;
use App\Models\User;
use App\Notifications\NotifikasiPengajuanCuti;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TabelRiwayatCutiPending extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $showModal = false;
    public $fotoTandaTangan;
    public $cutiId;
    public $perPage = 5;
    public $cutiGuruTotal;
    public $orderColumn = "user_id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bxs-up-arrow"></i>';
    public $searchTerm = "";

    public function updated()
    {
        $this->resetPage();
    }

    public function sortOrder($columnName = "")
    {
        $caretOrder = "up";
        if ($this->sortOrder == 'asc') {
            $this->sortOrder = 'desc';
            $caretOrder = "down";
        } else {
            $this->sortOrder = 'asc';
            $caretOrder = "up";
        }
        $this->sortLink = '<i class="sorticon bx bxs-' . $caretOrder . '-arrow"></i>';

        $this->orderColumn = $columnName;
    }

    public function render()
    {
        // menampilkan cuti berstatus konfirmasi
        $cutiKonfirmasi = Cuti::orderBy($this->orderColumn, $this->sortOrder)->select('*'); //memanggil data cuti sesuai input pencarian

        if (!empty($this->searchTerm)) {
            $cutiKonfirmasi->where(function ($query) {
                $query->whereHas('user', function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->searchTerm . '%');
                })
                    ->orWhereHas('kategori', function ($subQuery) {
                        $subQuery->where('nama', 'like', '%' . $this->searchTerm . '%');
                    })
                    ->orWhereHas('subkategori', function ($subQuery) {
                        $subQuery->where('nama_subkategoris', 'like', '%' . $this->searchTerm . '%');
                    })->orWhere('status', 'like', "%" . $this->searchTerm . "%");
            });
        }

        $cutiKonfirmasi->where('status', 'Konfirmasi');
        $cutiKonfirmasi = $cutiKonfirmasi->paginate($this->perPage);
        $this->cutiGuruTotal = $cutiKonfirmasi->total();

        // $cutiKonfirmasi = Cuti::where('status', 'Konfirmasi')->paginate($this->perPage);
        // $cutiPending = Cuti::where('status', 'Pending')->paginate($this->perPage);

        // menampilkan cuti berstatus Pending
        $cutiPending = Cuti::orderBy($this->orderColumn, $this->sortOrder)->select('*'); //memanggil data cuti sesuai input pencarian

        if (!empty($this->searchTerm)) {
            $cutiPending->where(function ($query) {
                $query->whereHas('user', function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->searchTerm . '%');
                })
                    ->orWhereHas('kategori', function ($subQuery) {
                        $subQuery->where('nama', 'like', '%' . $this->searchTerm . '%');
                    })
                    ->orWhereHas('subkategori', function ($subQuery) {
                        $subQuery->where('nama_subkategoris', 'like', '%' . $this->searchTerm . '%');
                    })->orWhere('status', 'like', "%" . $this->searchTerm . "%");
            });
        }

        $cutiPending->where('status', 'Pending');
        $cutiPending = $cutiPending->paginate($this->perPage);
        $this->cutiGuruTotal = $cutiPending->total();

        return view('livewire.table.tabel-riwayat-cuti-pending', compact('cutiPending', 'cutiKonfirmasi'));
    }

    public function prosesSetuju($cutiId)
    {
        $cuti = Cuti::findOrFail($cutiId);

        if ($cuti->status === 'Konfirmasi' && Auth::user()->role == 'kepala_sekolah') {
            $this->cutiId = $cutiId;
            $this->showModal = true;
        }
    }

    public function batal()
    {
        $this->showModal = false;
        $this->reset(['fotoTandaTangan', 'cutiId']);
    }

    // approval kepala sekolah
    public function approve()
    {
        $this->validate([
            'fotoTandaTangan' => 'required|image|mimes:png',
        ]);

        $cuti = Cuti::findOrFail($this->cutiId);

        // Kurangi saldo cuti guru jika status cuti disetujui oleh kepala sekolah
        if (auth()->user()->role == 'kepala_sekolah' && $cuti->status == 'Konfirmasi') {
            $guru = User::find($cuti->user_id);

            // Cuti melahirkan, tidak perlu mengurangi saldo cuti
            if ($cuti->subkategori->nama_subkategoris === 'Cuti Melahirkan') {

                // simpan foto ttd
                $fotoTandaTanganPath = $this->fotoTandaTangan->storeAs('public/foto_ttd_guru/', $this->fotoTandaTangan->getClientOriginalName());

                $cuti->file_ttd_kepsek = $this->fotoTandaTangan->getClientOriginalName();
                $cuti->status = 'Setuju';
                $cuti->save();

                // Kirim notifikasi ke guru
                $message = 'Pengajuan cuti Anda (cuti melahirkan) telah disetujui oleh kepala sekolah';
                $notification = new NotifikasiPengajuanCuti($message);
                $guru->notify($notification);

                session()->flash('message', 'Pengajuan cuti melahirkan berhasil disetujui.');
                return redirect()->route('riwayat-cuti-guru');
            } else {
                // Saldo cuti cukup, mengurangi saldo cuti guru
                if ($guru->saldo_cuti >= $cuti->durasi) {

                    // simpan foto ttd
                    $fotoTandaTanganPath = $this->fotoTandaTangan->storeAs('public/foto_ttd_guru/', $this->fotoTandaTangan->getClientOriginalName());

                    $cuti->file_ttd_kepsek = $this->fotoTandaTangan->getClientOriginalName();
                    $cuti->status = 'Setuju';
                    $cuti->save();


                    // Kirim notifikasi ke guru
                    $message = 'Pengajuan cuti Anda telah disetujui oleh kepala sekolah';
                    $notification = new NotifikasiPengajuanCuti($message);
                    $guru->notify($notification);

                    // Mengurangi saldo cuti guru
                    $sisaCuti = $guru->saldo_cuti - $cuti->durasi;
                    $guru->saldo_cuti = $sisaCuti;
                    $guru->save();

                    $this->showModal = false;

                    session()->flash('message', 'Pengajuan cuti berhasil disetujui.');
                    return redirect()->route('riwayat-cuti-guru');
                } else {
                    // Saldo cuti tidak mencukupi
                    $message = 'Maaf, pengajuan cuti Anda gagal karena saldo cuti tidak mencukupi';
                    $notification = new NotifikasiPengajuanCuti($message);
                    $guru->notify($notification);

                    session()->flash('message', 'Saldo cuti tidak mencukupi.');
                }
            }
        }

        return redirect()->route('riwayat-cuti-guru');
    }


    // confirmation admin
    public function confirm($id)
    {
        $cuti = Cuti::findOrFail($id);

        // Mengecek apakah pengguna saat ini adalah kepala sekolah yang berwenang untuk menyetujui pengajuan cuti
        if (!auth()->user()->role == 'admin') {
            session()->flash('error', 'Anda tidak memiliki izin untuk menyetujui pengajuan cuti.');
            return redirect()->route('leave.application');
        }

        // Kurangi saldo cuti guru jika status cuti disetujui oleh kepala sekolah
        if (auth()->user()->role == 'admin' && $cuti->status == 'Pending') {
            $cuti->status = 'Konfirmasi';
            $cuti->save();

            // Kirim notifikasi ke guru
            $guru = $cuti->user;
            $message = 'Pengajuan cuti anda telah dikonfirmasi oleh admin';
            $notification = new NotifikasiPengajuanCuti($message);
            Notification::send($guru, $notification);

            // Kirim notifikasi ke kepala sekolah
            $kepsek = User::where('role', 'kepala_sekolah')->first();
            $message = 'Pengajuan cuti ' . $guru->name . ' telah dikonfirmasi oleh admin, menunggu persetujuan kepala sekolah';
            $notification = new NotifikasiPengajuanCuti($message);
            Notification::send($kepsek, $notification);

            session()->flash('message', 'Pengajuan cuti guru berhasil dikonfirmasi.');
            return redirect()->route('riwayat-cuti-guru');
        }
    }

    public function reject($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = 'Tolak';
        $cuti->save();

        session()->flash('success', 'Pengajuan cuti guru berhasil ditolak.');
        return redirect()->route('riwayat-cuti-guru');
    }
}
