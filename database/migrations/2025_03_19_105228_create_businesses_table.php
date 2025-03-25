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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('introduction')->nullable();
            $table->integer('category_id')->default(1)->comment('1:locations 2:events');
            $table->string('status')->nullable();
            $table->date('term_start')->nullable();
            $table->date('term_end')->nullable();           
            $table->integer('business_hours')->nullable();
            $table->text('sp_notes')->nullable();
            $table->string('address')->nullable();
            $table->string('zip',10)->nullable();
            $table->string('google_api_code')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('email');
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('x')->nullable();
            $table->string('tiktok')->nullable();
            $table->integer('official_certification')->default(1)->comment('certified:1->2');
            $table->string('identification_number')->nullable();
            $table->date('display_start')->nullable();
            $table->date('display_end')->nullable();  
            $table->char('is_public');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
