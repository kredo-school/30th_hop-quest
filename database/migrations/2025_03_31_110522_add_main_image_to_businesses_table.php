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
        Schema::table('businesses', function (Blueprint $table) {
            if (!Schema::hasColumn('businesses', 'main_image')) {
                $table->longText('main_image')->nullable()->after('introduction');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            // カラムが存在する場合のみ削除
            if (Schema::hasColumn('businesses', 'main_image')) {
                $table->dropColumn('main_image');
            }
        });
    }
};