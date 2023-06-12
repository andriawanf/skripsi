<?php

namespace App\Http\Livewire\Table;

use App\Models\Cuti;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Livewire\Component;
use Livewire\WithPagination;
use PhpOffice\PhpWord\TemplateProcessor;

class TabelRiwayatCutiGuru extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $totalDays;

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
        $cutiGuru = Cuti::orderBy($this->orderColumn, $this->sortOrder)->select('*');

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
                })->orWhere('status','like',"%".$this->searchTerm."%");
            });
        }

        $cutiGuru->whereIn('status', ['Setuju', 'Tolak']);
        $cutiGuru = $cutiGuru->paginate($this->perPage);
        $this->cutiGuruTotal = $cutiGuru->total();

        return view('livewire.table.tabel-riwayat-cuti-guru', compact('cutiGuru'));
    }

    public function countTotalDays()
    {
        if ($this->tanggal_mulai && $this->tanggal_akhir) {
            $start = Carbon::parse($this->tanggal_mulai);
            $end = Carbon::parse($this->tanggal_akhir);
            $totalDays = $end->diffInDays($start) + 1; // Menghitung selisih hari termasuk tanggal awal dan akhir
            $this->totalDays = $totalDays;
        } else {
            $this->totalDays = null;
        }
    }

    public function exportDocx($id)
    {
        $cuti = Cuti::find($id);
        // $cutiGuru = User::find($cuti->user_id);
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
        $templateProcessor->setValue('nama_guru', $cuti->user->name);
        $templateProcessor->setValue('nip_guru', $cuti->user->nip);
        $templateProcessor->setValue('jabatan_guru', $cuti->user->jabatan);
        $templateProcessor->setValue('pangkat_guru', $cuti->user->pangkat);
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

        if ($namaKategori === 'Cuti Tahunan') {
            $filename = 'laporan_cuti_guru_' .$cuti->user->name .'_'. $namaKategori . '.docx';
        } elseif($namaSubkategori) {
            $filename = 'laporan_cuti_guru_' .$cuti->user->name .'_'. $namaSubkategori . '.docx';
        }
        
        $templateProcessor->saveAs($filename);

        return Response::download($filename)->deleteFileAfterSend(true);
    }
}
