<?php

namespace App\Http\Livewire\Card;

use App\Models\Cuti;
use Livewire\Component;

class CardJumlahPengajuanCutiGuru extends Component
{
    public $jml_pengajuan_cuti_guru;

    public function mount()
    {
        $this->jml_pengajuan_cuti_guru = Cuti::count();
    }
    public function render()
    {
        return view('livewire.card.card-jumlah-pengajuan-cuti-guru');
    }
}
