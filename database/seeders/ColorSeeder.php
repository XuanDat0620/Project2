<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('colors')->insertOrIgnore([
            ['color_name' => 'Đỏ'],
            ['color_name' => 'Đen'],
            ['color_name' => 'Trắng'],
            ['color_name' => 'Xanh'],
        ]);
    }
}
