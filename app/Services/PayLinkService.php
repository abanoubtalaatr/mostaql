<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PayLinkService
{

    public function pay($amount, User $user, $note = 'payForProject')
    {
        $url = env('PAYLINK_URL');

        $postFields = [
            'amount' => $amount,
            'callBackUrl' => route('payment'),
            'cancelUrl' => route('cancel'),
            'clientEmail' => $user->email,
            'clientMobile' => $user->mobile,
            'clientName' => $user->first_name . ' ' . $user->last_name,
            'currency' => 'SAR',
            'note' => $note,
            'orderNumber' => Str::random(20),
        ];

        Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJoYXNzYW4uYXlvdWIuMTk4MEBnbWFpbC5jb20iLCJhdXRoIjoiUk9MRV9NRVJDSEFOVCxST0xFX01FUkNIQU5UX0FDQ09VTlQiLCJpc3MiOiJBUEkiLCJleHAiOjE2ODQ5OTQ3ODZ9.LMCpbud0P9rXM6S-NmC2hZdmzgTPRtEaad-KbcrDCJoq7yrGVRf7UHh2iSZnYmxbt-N0yUo1drRUjHcatiLcGg',
        ])->post($url, $postFields);
    }
}
