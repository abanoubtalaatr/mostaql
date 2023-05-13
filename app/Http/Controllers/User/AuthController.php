<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Services\GenerateCodeService;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('front.auth.register');
    }

    public function showLoginForm()
    {
        return view('front.auth.login');
    }

    public function showEditProfile()
    {
        return view('front.auth.edit');
    }
    public function showForgotPasswordForm()
    {
        return view('front.auth.forgot_password');
    }


    public function verifyForgetPasswordCode(User $user)
    {
        return view('front.auth.verify_forget_password_code', compact('user'));
    }

    public function verifyRegisterCode()
    {
        return view('livewire.front.verify-account');
    }

    public function verifyRegisterCodePost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'verification_code' => 'required|min:4|max:4',
            'username' => 'required|exists:users,username'
        ]);

        $validator->after(function ($validator) use ($request) {
            $user = User::where('username', $request->username)->first();
            if ($user) {

                if ($user->verified_code == $request->verification_code) {
                    $user->update(['is_verified' => 1]);

                } else {
                    $validator->errors()->add('verification_code', __('messages.verification_code_is_wrong'));
                }
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        return redirect()->to(route('user.dashboard'))->withSuccessMessage(__('site.saved'));;
    }

    public function resendOtpCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:users,username'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::where('username', $request->username)->first();
        if ($user) {
            $code = GenerateCodeService::getCode();
            $user->update(['verified_code' => $code]);
            $this->sendOTPToClient($user, $code);
            return redirect()->back()->with('success', __('site.check_your_phone'));
        }
        return redirect()->back();

    }


// must refactor make api_id and api_password in .env file
    public function sendOTPToClient($user, $code)
    {
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $client->get("http://REST.GATEWAY.SA/api/SendSMS?api_id=API33785225719&api_password=wbH2RR2S7pPJFKF&sms_type=T&encoding=T&sender_id=Adsoldiers&phonenumber=966$user->mobile&textmessage=Verification code : $code&uid=xyz&callback_url=https://xyz.com/");
    }

    public function profile()
    {
        return view('front.auth.profile');
    }

    public function saveProfile(EditProfileRequest $request)
    {
        $data = $request->validated();

        $data['avatar'] = $request->hasFile('avatar') ? $request->avatar->storeAs(date('Y/m/d'), Str::random(50) . '.' . $request->avatar->extension(), 'public') : auth('users')->user()->avatar;
        auth('users')->user()->update($data);
        return redirect()->to(route('user.edit_profile'))->withSuccessMessage(__('site.saved'));
    }

    public function showMyFavourite()
    {
        return view('front.user.favourite.index');
    }

    public function logout()
    {
        auth('users')->logout();
        return redirect()->to('/');
    }

}
