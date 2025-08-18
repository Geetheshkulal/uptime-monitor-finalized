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
        Schema::create('feedbear_posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_id');
            $table->string('board_id');
            $table->string('board_name');
            $table->string('title');
            $table->text('content');
            $table->string('author_name');
            $table->string('author_email');
            $table->string('url');
            $table->json('attachments')->nullable();
            $table->integer('upvotes_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbear_posts');
    }
};
