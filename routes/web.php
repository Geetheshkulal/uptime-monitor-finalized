<?php

use App\Http\Controllers\FeedBack\FeedBackController;
use Illuminate\Http\Request;
use App\Models\Subscriptions;
use App\Events\AdminNotification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PremiumPageController;
use Illuminate\Session\Middleware\StartSession;

use App\Http\Controllers\Ticket\TicketController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminWhatsAppController;
use App\Http\Controllers\Admin\AppNotificationController;
use App\Http\Controllers\Admin\EditTemplateController;
use App\Http\Controllers\Admin\TrafficLogController;
use App\Http\Controllers\Admin\TrackingController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\UserSubscriptionController;
use App\Http\Controllers\Admin\InvoicesController;
use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Admin\CouponController;


use App\Http\Controllers\Monitor\HttpMonitoringController;
use App\Http\Controllers\Monitor\MonitoringController;
use App\Http\Controllers\Monitor\PingMonitoringController;
use App\Http\Controllers\Monitor\DnsController;
use App\Http\Controllers\Monitor\PortMonitorController;
use App\Http\Controllers\Monitor\SslCheckController;

use App\Http\Controllers\StatusPage\StatusPageController;
use App\Http\Controllers\StatusPage\PublicStatusPageController;

use App\Http\Controllers\Cashfree\CashFreePaymentController;
use App\Http\Controllers\Cashfree\CashfreeResponseController;

use App\Http\Controllers\Incident\IncidentController;

use App\Http\Controllers\Maintenance\MaintenanceController;

use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\PlanSubscriptionController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;


use App\Http\Controllers\TestWebPushNotificationController;

// Route::get('/test-notification', [TestWebPushNotificationController::class, 'sendTestNotification']);


// Route::match(['post'], '/cashfree/response', function (Request $request) {
//     return view('cashfree', ['data' => $request->all()]);
// })->name('cashfree.response');
Route::post('/payment/thank-you', [CashfreeResponseController::class, 'handleResponse'])
     ->name('payment.thank-you');

// Route::post('/cashfree/response', [CashfreeResponseController::class, 'handleResponse'])->name('cashfree.response');
Route::post('/cashfree/webhook', [CashfreeResponseController::class ,'handleWebhook'])->name('cashfree.webhook');

Route::post('/feedbear',[FeedBackController::class, 'FeedBearResponse'])->name('feedback');

Route::match(['get', 'post'], '/plan-subscription', [PlanSubscriptionController::class, 'planSubscription'])->name('planSubscription');


Route::get('/Product_documentation', function () {
    return view('pages.CheckMySiteDocumentation');
})->name('product.documentation')->middleware('blockIp');


Route::get('/status', [StatusPageController::class, 'index'])->middleware('role:user|subuser')->middleware('permission:see.statuspage')->middleware('blockIp')->name('status');

Route::get('/status-page/{hash}', [PublicStatusPageController::class, 'show'])->middleware('blockIp')
    ->name('public.status');
Route::prefix('user')->group(function () {
    Route::get('/status-settings', [UserController::class, 'statusPageSettings'])
        ->name('user.status-settings');
    Route::post('/status-settings', [UserController::class, 'updateStatusPageSettings'])
        ->name('user.status-settings.update');
});

Route::middleware(['auth', 'blockIp'])->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

Route::get('/', function () {
    $plans = Subscriptions::all();
    return view('welcome', compact('plans'));
})->middleware('blockIp','log.traffic');

Route::get('latestUpdates', function () {
    return view('pages.latestUpdates');
})->name('latest.page')->middleware('blockIp');

Route::get('documentation', function () {
    $plans = Subscriptions::all();
    return view('pages.documentation', compact('plans'));
})->middleware('blockIp')->name('documentation.page');


// email verify and register route
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification Email Sent.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// end



Route::get('/changelog', [ChangelogController::class, 'ChangelogPage'])->middleware('blockIp');


