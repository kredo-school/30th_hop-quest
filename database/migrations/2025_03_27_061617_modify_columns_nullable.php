<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('quests', function (Blueprint $table) {
            $table->date('start_date')->nullable()->change();
            $table->date('end_date')->nullable()->change();
            $table->integer('duration')->nullable()->change();
            $table->boolean('is_public')->default(false)->change();
            $table->string('title', 255)->change();
            $table->string('introduction', 255)->change();
        });
    }

    public function down() {
        Schema::table('quests', function (Blueprint $table) {
            $table->text('start_date')->nullable()->change();
            $table->text('end_date')->nullable()->change();
            $table->text('duration')->nullable()->change();
            $table->text('is_public')->change();
            $table->text('title')->change();
            $table->text('introduction')->change();
        });
    }
};
