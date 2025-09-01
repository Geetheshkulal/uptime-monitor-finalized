<?php

namespace App\Observers;

use App\Models\Subscriptions;
use App\Models\User;
use Log;


class PauseMontiorObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $oldStatus = $user->getOriginal('status');
        $newStatus = $user->status;


        // Case 1: User downgraded to free
        if ($newStatus === 'free' && $oldStatus !== 'free') {
            // check user's own basic plan subscription
            $basic_plan = Subscriptions::where('plan_id', 'plan_basic')
                ->first();

            if ($basic_plan) {
                // Basic plan active → keep 5 monitors, pause the rest
                $userMonitors = $user->monitors()
                    ->orderBy('created_at', 'desc')
                    ->get();

                $monitorsToKeep = $userMonitors->take(5)->pluck('id');
                $monitorsToPause = $userMonitors->slice(5)->pluck('id');

                if ($monitorsToKeep->isNotEmpty()) {
                    $user->monitors()
                        ->whereIn('id', $monitorsToKeep)
                        ->update(['pause_on_expire' => false]);
                }

                if ($monitorsToPause->isNotEmpty()) {
                    $user->monitors()
                        ->whereIn('id', $monitorsToPause)
                        ->update(['pause_on_expire' => true]);
                }
            } else {
                // No active basic plan → pause all monitors
                $user->monitors()->update(['pause_on_expire' => true]);
            }
        }

        // Case 2: User upgraded to paid/free_trial
        if (
            in_array($newStatus, ['paid', 'free_trial'])) {
            $user->monitors()->update(['pause_on_expire' => false]);
        }

        Log::info("Observer updated: oldStatus={$oldStatus}, newStatus={$newStatus}");
    }




    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
