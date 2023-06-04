<?php

namespace App\Http\Livewire\Card;

use App\Models\Cuti;
use Livewire\Component;

class CardCutiPending extends Component
{
    public function render()
    {
        $cutiPending = Cuti::where('status', 'Pending')->get();
        return view('livewire.card.card-cuti-pending', compact('cutiPending'));
    }
}
