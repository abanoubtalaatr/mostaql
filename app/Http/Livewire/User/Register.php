<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Mail\VerifyEmail;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Services\GenerateCodeService;
use App\Services\OTPService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component
{
    use ValidationTrait;
    use WithFileUploads;

    public $form = [];
    public $cities = [];

    public function mount()
    {
        $this->form = ['user_type' => 'freelancer', 'default_language' => app()->getLocale()];
    }

    public function store()
    {
        $this->validate();

        $this->form['id_image'] = $this->form['id_image']->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->form['id_image']->extension(), 'public');
        unset($this->form['password_confirmation'], $this->form['terms_accepted']);
        $user = User::create(array_merge($this->form, ['password' => bcrypt($this->form['password'])]));


//        session()->put('username', $user->username);
//        $code = GenerateCodeService::getCode();
//        $user->update(['verified_code' => $code]);
////            $this->sendOTPToClient($user, $code);


        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => Str::random(60),
            ]
        );

        Mail::to($user->email)->send(new VerifyEmail($verificationUrl));

        session()->flash('check_your_email', 'برجاء تفقد ايميلك لتتمكن من الدخول');
    }

    // must refactor make api_id and api_password in .env file
    public function sendOTPToClient($user, $code)
    {
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $client->get("http://REST.GATEWAY.SA/api/SendSMS?api_id=API33785225719&api_password=wbH2RR2S7pPJFKF&sms_type=T&encoding=T&sender_id=Adsoldiers&phonenumber=966$user->mobile&textmessage=Verification code : $code&uid=xyz&callback_url=https://xyz.com/");
    }

    public function changeUserType($new_type)
    {
        $this->form['user_type'] = $new_type;
        $this->step = 2;
    }

    public function goBack()
    {
        $this->step = 1;
    }

    public function getRules()
    {
        return [
            'form.email' => 'required|max:200|email:dns,rfc|unique:users,email',
            'form.first_name' => 'required|max:100|unique:users,first_name',
            'form.last_name' => 'required|max:100|unique:users,last_name',
            'form.mobile' => 'required|starts_with:5|integer|digits:9',
            'form.password' => 'required|min:8',
            'form.password_confirmation' => 'required|same:form.password',
            'form.city_id' => ['required', 'exists:cities,id'],
            'form.country_id' => ['required', 'exists:countries,id'],
            'form.id_image' => ['nullable', 'image', 'mimes:png,jpg', 'max:2048'],
            'form.terms_accepted' => ['required', 'boolean'],
        ];
    }

    public function getCities()
    {
        $this->cities = City::where('country_id', $this->form['country_id'])->get();
    }

    public function getMessages()
    {
        return [
            'form.email.required_if' => __('site.email_is_required'),
            'form.mobile.required_if' => __('site.mobile_is_required'),
            'form.mobile.starts_with' => __('site.mobile_must_start_with_five'),
            'form.id_image' => 'lkdsjf'
        ];
    }


    public function render()
    {
        $countries = Country::all();
        return view('livewire.user.register', compact('countries'));
    }
}
