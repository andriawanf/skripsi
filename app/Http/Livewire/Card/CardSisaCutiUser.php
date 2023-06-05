<?php

namespace App\Http\Livewire\Card;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CardSisaCutiUser extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }
    
    public function render()
    {
        
        return view('livewire.card.card-sisa-cuti-user');
    }
}