Route::middleware(['auth', 'verified', 'CheckUserSession', 'blockIp'])->group(function () {


    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->middleware('role:user')->name('profile.destroy');
    });
    
    Route::controller(UserSubscriptionController::class)->group(function () {
        Route::get('/user/subscription', 'DisplayUserSubscription')->name('userSubscription');
        Route::get('/user-subscriptions/{cashfree_subscription_id}', 'DetailUserSubscription')->name('admin.userSubscriptions.show');

    });

    Route::get('/dashboard', [MonitoringController::class, 'MonitoringDashboard'])->middleware('role:user|subuser|admin')->middleware('permission:see.monitors')->name('monitoring.dashboard');
    Route::get('/monitoring/dashboard/update', [MonitoringController::class, 'MonitoringDashboardUpdate'])->name('monitoring.dashboard.update');
    Route::get('/monitoring/add', [MonitoringController::class, 'AddMonitoring'])->middleware('monitor.limit')->middleware('permission:add.monitor')->name('add.monitoring');
    Route::get('/monitoring/display/{id}/{type}', [MonitoringController::class, 'MonitoringDisplay'])->middleware('monitor.access')->middleware('permission:see.monitor.details')->name('display.monitoring');
    Route::get('/monitoring/chart/update/{id}/{type}', [MonitoringController::class, 'MonitoringChartUpdate'])->name('display.chart.update');

    // for delete and edit monitoring
    Route::get('/monitoring/delete/{id}', [MonitoringController::class, 'MonitorDelete'])->middleware('permission:delete.monitor')->name('monitoring.delete');
    Route::post('/monitoring/edit/{id}', [MonitoringController::class, 'MonitorEdit'])->middleware('permission:edit.monitor')->name('monitoring.update');
    Route::post('/monitor/pause/{id}', [MonitoringController::class, 'pauseMonitor'])->name('monitor.pause');

    Route::get('/dashboard/{id}', [TrackingController::class, 'NotificationTracker']);

    Route::patch('/user/update/billing', [UserController::class, 'UpdateBillingInfo'])->name('update.billing.info');

    Route::get('/feedback', [FeedBackController::class, 'showFeatureRequests'])->name('display.feedback');
});

