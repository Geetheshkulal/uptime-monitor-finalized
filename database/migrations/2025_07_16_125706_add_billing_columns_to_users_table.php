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
        Schema::table('users', function (Blueprint $table) {
            if(Schema::hasColumn('users', 'address')) {
                $table->dropColumn('address');
            }

            if(Schema::hasColumn('users', 'city')) {
                $table->dropColumn('city');
            }

            // Add new billing columns
            $table->string('address_1')->nullable()->after('enable_public_status');
            $table->string('address_2')->nullable()->after('address_1');
            $table->string('place')->nullable()->after('address_2');
            $table->string('district')->nullable()->before('state');
            $table->string('gstin')->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Restore address column
            $table->string('address')->nullable();

            // Drop new billing columns
            $table->dropColumn(['address_1', 'address_2', 'district', 'gstin']);
        });
    }
};
