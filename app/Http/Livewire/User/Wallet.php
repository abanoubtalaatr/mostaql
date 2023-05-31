<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Wallet extends Component
{
    public $user;
    public $form, $message;

    public function mount()
    {
        $this->user = User::find(auth()->id());
    }

    public function send()
    {
       $this->validate([
           'form.email' => 'required'
       ]);

        if($this->user->wallets()->where('can_withdraw', 1)->sum('amount') > 0 ){

        }else{
            $this->message = 'ليس لديك رصيد يمكنك سحبه الان';
        }

    }

    public function getRules()
    {

        return [
            'form.email' => ['required', 'email'],
        ];
    }

    public function render()
    {
        return view('livewire.user.wallet');
    }
}
