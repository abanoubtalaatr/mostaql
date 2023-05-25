<?php

namespace App\Services;

use App\Models\Package;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PayLinkService
{

    public function pay($amount, User $user, $note = 'payForProject', Package $package = null, Project $project = null)
    {
        $url = env('PAYLINK_URL');
        $token = $this->authRequest();
        $projectId = 'test';
        $packageId = 'test';
        if ($project) {
            $projectId = $project->id;
        }

        if ($package) {
            $packageId = $package->id;
        }
        $postFields = [
            'amount' => $amount,
            'callBackUrl' => route('user.payment',"&ur=$user->id&project=$projectId&package=$packageId"),
            'cancelUrl' => route('user.cancel'),
            'clientEmail' => $user->email,
            'clientMobile' => $user->mobile,
            'clientName' => $user->first_name . ' ' . $user->last_name,
            'currency' => 'SAR',
            'note' => $note,
            'orderNumber' => Str::random(20),
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $token",
        ])->post($url, $postFields);

        if ($response->ok()) {
            redirect( $response['url']);
        }
    }

    public function authRequest()
    {
        $data = [
            'apiId' => "APP_ID_1123453311",
            'secretKey' => "0662abb5-13c7-38ab-cd12-236e58f43766"
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://restpilot.paylink.sa/api/auth', $data);

        if ($response->ok()) {
            return $response['id_token'];

            // use the token to make authenticated requests to the Paylink API
        } else {
            dd('error');
            // handle the error
        }
    }
}
