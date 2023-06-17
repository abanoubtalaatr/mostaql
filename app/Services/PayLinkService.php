<?php

namespace App\Services;

use App\Models\Package;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PayLinkService
{

    public function pay($amount, User $user, $note = 'payForProject', $package, $project, $proposal)
    {
        $url = env('PAYLINK_URL');
        $token = $this->authRequest();
        $projectId = 'test';
        $packageId = 'test';
        $proposalId = 'test';
        $wallet =false;
        if($note =='wallet') {
            $wallet =true;
        }
        if ($project) {
            $projectId = $project->id;
        }

        if ($package) {
            $packageId = $package->id;
        }

        if ($proposal) {
            $proposalId = $proposal->id;
        }

        $postFields = [
            'amount' => $amount,
            'callBackUrl' => route('user.payment', "&ur=$user->id&project=$projectId&package=$packageId&proposal=$proposalId&wallet=$wallet&amount=$amount&note=$note"),
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

return            redirect($response['url']);
        }
    }

    public function authRequest()
    {

        $data = [
            'apiId' => "APP_ID_1681303723036",
            'secretKey' => "e6b717d3-62ff-4f8c-a451-4194c2c5d55a"
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://restapi.paylink.sa/api/auth', $data);

        if ($response->ok()) {
            return $response['id_token'];

            // use the token to make authenticated requests to the Paylink API
        } else {
            dd('error');
            // handle the error
        }
    }
}
