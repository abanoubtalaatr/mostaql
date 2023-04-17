<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;

class NotifySoliderNotEnoughDataCommand extends Command
{
    protected $signature = 'solider:not_enough_data';
    protected $description = 'Send notification to solider tell him not enough data must share from library';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        info('Notify solider not enough data: ' . now());

        $users = User::where('user_type', 'soldier')->where('task_level', 1)->get();

        foreach ($users as $user) {
            $totalNumberOfVisit = \App\Models\StatsCountrySoldier::where('user_id', $user->id)->where('item_type', 'library')->sum('visitors_number');
            if ($totalNumberOfVisit < 100) {
                $data = $user->notifications()->where('type', 'not_enough_data')->latest('created_at')->first();
                if ($data) {
                    $today = Carbon::today()->format('Y-m-d');
                    //get last time system send notification about not enough data
                    $lastTime = Carbon::parse($user->notifications()->where('type', 'not_enough_data')->latest('created_at')->first()->created_at);

                    //compare today with last time we send notification plus number of days that admin will select it from dashboard
                    if ($lastTime->addDays(\App\Models\Setting::first()->number_of_days)->format('Y-m-d') == $today) {
                        $user->notify(new \App\Notifications\NotifySoliderNotEnoughDataNotification());
                    }
                } else {
                    $user->notify(new \App\Notifications\NotifySoliderNotEnoughDataNotification());
                }
            }
        }

        return 0;
    }
}
