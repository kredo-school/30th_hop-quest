<?php

namespace Database\Seeders;

use App\Models\BusinessInfo;
use Illuminate\Database\Seeder;

class BusinessInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $infoItems = [
            // accessibility (category_id = 1)
            ['id' => 1, 'business_info_category_id' => 1, 'name' => 'wheelchair'],
            ['id' => 2, 'business_info_category_id' => 1, 'name' => 'elevator access'],
            ['id' => 3, 'business_info_category_id' => 1, 'name' => 'accessible parking'],
            ['id' => 4, 'business_info_category_id' => 1, 'name' => 'braille signage'],
            ['id' => 5, 'business_info_category_id' => 1, 'name' => 'hearing loop system'],
            
            // facilities (category_id = 2)
            ['id' => 6, 'business_info_category_id' => 2, 'name' => 'free wifi'],
            ['id' => 7, 'business_info_category_id' => 2, 'name' => 'public restroom'],
            ['id' => 8, 'business_info_category_id' => 2, 'name' => 'parking available'],
            ['id' => 9, 'business_info_category_id' => 2, 'name' => 'bicycle parking'],
            ['id' => 10, 'business_info_category_id' => 2, 'name' => 'changing room'],
            ['id' => 11, 'business_info_category_id' => 2, 'name' => 'shower facilities'],
            
            // payment option (category_id = 3)
            ['id' => 12, 'business_info_category_id' => 3, 'name' => 'credit card accepted'],
            ['id' => 13, 'business_info_category_id' => 3, 'name' => 'digital payment'],
            ['id' => 14, 'business_info_category_id' => 3, 'name' => 'cash only'],
            ['id' => 15, 'business_info_category_id' => 3, 'name' => 'cash payment accepted'],
            ['id' => 16, 'business_info_category_id' => 3, 'name' => 'internation payment card'],
            ['id' => 17, 'business_info_category_id' => 3, 'name' => 'contactless payment'],
            
            // smoking policy (category_id = 4)
            ['id' => 18, 'business_info_category_id' => 4, 'name' => 'completely non-smoking'],
            ['id' => 19, 'business_info_category_id' => 4, 'name' => 'smoking area available'],
            ['id' => 20, 'business_info_category_id' => 4, 'name' => 'designated smoking section'],
            ['id' => 21, 'business_info_category_id' => 4, 'name' => 'outdoor smoking section'],
            ['id' => 22, 'business_info_category_id' => 4, 'name' => 'smoking permited throughout'],
        ];

        foreach ($infoItems as $item) {
            BusinessInfo::create($item);
        }
    }
}