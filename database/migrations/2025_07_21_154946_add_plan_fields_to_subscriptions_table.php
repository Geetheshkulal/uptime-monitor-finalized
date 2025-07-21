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
            $table->string('slug')->unique()->after('amount');
            $table->text('description')->nullable()->after('slug');
            $table->enum('billing_cycle', ['monthly', 'yearly'])->default('monthly')->after('description');
            $table->decimal('monthly_discount', 5, 2)->default(0)->after('billing_cycle'); // e.g., 20.00 = 20%
            $table->decimal('yearly_discount', 5, 2)->default(0)->after('monthly_discount');
            $table->json('features')->nullable()->after('yearly_discount');
            $table->boolean('is_active')->default(true)->after('features');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'description',
                'billing_cycle',
                'monthly_discount',
                'yearly_discount',
                'features',
                'is_active'
            ]);
        });
    }
};
