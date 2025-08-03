<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dateTime('next_schedule_date')->nullable()->after('status');
            $table->string('payment_group')->nullable()->after('next_schedule_date');
            $table->json('payment_method')->nullable()->after('payment_group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            Schema::table('user_subscriptions', function (Blueprint $table) {
                $table->dropColumn([
                    'next_schedule_date',
                    'payment_method',
                    'payment_group'
                ]);
            });
        });
    }
};
