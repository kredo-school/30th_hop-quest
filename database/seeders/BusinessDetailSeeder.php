<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\BusinessDetail;
use App\Models\BusinessInfo;
use Illuminate\Database\Seeder;

class BusinessDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // すべてのビジネスを取得
        $businesses = Business::all();
        
        // すべての情報項目を取得
        $allInfoItems = BusinessInfo::all();
        
        // カテゴリごとに情報項目をグループ化
        $infoItemsByCategory = $allInfoItems->groupBy('business_info_category_id');
        
        foreach ($businesses as $business) {
            // 各カテゴリについて
            foreach ($infoItemsByCategory as $categoryId => $infoItems) {
                // このカテゴリから1〜3の情報項目をランダムに選択
                $selectedItems = $infoItems->random(rand(1, min(3, count($infoItems))));
                
                foreach ($selectedItems as $item) {
                    BusinessDetail::create([
                        'business_id' => $business->id,
                        'business_info_id' => $item->id,
                        'is_validity' => true,
                    ]);
                }
            }
        }
    }
}