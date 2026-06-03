<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insertOrIgnore([
        ['brand_name' => 'Nike'],
        ['brand_name' => 'Adidas'],
        ['brand_name' => 'Puma'],
    ]);
    }
}
