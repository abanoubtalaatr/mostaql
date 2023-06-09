<?php

namespace App\Services;

use App\Models\Package;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\PseudoTypes\True_;

class PayLinkService
{

    protected $appId;
    protected $paylinkUrl;
    protected $secretKey;

    public function __construct()
    {
        $this->appId = env('PAYLINK_APP_ID');
        $this->secretKey = env('PAYLINK_SECKRET_KEY');
        $this->paylinkUrl = env('PAYLINK_URL');
    }

    public function pay($amount, User $user, $note = 'payForProject', $package, $project, $proposal)
    {
        $url = env('PAYLINK_URL');
        $token = $this->authRequest();

        $projectId = 'test';
        $packageId = 'test';
        $proposalId = 'test';
        $wallet = false;
        if ($note == 'wallet') {
            $wallet = true;
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

            return redirect($response['url']);
        }
    }

    public function authRequest()
    {

        $data = [
            'apiId' => $this->appId,
            'secretKey' => $this->secretKey
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://restapi.paylink.sa/api/auth', $data);

        //demo
//        $data = [
//            'apiId' => "APP_ID_1123453311",
//            'secretKey' => "0662abb5-13c7-38ab-cd12-236e58f43766"
//        ];
//
//        $response = Http::withHeaders([
//            'Content-Type' => 'application/json'
//        ])->post('https://restpilot.paylink.sa/api/auth', $data);

        if ($response->ok()) {
            return $response['id_token'];

            // use the token to make authenticated requests to the Paylink API
        } else {
            dd('error');
            // handle the error
        }
    }


    public function getInvoice($transactionNo)
    {
        $token = $this->authRequest();

        $response = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('https://restapi.paylink.sa/api/getInvoice/' . $transactionNo);

        if ($response['orderStatus'] != 'Pending') {
            return true;
        } else {
            return false;
        }
    }
}
