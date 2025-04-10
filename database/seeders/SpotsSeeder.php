<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SpotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('spots')->insert([
            'title' => 'Test Spot',
            'main_image' => 'test.jpg',
            'address' => 'Test Address',
            'introduction' => 'Test Introduction',
            'geo_location' => 'Test Geo Location',
            'geo_lat' => 35.681236,
            'geo_lng' => 139.767125,
            'images' => 'test.jpg',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
