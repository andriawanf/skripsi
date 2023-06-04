<?php

namespace App\Http\Livewire\Table;

use App\Models\Cuti;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

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
}