Route::middleware(['auth', 'verified', 'CheckUserSession', 'blockIp'])->group(function () {

    Route::get('/ssl-check', [SslCheckController::class, 'index'])->name('ssl.check');
    Route::get('/ssl/history', [SslCheckController::class, 'history'])->name('ssl.history');
    Route::post('/ssl-check', [SslCheckController::class, 'check'])->name('ssl.check.domain');

    Route::get('/incidents', [IncidentController::class, 'incidents'])->middleware('role:user|subuser')->middleware('permission:see.incidents')->name('incidents');
    Route::get('/incidents/fetch', [IncidentController::class, 'fetchIncidents'])->name('incidents.fetch'); 
    // Route::get('/plan-subscription', [PlanSubscriptionController::class, 'planSubscription'])->name('planSubscription');
    // Route::match(['get', 'post'], '/plan-subscription', [PlanSubscriptionController::class, 'planSubscription'])->name('planSubscription');

    Route::post('/dns-check', [DnsController::class, 'checkDnsRecords']);
    Route::post('/add/dns', [DnsController::class, 'AddDNS'])->name('add.dns');
    Route::post('/monitoring/ping', [PingMonitoringController::class, 'store'])->name('ping.monitoring.store');


    // for port 
    Route::post('/monitor/port', [PortMonitorController::class, 'PortStore'])->name('monitor.port');
    Route::post('/monitoring/http', [HttpMonitoringController::class, 'store'])->name('monitoring.http.store');

    Route::post('/subscriptions/{subscription_id}/cancel', [CashFreePaymentController::class, 'cancelSubscription'])->name('subscriptions.cancel');
    Route::get('cashfree/payments/create', [CashFreePaymentController::class, 'create'])->name('callback');
    Route::post('cashfree/payments/store', [CashFreePaymentController::class, 'store'])->name('store');
    Route::any('cashfree/payments/success', [CashFreePaymentController::class, 'success'])->name('success');
    Route::any('cashfree/payments/webhook', [CashFreePaymentController::class, 'webhook'])->name('webhook');
    Route::any('cashfree/payments/status', [CashFreePaymentController::class, 'status'])->name('payment.status');

   

    Route::controller(CashfreeResponseController::class)->group(function(){
        Route::get('/test-download', 'testDownload');
    });
    // Routes for applying/removing coupons 
    Route::controller(CouponController::class)->group(function () {
        Route::post('/apply-coupon', 'apply');
        Route::post('/remove-coupon', 'remove')->name('coupon.remove');
        Route::get('/coupon/users/search', 'UserSearch')->name('coupon.users.search');
    });

    // Routes for Super Admin (with manage.coupons permission)
    Route::middleware('permission:manage.coupons')->controller(CouponController::class)->group(function () {
        Route::get('/coupons', 'DisplayCoupons')->name('display.coupons');
        Route::post('/coupons', 'CouponStore')->name('coupons.store');
        Route::put('/coupons/{id}', 'CouponUpdate')->name('coupons.update');
        Route::delete('/coupons/{id}', 'destroy')->name('coupons.destroy');
        Route::get('/claimed-users/{coupon_id}', 'showClaimedUsers')->name('view.claimed.users');
    });
  
    Route::get('premium', [PremiumPageController::class, 'PremiumPage'])->middleware('premium_middleware')->middleware('role:user')->name('premium.page');


    Route::get('/user-invoices', [InvoicesController::class, 'DisplayUserInvoices'])->name('userInvoices');

    Route::controller(MaintenanceController::class)->group(function () {
        Route::get('/maintenance', 'DisplayMaintenance')->name('display.maintenance');
        Route::post('/maintenance/start', 'startMaintenance')->name('maintenance.start');
        Route::post('/maintenance/stop', 'stopMaintenance')->name('maintenance.stop');
    });

    // Test route to trigger PropertyTypeAdded event
    Route::get('/test-broadcast', function () {
        event(new AdminNotification([
            'title' => 'Test Property Type',
            'description' => 'This is a test broadcast!'
        ]));
        return 'Broadcast event triggered!';
    });
});



