<?php

namespace App\Http\Livewire\Front;

use App\Mail\VerifyEmail;
use App\Services\OTPService;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Services\GenerateCodeService;

class ForgotPassword extends Component
{
    public $email, $message;

    public function sendEmail()
    {
//        if(!$user_id = optional(User::whereUsername($this->auth_field)->first())->id){
//            if(!$user_id = optional(User::whereMobile($this->auth_field)->first())->id){
//                if(!$user_id = optional(User::whereEmail($this->auth_field)->first())->id){
//                    $this->error_message = __('general.invalidLoginData');
//                }
//            }
//        }

//        if($user_id){
//            $code = GenerateCodeService::getCode();
//            OTPService::generateCode('reset_password',$user_id,$code);
//            return redirect()->to(route('user.verify_forget_password_code',$user_id));
//        }

        $this->validate();
        $user = User::where('email', $this->email)->first();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => Str::random(60),'forgot' => 'true']
        );

        Mail::to($user->email)->send(new VerifyEmail($verificationUrl));

        $this->message = trans('site.please_check_your_email');
    }

    public function render()
    {
        return view('livewire.front.forgot-password');
    }

    public function getRules()
    {
        return [
            'email' => ['required','exists:users,email']
        ];
    }
}
