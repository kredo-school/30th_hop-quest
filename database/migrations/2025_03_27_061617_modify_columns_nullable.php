<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('quests', function (Blueprint $table) {
            $table->text('start_date')->nullable()->change();;
            $table->text('end_date')->nullable()->change();;
            $table->text('duration')->nullable()->change();;

        });
    }

    public function down()
    {
        Schema::table('quests', function (Blueprint $table) {
            $table->text('start_date')->nullable(false)->change();;
            $table->text('end_date')->nullable(false)->change();;
            $table->text('duration')->nullable(false)->change();;
        });
    }
};

