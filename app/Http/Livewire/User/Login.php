<?php

namespace App\Http\Livewire\User;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Component;

class Login extends Component
{
    public $username, $password, $remember_me, $error_message = '';

    public function login()
    {
        $this->validate();
        // if user enter email or mobile , then check if verified or not in two cases
        if (auth('users')->attempt(['email' => $this->username, 'password' => $this->password], $this->remember_me)) {
            $user = User::find(auth()->id());
            if (!auth()->user()->email_verified_at) {
                // check your mail
                $user = User::find(auth()->id());
                Auth::logout();
                $this->sendVerficationEmail($user);

                session()->flash('please_check_your_email_we_send_email_verification', trans('site.please_check_your_email_we_send_email_verification'));
//                return redirect()->to(route('user.verify_register_code'));
            } else {
                return redirect()->to(\url("user/projects"));
            }

        } else {
            if (auth('users')->attempt(['mobile' => $this->username, 'password' => $this->password], $this->remember_me)) {
                if (auth()->user()->is_verified == 0) {
                    return redirect()->to(route('user.verify_register_code'));
                }
                return redirect()->to(route('user.dashboard'));
            } else {

                if (auth('users')->attempt(['email' => $this->username, 'password' => $this->password], $this->remember_me)) {
                    if (auth()->user()->is_verified == 0) {
                        return redirect()->to(route('user.verify_register_code'));
                    }
                    return redirect()->to(route('user.dashboard'));
                }
                $this->error_message = __('messages.Wrong_credential');
            }

        }
    }


    public function sendVerficationEmail($user)
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => Str::random(60)]
        );

        Mail::to($user->email)->send(new VerifyEmail($verificationUrl));

    }

    public function getRules()
    {
        return [
            'password' => 'required|min:8',
            'username' => 'required|max:50'
        ];
    }

    public function render()
    {
        return view('livewire.user.login');
    }
}
