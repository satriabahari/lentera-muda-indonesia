<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        // 3 Students
        User::insert([
            [
                'name' => 'Student One',
                'email' => 'student1@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 3,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => 'Student Two',
                'email' => 'student2@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 3,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => 'Student Three',
                'email' => 'student3@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 3,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
