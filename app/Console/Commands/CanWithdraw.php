<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Console\Command;

class CanWithdraw extends Command
{
    protected $signature = 'user:can_withdraw';
    protected $description = 'get from his wallet and check if the wallet created from 14 days make it can withdraw';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        info('can withdraw: ' . now());

        $wallets = Wallet::where('created_at', '>=', now()->subDays(14))->get();

        foreach ($wallets as $wallet) {
            $user = User::find($wallet->user_id);
            if($user) {
                $user->update(['wallet' => $user->wallet + $wallet->amount]);
                $wallet->delete();
            }

        }

        return 0;
    }
}
