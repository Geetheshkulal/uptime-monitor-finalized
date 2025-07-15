<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Monitors;

class FixPauseOnExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor:pause';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $users = User::where('status', 'free')->get();

    foreach ($users as $user) {
        $monitors = Monitors::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($monitors->count() > 5) {
            $monitorsToPause = $monitors->slice(5);

            foreach ($monitorsToPause as $monitor) {
                $monitor->pause_on_expire = true;
                $monitor->save();
                $this->info("Paused monitor ID: {$monitor->id} for user ID: {$user->id}");
            }
        }
    }

    $this->info("Fix completed.");
    return 0;
}
}
