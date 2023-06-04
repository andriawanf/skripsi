<?php

namespace App\Http\Livewire\Card;

use App\Models\User;
use Livewire\Component;

class CardjumlahGuru extends Component
{
    public $jumlahGuru;

    public function mount()
    {
        $this->jumlahGuru = User::count();
    }
    public function render()
    {
        return view('livewire.card.cardjumlah-guru');
    }
}
