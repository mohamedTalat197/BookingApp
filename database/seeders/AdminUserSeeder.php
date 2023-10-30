<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Administrator',
        //     'email' => 'superadmin@booking.com',
        //     'password' => bcrypt('SuperSecretPassword'),
        //     'email_verified_at' => now(),
        //     'role_id' => 1, // Administrator
        //     ]);
    }
}
