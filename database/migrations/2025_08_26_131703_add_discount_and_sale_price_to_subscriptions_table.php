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
            $table->decimal('percentage_discount', 5, 2)->nullable()->after('amount'); // e.g. 10.50%
            $table->decimal('sale_price', 10, 2)->nullable()->after('percentage_discount'); // e.g. 9999.99
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn(['percentage_discount', 'sale_price']);
        });
    }
};
