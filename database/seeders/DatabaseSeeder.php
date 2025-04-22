<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 必要なシーダークラスを呼び出し
        $this->call([
            // 基本カテゴリとマスターデータのシーディング
            BusinessInfoCategorySeeder::class,
            BusinessInfoSeeder::class,
            
            // ロケーションとイベントのシーディング（Business シーディング後に実行する必要あり）
            LocationSeeder::class,
            EventSeeder::class,
            
            // ビジネス詳細情報のシーディング（Business シーディング後に実行する必要あり）
            BusinessDetailSeeder::class,
            
            // 他のシーダーがあれば追加
        ]);
    }
}