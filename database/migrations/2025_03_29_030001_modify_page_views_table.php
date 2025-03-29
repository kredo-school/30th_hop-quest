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
        Schema::table('page_views', function (Blueprint $table) {
            $table->dropColumn(['page_id', 'page_type']);
            
            $table->morphs('page'); // page_id, page_type
            $table->integer('views')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_views', function (Blueprint $table) {
            $table->dropMorphs('page');
            
            $table->integer('page_id');
            $table->integer('page_type');

            $table->integer('views')->change();
        });
    }
};
