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
        Schema::create('spot_comment_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spot_comment_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('spot_comment_id')->references('id')->on('spot_comments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spot_comment_likes');
    }
};
