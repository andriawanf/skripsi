<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanDataGuru implements FromCollection, WithHeadings, WithMapping
{
    protected $dataGuru;

    public function __construct($dataGuru)
    {
        $this->dataGuru = $dataGuru;
    }

    public function collection()
    {
        return $this->dataGuru;
    }

    public function map($guru): array
    {
        return [
            $guru->id,
            $guru->name,
            $guru->nip,
            $guru->jabatan,
            $guru->pangkat,
            $guru->satuan_organisasi,
            $guru->saldo_cuti,
            $guru->email,
            $guru->role,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Guru',
            'NIP',
            'Jabatan',
            'Pangkat',
            'Satuan Organisasi',
            'Saldo Cuti',
            'email',
            'role',
        ];
    }
}
