<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->updateOrInsert(
            ['u_email' => 'admin@gmail.com'], // điều kiện check
            [
                'u_name' => 'Administrator',
                'u_phone' => '0123456789',
                'u_address' => 'Hà Nội',
                'u_password' => Hash::make('123456'),
                'u_role' => 'admin',
                'u_status' => 'active',
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        $this->call([
            BrandSeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
        ]);
    }
}
