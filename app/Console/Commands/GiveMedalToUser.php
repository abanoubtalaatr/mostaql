<?php

namespace App\Console\Commands;

use App\Models\MedalUser;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Console\Command;

class GiveMedalToUser extends Command
{
    protected $signature = 'user:give_medal_to_user';
    protected $description = 'give user medals depend on complete projects';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            $numberOfProjectsThatCompleted = $user->proposals()
                ->where('status_id', 12)
                ->whereHas('project', function ($query) {
                    $query->where('status_id', 3);
                })
                ->count();

            if ($numberOfProjectsThatCompleted >= 5) {
                MedalUser::create([
                    'user_id' => $user->id,
                    'medal_id' => 1,
                ]);
            }

            if ($numberOfProjectsThatCompleted >= 10) {
                MedalUser::create([
                    'user_id' => $user->id,
                    'medal_id' => 2,
                ]);
            }

            if ($numberOfProjectsThatCompleted >= 15) {
                MedalUser::create([
                    'user_id' => $user->id,
                    'medal_id' => 3,
                ]);
            }

            if ($numberOfProjectsThatCompleted >= 20) {
                MedalUser::create([
                    'user_id' => $user->id,
                    'medal_id' => 4,
                ]);
            }
        }

        return 0;
    }
}
