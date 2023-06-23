<?php

namespace App\Http\Livewire\Table;

use App\Models\Cuti;
use App\Models\Guru;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\User;
use App\Notifications\NotifikasiPengajuanCuti;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use PhpOffice\PhpWord\TemplateProcessor;

class TableRiwayatPengajuanCutiUser extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $dataUser, $kategori_id, $subkategori_id, $tanggal_mulais, $tanggal_akhirs, $alasanCuti, $status, $cutiId, $file_tanda_tangan, $fileBuktiCuti, $kategoriCuti, $kategori_dipilih, $subKategoriCuti, $subkategori_dipilih, $cuti;
    public $showModal = false;
    public $showModalHapus = false;
    public $subkategoriList = [];
    public $perPage = 10;
    public $totalDays;

    public $cutiGuruTotal;
    public $orderColumn = "user_id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bxs-up-arrow"></i>';
    public $searchTerm = "";
    public $nomor = 1;

    public function updated()
    {
        $this->resetPage();
    }

    public function updatedPage()
    {
        $this->nomor = ($this->page - 1) * $this->perPage + 1;
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
        $guruId = Auth::id();

        $cutiGuru = Cuti::where('user_id', $guruId)->orderBy($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->searchTerm)) {
            $cutiGuru->where(function ($query) {
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

        $cutiGuru = $cutiGuru->paginate($this->perPage);
        $this->cutiGuruTotal = $cutiGuru->total();

        return view('livewire.table.table-riwayat-pengajuan-cuti-user', compact('cutiGuru'));
    }

    public function getCuti()
    {
        return Cuti::paginate($this->pagination);
    }

    public function editCuti($cutiId)
{
    $this->cuti = Cuti::findOrFail($cutiId);
    $this->kategoriCuti = Kategori::all();
    $this->subKategoriCuti = Subkategori::all();
    // Menentukan kategori yang terpilih
    $this->kategori_dipilih = $this->cuti->kategori->nama;
    if($this->subkategori_dipilih != null){
        $this->subkategori_dipilih = $this->cuti->subkategori->nama_subkategoris;
    }
    
    // Mengisi data pengajuan cuti ke dalam properti
    $this->cutiId = $this->cuti->id;
    $this->dataUser = $this->cuti->user->name;
    $this->kategori_id = $this->cuti->kategori_id;
    $this->subkategori_id = $this->cuti->subkategori_id;
    $this->alasanCuti = $this->cuti->alasan;
    $this->tanggal_mulais = $this->cuti->tanggal_mulai;
    $this->tanggal_akhirs = $this->cuti->tanggal_akhir;
    $this->file_tanda_tangan = $this->cuti->file_ttd;
    $this->fileBuktiCuti = $this->cuti->file_bukti;

    // Tampilkan modal edit
    $this->showModal = true;
}

    public function updateCuti()
    {
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
        
        // Simpan data cuti ke database
        $start = Carbon::parse($this->tanggal_mulais);
        $end = Carbon::parse($this->tanggal_akhirs);
        $durasiCuti = $end->diffInDays($start) + 1;

        // simpan foto ttd
        $file_tanda_tangan = $this->file_tanda_tangan->storeAs('public/foto_ttd_guru/', $this->file_tanda_tangan->getClientOriginalName());

        $file_bukti_cuti_path = $this->fileBuktiCuti->storeAs('public/file_bukti/', $this->fileBuktiCuti->getClientOriginalName());

        $updateCuti = Cuti::findOrFail($this->cutiId);
        $updateCuti->tanggal_mulai = $this->tanggal_mulais;
        $updateCuti->tanggal_akhir = $this->tanggal_akhirs;
        $updateCuti->durasi = $durasiCuti;
        $updateCuti->file_bukti = $this->fileBuktiCuti->getClientOriginalName();
        $updateCuti->file_ttd = $this->file_tanda_tangan->getClientOriginalName();
        $updateCuti->alasan = $this->alasanCuti;
        $updateCuti->save();

        // Kirim notifikasi ke admin
        $guru = Auth::user()->name;
        $admin = User::where('role', 'admin')->first();
        $admin->notify(new NotifikasiPengajuanCuti('Pengajuan cuti sebelumnya telah diedit oleh ' . $guru));

        // Tampilkan notifikasi sukses
        session()->flash('message', 'Cuti berhasil di update dan sedang dalam proses.');
        // Reset input form
        $this->reset();
        return redirect()->route('riwayat-cuti');
    }

    public function confirmDelete($id)
    {
        $this->cutiId = $id;
        $this->showModalHapus = true;
    }

    public function delete()
    {
        $cuti = Cuti::find($this->cutiId);
        $cuti->delete();

        session()->flash('message', 'Cuti berhasil dihapus!');
    }

    public function exportDocx($id)
    {
        $cuti = Cuti::find($id);
        $cutiGuru = auth()->user();
        $cutiGuru->user;
        $kategori = Kategori::find($cuti->kategori_id);
        $subkategori = Subkategori::find($cuti->subkategori_id);

        // Mendapatkan nama kategori dan subkategori
        $namaKategori = $kategori->nama;
        $namaSubkategori = null;

        if ($subkategori) {
            $namaSubkategori = $subkategori->nama_subkategoris;
        }

        if ($namaKategori === 'Cuti Tahunan'){
            $templatePath = public_path('templates/surat_cuti_tahunan.docx');
        } elseif($namaSubkategori === 'Cuti Melahirkan') {
            $templatePath = public_path('templates/surat_cuti_melahirkan.docx');
        } elseif ($namaSubkategori === 'Cuti Sakit') {
            $templatePath = public_path('templates/surat_cuti_guru.docx'); // Ubah path sesuai dengan lokasi template laporan Anda
        } else {
            $templatePath = public_path('templates/surat_cuti_lainnya.docx'); // Ubah path sesuai dengan lokasi template laporan Anda
        }

        // format tanggal
        $dateStart = $cuti->tanggal_mulai;
        $timestamp = strtotime($dateStart);
        $carbonDate = Carbon::parse($timestamp)->locale('id');
        $formattedDate = $carbonDate->format('d F Y');
        $dateEnd = $cuti->tanggal_akhir;
        $timechages = strtotime($dateEnd);
        $carbonDateEnd = Carbon::parse($timechages);
        $formattedDateEnd = $carbonDateEnd->format('d F Y');

        $templateProcessor = new TemplateProcessor($templatePath);
        $templateProcessor->setValue('nama_guru', $cutiGuru->name);
        $templateProcessor->setValue('nip_guru', $cutiGuru->nip);
        $templateProcessor->setValue('jabatan_guru', $cutiGuru->jabatan);
        $templateProcessor->setValue('pangkat_guru', $cutiGuru->pangkat);
        $templateProcessor->setValue('tanggal_mulai', $formattedDate);
        $templateProcessor->setValue('tanggal_akhir', $formattedDateEnd);
        $templateProcessor->setValue('durasi_cuti', $cuti->durasi);
        $templateProcessor->setValue('alasan_cuti', $cuti->alasan);
        $templateProcessor->setValue('status_cuti', $cuti->status);
        $templateProcessor->setValue('kategori_cuti', $namaKategori);
        $templateProcessor->setValue('subkategori_cuti', $namaSubkategori);
        $templateProcessor->setImageValue('tanda_tangan', [
            'path' => 'storage/foto_ttd_guru/' .$cuti->file_ttd,
            'width' => 150,
            'height' => 75,
            'ratio' => false,
        ]);
        $templateProcessor->setImageValue('tanda_tangan_kpsekolah', [
            'path' => 'storage/foto_ttd_guru/'.$cuti->file_ttd_kepsek,
            'width' => 150,
            'height' => 75,
            'ratio' => false,
        ]);
        // $templateProcessor->setImageValue('ttd', array($leave->signature, 'width' => 200, 'height' => 200, 'ratio' => false));
        $leader = User::where('role', 'kepala_sekolah')->first();
        if ($cuti->status == 'Setuju') {
            $tanggalUpdate = $cuti->updated_at;
            $timestamp = strtotime($tanggalUpdate);
            $carbonDate = Carbon::parse($timestamp)->locale('id');
            $formattedDate = $carbonDate->format('d F Y');
            $templateProcessor->setValue('tanggal_konfirmasi', $formattedDate);
        }
        $templateProcessor->setValue('kepala_sekolah', $leader->jabatan);
        $templateProcessor->setValue('nama_kepalaSekolah', $leader->name);
        $templateProcessor->setValue('nip_kepalaSekolah', $leader->nip);
        // Tambahkan penyesuaian lain sesuai dengan atribut yang ada dalam template laporan

        $filename = 'laporan_cuti_guru_' .$cuti->user->name .'_'. $namaSubkategori . '.docx';
        $templateProcessor->saveAs($filename);

        return Response::download($filename)->deleteFileAfterSend(true);
    }
}
