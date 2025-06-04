<?php

namespace Database\Seeders;

use App\Models\StudentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentType::insert([
            [
                'name' => 'lentera_course',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => 'lentera_academy',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
