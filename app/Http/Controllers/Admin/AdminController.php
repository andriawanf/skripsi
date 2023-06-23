<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaporanCutiGuruExport;
use App\Exports\LaporanDataGuru;
use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard-admin');
    }

    public function dataGuru()
    {
        $gurus = User::where('role', 'user')->get();
        return view('admin.data-guru', compact('gurus'));
    }

    public function riwayatCutiGuru()
    {
        $cutiKonfirmasi = Cuti::where('status', 'Konfirmasi')->paginate(10);
        $cutiPending = Cuti::where('status', 'Pending')->paginate(10);

        return view('admin.riwayat-cuti-guru', compact('cutiPending', 'cutiKonfirmasi'));
    }

    public function showTambahKategori()
    {
        $kategori = Kategori::leftJoin('subkategoris', 'kategoris.id', '=', 'subkategoris.kategori_id')
            ->select('kategoris.id', 'kategoris.nama', 'subkategoris.nama_subkategoris AS subkategori_nama')
            ->paginate(10);
        $subkategori = Subkategori::all();
        return view('admin.tambah-kategori', compact('kategori', 'subkategori'));
    }

    public function showTambahSubkategori()
    {
        $kategori = Kategori::all();
        $subkategori = Subkategori::paginate(10);
        return view('admin.tambah-subkategori', compact('kategori', 'subkategori'));
    }

    public function storeKategori(Request $request)
    {
        // validasi form
        $request->validate([
            'nama' => 'required'
        ]);

        // create data kategori
        Kategori::create([
            'nama' => $request->nama,
        ]);

        // redirecting
        return redirect()->route('tambah-kategori')->with(['message' => 'Kategori baru berhasil ditambahkan!']);
    }

    public function storeSubkategori(Request $request)
    {
        // validasi form
        $request->validate([
            'kategori_id' => 'required',
            'nama_subkategoris' => 'required'
        ]);

        // create data subkategori
        $kategori = Kategori::find($request->kategori_id);
        $subkategori = new Subkategori;
        $subkategori->nama_subkategoris = $request->nama_subkategoris;

        $kategori->subkategoris()->save($subkategori);

        // redirecting
        return redirect()->route('tambah-subkategori')->with(['message' => 'Kategori baru berhasil ditambahkan!']);
    }

    public function exportPDF()
    {
        $cutiGuru = Cuti::whereIn('status', ['Setuju', 'Tolak'])->get(); // Ubah sesuai model dan atribut yang sesuai dengan tabel cuti guru Anda

        $options = new Options();
        $options->set('defaultFont', 'Poppins');
        $pdf = new Dompdf($options);
        $pdf->loadHtml(View::make('livewire.template.riwayat-cuti-guru-pdf', compact('cutiGuru'))->render());
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream('laporan_cuti_guru.pdf');
    }

    public function exportEXCELDataGuru()
    {
        $dataGuru = User::where('role', 'user')->get();

        // Generate dan simpan file Excel menggunakan Laravel Excel
        return Excel::download(new LaporanDataGuru($dataGuru), 'laporan_data_guru.xlsx');
        // $options = new Options();
        // $options->set('defaultFont', 'Poppins');
        // $pdf = new Dompdf($options);
        // $pdf->loadHtml(View::make('livewire.template.data-guru-pdf', compact('dataGuru'))->render());
        // $pdf->setPaper('A4', 'landscape');
        // $pdf->render();

        // return $pdf->stream('laporan_data_guru.pdf');
    }

    public function exportPDFRiwayatCutiGuru()
    {
        // Ambil data cuti guru yang berstatus "Setuju"
        $cutis = auth()->user()->cutis;

        // Generate dan simpan file Excel menggunakan Laravel Excel
        return Excel::download(new LaporanCutiGuruExport($cutis), 'laporan_cuti_guru.xlsx');
    }

    public function exportDocx($id)
    {
        $cuti = Cuti::find($id);

        $templatePath = public_path('templates/laporan_cuti_guru.docx'); // Ubah path sesuai dengan lokasi template laporan Anda

        $templateProcessor = new TemplateProcessor($templatePath);
        $templateProcessor->setValue('nama_guru', $cuti->user->name);
        $templateProcessor->setValue('nip_guru', $cuti->user->nip);
        $templateProcessor->setValue('jabatan_guru', $cuti->user->jabatan);
        $templateProcessor->setValue('pangkat_guru', $cuti->user->pangkat);
        $templateProcessor->setValue('tanggal_mulai', $cuti->tanggal_mulai);
        $templateProcessor->setValue('tanggal_akhir', $cuti->tanggal_akhir);
        $templateProcessor->setValue('durasi_cuti', $cuti->durasi);
        $templateProcessor->setValue('alasan_cuti', $cuti->alasan);
        $templateProcessor->setValue('kategori', $cuti->kategori->nama);
        $templateProcessor->setValue('subkategori', $cuti->subkategori->nama_subkategories);
        // $templateProcessor->setImageValue('ttd', array($leave->signature, 'width' => 200, 'height' => 200, 'ratio' => false));
        $leader = User::where('role', 'admin')->first();
        $templateProcessor->setValue('kepala_sekolah', $leader->jabatan);
        $templateProcessor->setValue('nama_kepalaSekolah', $leader->name);
        // Tambahkan penyesuaian lain sesuai dengan atribut yang ada dalam template laporan

        $filename = 'laporan_cuti_guru_' . $cuti->id . '.docx';
        $templateProcessor->saveAs($filename);

        return Response::download($filename)->deleteFileAfterSend(true);
    }
    public function cetakLaporan()
    {
        // Ambil data cuti guru yang berstatus "Setuju"
        $cutis = Cuti::where('status', ['Setuju', 'Tolak'])->get();

        // Generate dan simpan file Excel menggunakan Laravel Excel
        return Excel::download(new LaporanCutiGuruExport($cutis), 'laporan_cuti_guru.xlsx');
    }
}
