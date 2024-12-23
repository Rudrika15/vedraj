<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'branch_id' => 1,
            'password' => bcrypt(123456),
            'address' => 'Admin home',
            'mobile_no' => '1234567890',
            'role' => 'admin',
        ]);
    }
}