Route::group(['middleware' => ['auth', 'blockIp']], function () {
    // Routes accessible only by superadmin
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->middleware('role:superadmin')->name('admin.dashboard');
    Route::get('/admin/display/users', action: [UserController::class, 'DisplayCustomers'])->middleware('permission:see.users')->name('display.users');
    Route::get('/admin/display/roles', action: [RoleController::class, 'DisplayRoles'])->middleware('permission:see.roles')->name('display.roles');
    Route::get('/admin/display/permissions', [PermissionController::class, 'DisplayPermissions'])->middleware('role:superadmin')->name('display.permissions');
    Route::get('/admin/display/user/{id}', action: [UserController::class, 'ShowUser'])->middleware('permission:see.users')->name('show.user');


    // Route::get('/admin/users', [AdminController::class, 'AddUser'])->name('add.user.form');
    Route::post('/admin/add/users', [UserController::class, 'storeUser'])->middleware('permission:add.user')->name('add.user');
    Route::get('/admin/edit/user/{id}', [UserController::class, 'EditUsers'])->middleware('permission:edit.user')->name('edit.user');
    Route::put('/admin/edit/user/{id}', [UserController::class, 'UpdateUsers'])->middleware('permission:edit.user')->name('update.user');
    Route::put('/admin/edit/userStatus/{id}', [UserController::class, 'UpdateStatusUsers'])->middleware('permission:edit.user')->name('update.status.user');
    Route::delete('/admin/delete/user/{id}', [UserController::class, 'DeleteUser'])->middleware('permission:delete.user')->name('delete.user');
    Route::post('/admin/restore/user/{id}', [UserController::class, 'RestoreUser'])->name('restore.user');

    Route::get('/admin/add/roles', [RoleController::class, 'AddRole'])->middleware(middleware: 'permission:add.role')->name('add.role');
    Route::post('/roles', [RoleController::class, 'StoreRole'])->middleware('permission:add.role')->name('store.role');

    Route::delete('/admin/delete/role/{id}', [RoleController::class, 'DeleteRole'])->middleware('permission:delete.role')->name('delete.role');
    Route::get('/admin/edit/role/{id}', [RoleController::class, 'EditRole'])->middleware('permission:edit.role')->name('edit.role');
    Route::put('/admin/update/role/{id}', [RoleController::class, 'UpdateRole'])->middleware('permission:edit.role')->name('update.role');


    Route::get('admin/add/permission', [PermissionController::class, 'AddPermission'])->middleware('role:superadmin')->name('add.permission');
    Route::post('admin/store/permission', [PermissionController::class, 'StorePermission'])->middleware('role:superadmin')->name('store.permission');

    Route::get('/admin/delete/permission/{id}', [PermissionController::class, 'DeletePermission'])->middleware('role:superadmin')->name('delete.permission');
    Route::get('/admin/display/activity', [ActivityController::class, 'DisplayActivity'])
        ->middleware('permission:see.activity')
        ->name('display.activity');

    Route::get('/activity/users/search', [ActivityController::class, 'UserSearch'])->name('activity.users.search');
    Route::get('/activities/users-by-ip', [ActivityController::class, 'usersByIp']);



    // Add the AJAX route for fetching activity logs
    Route::get('/activity-logs/ajax', [ActivityController::class, 'fetchActivityLogs'])
        ->middleware('permission:see.activity')
        ->name('activity.logs.ajax');

    Route::get('/admin/edit/permissions/{id}', [PermissionController::class, 'EditPermission'])->middleware('role:superadmin')->name('edit.permission');
    Route::put('/admin/update/permissions/{id}', [PermissionController::class, 'UpdatePermission'])->middleware('role:superadmin')->name('update.permission');

    Route::get('/roles/{id}/permissions', [RolePermissionController::class, 'EditRolePermissions'])->middleware('permission:edit.role.permissions')->name('edit.role.permissions');
    Route::post('/roles/{id}/permissions', [RolePermissionController::class, 'UpdateRolePermissions'])->middleware('permission:edit.role.permissions')->name('update.role.permissions');


    Route::middleware('role:superadmin')->controller(BillingController::class)->group(function () {
        Route::get('/billing', 'Billing')->name('billing');
        Route::post('/edit/billing/{id}', 'EditBilling')->name('edit.billing');
        Route::post('/add/billing', 'AddBilling')->name('add.billing');
        Route::delete('/billing/{id}', 'destroy')->name('subscription.destroy');
        Route::post('/toggle-active/{id}', 'ToggleActive')->name('toggle.active');

        Route::get('subscriptions/{subscription}/edit',  'EditFeature')->name('admin.features.edit');
        Route::put('subscriptions/{subscription}', 'UpdateFeature')->name('admin.features.update');
    });
    

    Route::get('/display/tickets', [TicketController::class, 'ViewTicketsUser'])->name('display.tickets');
    Route::get('/raise/tickets', [TicketController::class, 'RaiseTicketsPage'])->name('raise.tickets');
    Route::post('/store/tickets', [TicketController::class, 'StoreTicket'])->name('store.tickets');

    Route::get('/admin/tickets', [TicketController::class, 'TicketsView'])->middleware('role:superadmin')->name('tickets');
    Route::get('/display/tickets/{id}', [TicketController::class, 'ShowTicket'])->name('display.tickets.show');
    Route::put('/display/tickets/{id}', [TicketController::class, 'UpdateTicket'])->name('tickets.update');
    Route::post('/admin/comments', [TicketController::class, 'CommentStore'])->name('admin.comments.store');
    Route::get('/tickets/comments/update/{id}', [TicketController::class, 'CommentPageUpdate'])->name('tickets.comments.update');
    Route::post('/delete/comment/{id}', [TicketController::class, 'DeleteComment'])->name('delete.comment');

    Route::get('/display/subsusers', [UserController::class, 'DisplaySubUsers'])->name('display.sub.users');

    Route::post('/add/subsusers', [UserController::class, 'StoreSubUser'])->middleware('premium_middleware')->name('add.sub.user');
    Route::delete('/delete/subsuser/${id}', [UserController::class, 'DeleteSubUser'])->middleware('premium_middleware')->name('delete.sub.user');

    Route::delete('/completely/delete/user/${id}', [UserController::class, 'CompletelyDeleteUser'])->middleware('premium_middleware')->name('completely.delete.user');



    Route::get('/sub-user/{id}/edit-permissions', [UserController::class, 'EditSubUserPermissions'])->name('edit.sub.user.permissions');
    Route::post('/sub-user/{id}/update-permissions', [UserController::class, 'UpdateSubUserPermissions'])->name('update.sub.user.permissions');

    Route::post('add/changelog', [ChangelogController::class, 'AddChangelog'])->name('add.changelog');
    Route::delete('/changelog/{id}', [ChangelogController::class, 'destroy'])->name('changelog.destroy');
    Route::put('/changelogs/{changelog}', [ChangelogController::class, 'update'])->name('changelog.update');

    Route::get('/admin/trafficLog', [TrafficLogController::class, 'TrafficLogView'])->middleware('role:superadmin')->name('display.trafficLog');


    Route::get('/changelog', [ChangelogController::class, 'ChangelogPage'])->name('changelog.page');

    Route::post('block/ip/${ip}', [BlockController::class, 'BlockIP'])->name('block.ip');
    Route::post('unblock/ip/${ip}', [BlockController::class, 'UnblockIP'])->name('unblock.ip');


    //WHATSAPP ROUTES
    Route::get('/admin/whatsapp-login', [AdminWhatsAppController::class, 'AdminWhatsappLogin'])->name('admin.whatsapp.login');
    Route::get('/admin/fetch-qr', [AdminWhatsAppController::class, 'fetchQr'])->name('admin.whatsapp.fetchQr');
    Route::post('/admin/whatsapp/trigger-login', [AdminWhatsAppController::class, 'triggerLogin'])->name('admin.whatsapp.triggerLogin');
    Route::post('/admin/whatsapp/disconnect', [AdminWhatsAppController::class, 'disconnectWhatsApp'])->name('admin.whatsapp.disconnect');
    Route::post('/admin/whatsapp/retry', [AdminWhatsAppController::class, 'retryWhatsApp'])->name('admin.whatsapp.retry');

    // Template Routes
    Route::get('/admin/edit/template', [EditTemplateController::class, 'EditTemplatePage'])->name('edit.template.page');
    Route::post('/templates/store', [EditTemplateController::class, 'store'])->name('templates.store');
    Route::get('/admin/whatsapp/profile-image', [AdminWhatsappController::class, 'serveProfileImage'])->name('admin.whatsapp.profileImage');

    Route::get('/admin/send-notification', [AppNotificationController::class, 'ViewAppNotification'])->name('notification.page')->middleware('role:superadmin');
    Route::post('/admin/app-notification', [AppNotificationController::class, 'sendNotificationToUsers'])->name('admin.send.notification')->middleware('role:superadmin');

    Route::post('/admin/notifications/mark-read', [AppNotificationController::class, 'markNotificationsAsRead'])->name('admin.notifications.mark-read');
});


Route::post('/subscribe', [PushNotificationController::class, 'subscribe']);


Route::get('/track/{token}.png', [TrackingController::class, 'pixel'])->withoutMiddleware(['web', 'verified', 'auth', \App\Http\Middleware\VerifyCsrfToken::class]);


require __DIR__ . '/auth.php';
