<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PaybackRequest;
use App\Models\User;
use App\Services\PayLinkService;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        return view('front.user.wallet');
    }

    public function storeRequest(Request $request)
    {

        if($request->address && $request->bank_name && $request->bank_code && $request->email && $request->card_number && $request->card_holder&& $request->amount) {
            PaybackRequest::create([
                'user_id' => auth()->id(),
                'address' => $request->address,
                'bank_name' => $request->bank_name,
                'bank_code' => $request->bank_code,
                'email' => $request->email,
                'card_number' => $request->card_number,
                'card_holder' => $request->card_holder,
                'amount' => $request->amount,
                'status'=> 'not_paid'
            ]);
            session()->flash('payback_request_message_success', 'تم ارسال الطلب بنجاح سوف يتم التواصل مع في اقرب وقت ');
            return redirect()->back();
        }else{
            session()->flash('payback_request_message_fail', 'بيانات غير مكتمله ');
            return redirect()->back();
        }
    }

    public function recharge(Request $request)
    {
        $payLink = new PayLinkService();

        if($request->amount) {
            $user = User::find(auth()->id());
          return  $payLink->pay($request->amount, $user,'wallet',null,null,null);
        }
  }
}
