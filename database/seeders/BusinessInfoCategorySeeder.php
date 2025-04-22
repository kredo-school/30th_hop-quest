<?php

namespace Database\Seeders;

use App\Models\BusinessInfoCategory;
use Illuminate\Database\Seeder;

class BusinessInfoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'accessibility'],
            ['id' => 2, 'name' => 'facilities'],
            ['id' => 3, 'name' => 'payment option'],
            ['id' => 4, 'name' => 'smoking policy'],
        ];

        foreach ($categories as $category) {
            BusinessInfoCategory::create($category);
        }
    }
}