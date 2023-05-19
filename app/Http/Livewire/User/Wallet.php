<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Wallet extends Component
{

    public $user;
    public function mount()
    {
        $this->user = User::find(auth()->id());
    }

    public function render()
    {
        return view('livewire.user.wallet');
    }
}
