<?php

namespace App\Http\Livewire\Table;

use App\Models\Cuti;
use App\Models\User;
use App\Notifications\NotifikasiPengajuanCuti;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class TabelRiwayatCutiPending extends Component
{
    use WithPagination;
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
                })->orWhere('status','like',"%".$this->searchTerm."%");
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
                })->orWhere('status','like',"%".$this->searchTerm."%");
            });
        }

        $cutiPending->where('status', 'Pending');
        $cutiPending = $cutiPending->paginate($this->perPage);
        $this->cutiGuruTotal = $cutiPending->total();

        return view('livewire.table.tabel-riwayat-cuti-pending', compact('cutiPending', 'cutiKonfirmasi'));
    }

    public function approve($id)
    {
        $cuti = Cuti::findOrFail($id);

        // Mengecek apakah pengguna saat ini adalah kepala sekolah yang berwenang untuk menyetujui pengajuan cuti
        if (!auth()->user()->role == 'kepala sekolah') {
            session()->flash('error', 'Anda tidak memiliki izin untuk menyetujui pengajuan cuti.');
            return redirect()->route('leave.application');
        }

        // Mengecek apakah pengajuan cuti sudah dikonfirmasi oleh admin sebelumnya
        if ($cuti->status !== 'Konfirmasi') {
            session()->flash('error', 'Pengajuan cuti belum dikonfirmasi oleh admin.');
            return redirect()->route('leave.application');
        }

        // Kurangi saldo cuti guru jika status cuti disetujui oleh kepala sekolah
        if (auth()->user()->role == 'kepala_sekolah' && $cuti->status == 'Konfirmasi') {
            $cuti = Cuti::findOrFail($id);
            $guru = User::find($cuti->user_id);
            if ($guru->saldo_cuti >= $cuti->durasi) {
                // mengurangi saldo cuti guru
                $sisaCuti = $guru->saldo_cuti -= $cuti->durasi;
                $guru->saldo_cuti = $sisaCuti;
                $cuti->status = 'Setuju';
                $guru->save();
                $cuti->save();

                // Kirim notifikasi ke guru
                $guru = $cuti->user;
                $message = 'Pengajuan cuti anda telah disetujui oleh kepala sekolah';
                $notification = new NotifikasiPengajuanCuti($message);
                Notification::send($guru, $notification);
                
                session()->flash('message', 'Pengajuan cuti guru berhasil disetujui.');
                return redirect()->route('riwayat-cuti-guru');

            } else {
                // Kirim notifikasi ke guru
                $guru = $cuti->user;
                $message = 'Maaf pengajuan cuti anda gagal karena saldo cuti tidak mencukupi';
                $notification = new NotifikasiPengajuanCuti($message);
                Notification::send($guru, $notification);
                
                session()->flash('error', 'Saldo cuti guru tidak mencukupi.');
                return redirect()->route('riwayat-cuti-guru');
            }
        }
    }

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
            $message = 'Pengajuan cuti ' .$guru->name. ' telah dikonfirmasi oleh admin, menunggu persetujuan kepala sekolah';
            $notification = new NotifikasiPengajuanCuti($message);
            Notification::send($kepsek, $notification);

            // Kirim notifikasi ke kepala sekolah
            // $kepalaSekolah = User::where('role', 'kepala_sekolah')->first();
            // $message = 'Pengajuan cuti telah dikonfirmasi admin, menunggu persetujuan kepala sekolah';
            // $notification = new NotifikasiPengajuanCuti($message);
            // $kepalaSekolah->notify($notification);

            // $userGuru = User::where('role', 'user')->first();
            // $userGuru->notify(new NotifikasiPengajuanCuti('Pengajuan cuti anda telah dikonfirmasi admin, menunggu persetujuan kepala sekolah'));

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
    }
}
