<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('quests_bodys', function (Blueprint $table) {
            $table->unsignedBigInteger('spot_id')->nullable()->change();
            $table->unsignedBigInteger('business_id')->nullable()->change();
            $table->string('business_title', 255)->change();
            $table->boolean('is_agenda')->default(true)->change();
        });
    }

    public function down()
    {
        Schema::table('quests_bodys', function (Blueprint $table) {
            $table->unsignedBigInteger('spot_id')->change();
            $table->unsignedBigInteger('business_id')->change();
            $table->text('business_title')->change();
            $table->integer('is_agenda')->change();
        });
    }
};

