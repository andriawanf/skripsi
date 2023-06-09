<?php

namespace App\Http\Livewire\Card;

use App\Models\Cuti;
use Livewire\Component;
use Livewire\WithPagination;

class CardListRiwayatCutiUser extends Component
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

        return view('livewire.card.card-list-riwayat-cuti-user', compact('cutiGuru'));
    }

    public function getCuti()
    {
        return Cuti::paginate($this->pagination);
    }
}
