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
            $table->text('business_title')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('quests_bodys', function (Blueprint $table) {
            $table->unsignedBigInteger('spot_id')->nullable(false)->change();
            $table->unsignedBigInteger('business_id')->nullable(false)->change();
            $table->text('business_title')->nullable(false)->change();
        });
    }
};

