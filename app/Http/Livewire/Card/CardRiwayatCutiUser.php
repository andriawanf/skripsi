<?php

namespace App\Http\Livewire\Card;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CardRiwayatCutiUser extends Component
{
    

    public function render()
    {
        $user = Auth::user();
        $totalCuti = $user->cutis->count();
        return view('livewire.card.card-riwayat-cuti-user', compact('totalCuti'));
    }
}
