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
        Schema::table('users', function (Blueprint $table) {
            // 各カラムが存在するかどうかを確認してから追加
            if (!Schema::hasColumn('users', 'zip')) {
                $table->text('zip')->nullable()->after('website_url');
            }
            
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable()->after('zip');
            }
            
            if (!Schema::hasColumn('users', 'phonenumber')) {
                $table->string('phonenumber')->nullable()->after('address');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 各カラムが存在する場合のみ削除
            if (Schema::hasColumn('users', 'zip')) {
                $table->dropColumn('zip');
            }
            
            if (Schema::hasColumn('users', 'address')) {
                $table->dropColumn('address');
            }
            
            if (Schema::hasColumn('users', 'phonenumber')) {
                $table->dropColumn('phonenumber');
            }
        });
    }
};