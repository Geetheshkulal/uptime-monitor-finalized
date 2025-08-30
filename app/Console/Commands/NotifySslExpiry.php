<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\SslExpiryMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NotifySslExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Run with: php artisan ssl:notify
     */
    protected $signature = 'ssl:notify';

    /**
     * The console command description.
     */
    protected $description = 'Send notifications to users about SSL expiry dates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Example: fetch sites or users with SSL expiring soon
        $expiringSites = DB::table('s_s_l')
            ->where('valid_to', '<=', Carbon::now()->addDays(7))
            ->get();

        if ($expiringSites->isEmpty()) {
            $this->info('No SSL certificates expiring within 7 days.');
            return Command::SUCCESS;
        }

        foreach ($expiringSites as $site) {
            $user = User::find($site->user_id);

            if ($user) {
                Mail::to($user->email)->send(new SslExpiryMail($site));
                $this->info("Notification sent to: {$user->email}");
            }
        }

        return Command::SUCCESS;
    }
}
