<?php

namespace App\Http\Livewire\Card;

use App\Models\User;
use Livewire\Component;

class ProfileUser extends Component
{
    public $user;

    public function mount(){
        $user = auth()->user();
        $this->user = User::all();
    }
    public function render()
    {
        return view('livewire.card.profile-user');
    }
}
