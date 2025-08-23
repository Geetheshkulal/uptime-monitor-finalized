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
        Schema::table('push_subscriptions', function (Blueprint $table) {
            $table->string('content_encoding')->nullable()->after('auth');
        });
    }
    
    public function down()
    {
        Schema::table('push_subscriptions', function (Blueprint $table) {
            $table->dropColumn('content_encoding');
        });
    }
};
