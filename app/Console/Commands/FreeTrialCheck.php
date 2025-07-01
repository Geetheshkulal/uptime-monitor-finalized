<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;


class FreeTrialCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:free-trial-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update users whose free trial has expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenDayAgo = Carbon::now()->subDays(10);

        $users = User::where('status','free_trial')
            ->where('created_at','<',  $tenDayAgo)
            ->get();

            $this->info("Found " . $users->count() . " users whose free trial has expired.");

            foreach ($users as $user){
                $user->status= 'free';
                $user->premium_end_date = null;
                $user->save();

                $this->info("Updated user ID: {$user->id} to status 'free' after free trial expired.");
            }

            return 0;
    }
}
