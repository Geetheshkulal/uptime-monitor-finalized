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
        Schema::table('subscriptions', function (Blueprint $table) {
            // Drop old column
            $table->dropColumn('features');
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            // Add new JSON column
            $table->json('features')->nullable()->after('plan_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('features');
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->text('features')->nullable()->after('plan_type'); // old type
        });
    }
};
