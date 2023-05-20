<?php

namespace App\Http\Livewire\Front;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use function view;

class Reset extends Component
{
    public $password, $password_confirmation, $token, $email, $message;

    public function mount()
    {
    }
    public function resetPassword()
    {
        $this->validate();

        $user = User::where('email' , $this->email)->where('reset_token', $this->token)->first();

        if($user) {
            $user->update(['password' => Hash::make($this->password),'reset_token' => null]);

            $this->message= 'تم تغير كلمة المرور بنجاح';
            return redirect()->to(app()->getLocale().'/user/login');

        }else{
            $this->message = 'لقد حدث خظاء ما حاول مره اخري في وقت اخر';
        }
    }

    public function getRules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function render()
    {
        return view('livewire.front.reset');
    }
}
