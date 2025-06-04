<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                "name" => "super_admin",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "admin",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "student",
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ]);
    }
}
