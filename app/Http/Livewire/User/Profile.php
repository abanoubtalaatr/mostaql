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

class Profile extends Component
{
    public function render()
    {
        $countries = Country::all();

        return view('livewire.user.profile', compact('countries'))->layout('layouts.front');
    }
}
