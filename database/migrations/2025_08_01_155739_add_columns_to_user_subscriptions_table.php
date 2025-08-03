<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->string('plan_name')->nullable()->after('subscription_id');
            $table->decimal('authorization_amount', 10, 2)->nullable()->after('plan_name');
            $table->string('plan_type')->nullable()->after('authorization_amount');
            $table->decimal('plan_recurring_amount', 10, 2)->nullable()->after('plan_type');
            $table->decimal('plan_max_amount', 10, 2)->nullable()->after('plan_recurring_amount');
            $table->string('plan_interval_type')->nullable()->after('plan_max_amount');
            $table->string('cashfree_subscription_id')->nullable()->after('plan_interval_type');
        });
    }

    public function down()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropColumn([
                'authorization_amount',
                'plan_name',
                'plan_type',
                'plan_recurring_amount',
                'plan_max_amount',
                'plan_interval_type',
                'cashfree_subscription_id'
            ]);
        });
    }
};
