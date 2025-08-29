<?php

namespace App\Services;

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use App\Models\PushSubscription;
use Illuminate\Support\Facades\Log;

class PwaNotificationService
{
    protected $webPush;

    public function __construct()
    {
        $this->webPush = new WebPush([
            'VAPID' => [
                'subject' => config('webpush.vapid.subject'),
                'publicKey' => config('webpush.vapid.public_key'),
                'privateKey' => config('webpush.vapid.private_key'),
            ]
        ]);
    }

    /**
     * Send PWA notification to a user
     */
    public function sendToUser($userId, $title, $body, $url = '/')
    {
        $subscriptions = PushSubscription::where('user_id', $userId)->get();

        if ($subscriptions->isEmpty()) {
            return false; // No subscription found
        }

        $payload = json_encode([
            'title' => $title,
            'body'  => $body,
            'icon'  => '/logo.png',
            'url'   => $url,
        ]);

        foreach ($subscriptions as $subscription) {
            $pushSubscription = new Subscription(
                $subscription->endpoint,
                $subscription->p256dh,
                $subscription->auth,
                'aes128gcm'
            );

            $this->webPush->queueNotification($pushSubscription, $payload);
        }

        $results = $this->webPush->flush();

        // Optional: Log errors for failed notifications
        foreach ($results as $report) {
            if (!$report->isSuccess()) {
                Log::warning("PWA notification failed for user {$userId}: " . $report->getReason());
            }
        }

        return true;
    }
}
