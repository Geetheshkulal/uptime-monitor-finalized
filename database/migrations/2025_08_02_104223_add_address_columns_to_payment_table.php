<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressColumnsToPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment', function (Blueprint $table) {
            // Drop old address columns
            $table->dropColumn(['address', 'city']);
            
            // Add new address columns
            $table->string('address_1')->nullable()->after('updated_at');
            $table->string('address_2')->nullable()->after('address_1');
            $table->string('place')->nullable()->after('address_2');

            $table->string('district')->nullable()->after('pincode');
            $table->string('gstin', 50)->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment', function (Blueprint $table) {
            // Re-add old columns
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            
            // Drop new columns
            $table->dropColumn(['address_1', 'address_2', 'place', 'district', 'gstin']);
        });
    }
}