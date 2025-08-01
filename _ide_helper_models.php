<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BlockedIp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockedIp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockedIp query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockedIp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockedIp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockedIp whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockedIp whereUpdatedAt($value)
 */
	class BlockedIp extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $version
 * @property string|null $release_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Changelog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Changelog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Changelog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Changelog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Changelog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Changelog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Changelog whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Changelog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Changelog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Changelog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Changelog whereVersion($value)
 */
	class Changelog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property string $comment_message
 * @property int $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ticket $ticket
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $subscription_id
 * @property string $code
 * @property array|null $user_ids
 * @property string $discount_type
 * @property string $value
 * @property int|null $max_uses
 * @property int $uses
 * @property string|null $valid_from
 * @property string|null $valid_until
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $claimedUsers
 * @property-read int|null $claimed_users_count
 * @property-read \App\Models\Subscriptions|null $subscription
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereMaxUses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereUserIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereUses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereValidFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereValidUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode whereValue($value)
 */
	class CouponCode extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $coupon_code_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CouponCode $coupon
 * @method static \Illuminate\Database\Eloquent\Builder|CouponUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponUser whereCouponCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponUser whereUserId($value)
 */
	class CouponUser extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $monitor_id
 * @property string $status
 * @property int $response_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DnsResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DnsResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DnsResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|DnsResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DnsResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DnsResponse whereMonitorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DnsResponse whereResponseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DnsResponse whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DnsResponse whereUpdatedAt($value)
 */
	class DnsResponse extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $monitor_id
 * @property string $status
 * @property int $status_code
 * @property int $response_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Monitors $monitor
 * @method static \Illuminate\Database\Eloquent\Builder|HttpResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HttpResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HttpResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|HttpResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpResponse whereMonitorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpResponse whereResponseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpResponse whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpResponse whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpResponse whereUpdatedAt($value)
 */
	class HttpResponse extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $status
 * @property string $root_cause
 * @property \Illuminate\Support\Carbon|null $start_timestamp
 * @property \Illuminate\Support\Carbon|null $end_timestamp
 * @property int $monitor_id
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Monitors $monitor
 * @method static \Illuminate\Database\Eloquent\Builder|Incident newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident query()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereEndTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereMonitorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereRootCause($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereStartTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereUpdatedAt($value)
 */
	class Incident extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $status
 * @property int $paused
 * @property int $pause_on_expire
 * @property int $user_id
 * @property string $url
 * @property string $type
 * @property int|null $port
 * @property int $retries
 * @property string|null $dns_resource_type
 * @property int $interval
 * @property string $email
 * @property string|null $telegram_id
 * @property string|null $telegram_bot_token
 * @property string|null $last_checked_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Incident> $incidents
 * @property-read int|null $incidents_count
 * @property-read \App\Models\PortResponse|null $latestPortResponse
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PingResponse> $pingResponses
 * @property-read int|null $ping_responses_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors query()
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereDnsResourceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereLastCheckedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors wherePauseOnExpire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors wherePaused($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereRetries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereTelegramBotToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereTelegramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitors whereUserId($value)
 */
	class Monitors extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $monitor_id
 * @property string $token
 * @property string $status
 * @property int $follow_up_sent
 * @property string|null $last_notified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Monitors $monitor
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereFollowUpSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereLastNotifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereMonitorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $subscription_id
 * @property string|null $coupon_code
 * @property string|null $discount_type
 * @property string|null $coupon_value
 * @property string|null $payment_amount
 * @property string $status
 * @property int $user_id
 * @property string $payment_status
 * @property string $transaction_id
 * @property string $payment_type
 * @property string|null $start_date
 * @property string|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $pincode
 * @property string|null $country
 * @property-read \App\Models\Subscriptions $subscription
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCouponCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCouponValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePincode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $monitor_id
 * @property string $status
 * @property int $response_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Monitors $monitor
 * @method static \Illuminate\Database\Eloquent\Builder|PingResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PingResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PingResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|PingResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PingResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PingResponse whereMonitorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PingResponse whereResponseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PingResponse whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PingResponse whereUpdatedAt($value)
 */
	class PingResponse extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $monitor_id
 * @property int $response_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property-read \App\Models\Monitors $monitor
 * @method static \Illuminate\Database\Eloquent\Builder|PortResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PortResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PortResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|PortResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortResponse whereMonitorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortResponse whereResponseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortResponse whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortResponse whereUpdatedAt($value)
 */
	class PortResponse extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $endpoint
 * @property string $p256dh
 * @property string $auth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereEndpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereP256dh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereUserId($value)
 */
	class PushSubscription extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $url
 * @property string $valid_from
 * @property string $valid_to
 * @property string $status
 * @property string $issuer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl whereIssuer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl whereValidFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ssl whereValidTo($value)
 */
	class Ssl extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Payment|null $payment
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereUpdatedAt($value)
 */
	class Subscriptions extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $template_name
 * @property string $content
 * @property string|null $variables
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereVariables($value)
 */
	class Template extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $created_by
 * @property string $ticket_id
 * @property int $user_id
 * @property string $title
 * @property string $message
 * @property array|null $attachments
 * @property string $status
 * @property string $priority
 * @property int|null $assigned_user_id
 * @property int $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $assignedUser
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User|null $created_by_user
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereAssignedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUserId($value)
 */
	class Ticket extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $ip
 * @property string|null $user_agent
 * @property string|null $isp
 * @property string|null $country
 * @property string|null $browser
 * @property string|null $email
 * @property string|null $status
 * @property string|null $reason
 * @property string|null $platform
 * @property string|null $referrer
 * @property string $url
 * @property string $method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereIsp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereReferrer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrafficLog whereUserAgent($value)
 */
	class TrafficLog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $status
 * @property mixed $password
 * @property string|null $last_login_ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $email
 * @property string|null $remember_token
 * @property string|null $session_id
 * @property string|null $premium_end_date
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $country_code
 * @property string $phone
 * @property int|null $parent_user_id
 * @property string|null $status_page_hash
 * @property int $enable_public_status
 * @property string|null $address_1
 * @property string|null $address_2
 * @property string|null $place
 * @property string|null $state
 * @property string|null $pincode
 * @property string|null $country
 * @property string|null $gstin
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $district
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CouponCode> $coupons
 * @property-read int|null $coupons_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Monitors> $monitors
 * @property-read int|null $monitors_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \App\Models\UserNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read User|null $parentUser
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $subUsers
 * @property-read int|null $sub_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEnablePublicStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGstin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereParentUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePincode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePremiumEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatusPageHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property array $data
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $notifiable
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection<int, static> all($columns = ['*'])
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification read()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification unread()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereUpdatedAt($value)
 */
	class UserNotification extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $status
 * @property string|null $error_message
 * @property string|null $qr_code
 * @property string|null $user_name
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession whereErrorMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession whereQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WhatsappSession whereUserName($value)
 */
	class WhatsappSession extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property array $whitelist
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Whitelist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Whitelist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Whitelist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Whitelist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Whitelist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Whitelist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Whitelist whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Whitelist whereWhitelist($value)
 */
	class Whitelist extends \Eloquent {}
}

