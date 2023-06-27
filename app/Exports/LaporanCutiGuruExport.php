<?php

namespace App\Exports;

use App\Models\Cuti;
use App\Models\Kategori;
use App\Models\Subkategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaporanCutiGuruExport implements FromCollection, WithHeadings, WithMapping
{
    protected $cutis;

    public function __construct($cutis)
    {
        $this->cutis = $cutis;
    }

    public function collection()
    {
        return $this->cutis;
    }
    public function with(): array
    {
        $subkategori = Subkategori::all();
        $kategori = Kategori::all();

        return [
            'subkategori' => $subkategori,
            'kategori' => $kategori->all(),
        ];
    }

    public function map($cuti): array
    {
        $subkategoriNama = '-';
        if ($cuti->subkategori) {
            $subkategoriNama = $cuti->subkategori->nama_subkategoris;
        }

        return [
            $cuti->id,
            $cuti->user->name,
            $cuti->kategori->nama,
            $subkategoriNama,
            $cuti->tanggal_mulai,
            $cuti->tanggal_akhir,
            $cuti->durasi,
            $cuti->alasan,
            $cuti->status,
            // Tambahkan kolom-kolom lain yang ingin Anda export dan atur tampilan
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('B2:B100')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
                // Mengatur format tanggal pada kolom Tanggal Mulai
                $event->sheet->getStyle('C2:C100')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
                // Mengatur format tanggal pada kolom Tanggal Selesai
            },
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Guru',
            'Kategori',
            'SubKategori',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Total Cuti',
            'Alasan Cuti',
            'Status',
        ];
    }
}
