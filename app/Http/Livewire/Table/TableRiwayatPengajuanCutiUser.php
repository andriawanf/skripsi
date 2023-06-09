<?php

namespace App\Http\Livewire\Table;

use App\Models\Cuti;
use App\Models\Guru;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Livewire\Component;
use Livewire\WithPagination;
use PhpOffice\PhpWord\TemplateProcessor;

class TableRiwayatPengajuanCutiUser extends Component
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

    public function exportDocx($id)
    {
        $cuti = Cuti::find($id);
        $cutiGuru = auth()->user();
        $cutiGuru->user;
        $kategori = Kategori::find($cuti->kategori_id);
        $subkategori = Subkategori::find($cuti->subkategori_id);

        // Mendapatkan nama kategori dan subkategori
        $namaKategori = $kategori->nama;
        $namaSubkategori = $subkategori->nama_subkategoris;

        if ($subkategori->nama_subkategoris === 'Cuti Melahirkan') {
            $templatePath = public_path('templates/laporan_cuti_melahirkan.docx');
        } elseif ($subkategori->nama_subkategoris === 'Cuti Sakit') {
            $templatePath = public_path('templates/laporan_cuti_guru.docx'); // Ubah path sesuai dengan lokasi template laporan Anda
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
        $templateProcessor->setValue('kategori_cuti', $cuti->kategori->nama);
        $templateProcessor->setValue('subkategori_cuti', $cuti->subkategori->nama_subkategoris);
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

        $filename = 'laporan_cuti_guru_' .$cuti->user->name .'_'. $cuti->subkategori->nama_subkategoris . '.docx';
        $templateProcessor->saveAs($filename);

        return Response::download($filename)->deleteFileAfterSend(true);
    }
}
