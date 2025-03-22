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
        Schema::create('quests_bodys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quest_id');
            $table->unsignedBigInteger('spot_id');      
            $table->unsignedBigInteger('business_id');
            $table->text('introduction');
            $table->text('business_title');
            $table->integer('is_agenda');
            $table->text('photo');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('quest_id')->references('id')->on('quests');
            $table->foreign('spot_id')->references('id')->on('spots');
            $table->foreign('business_id')->references('id')->on('businesses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quests_bodys');
    }
};
