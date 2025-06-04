<?php

namespace Database\Seeders;

use App\Models\StudentProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentProfile::insert([
            [
                'user_id' => 3, // student1
                'student_type_id' => 1, // lentera_course
                'phone' => '081234567890',
                'address' => 'Jl. Mawar No.1',
                'school_name' => 'SMA 1',
                'school_address' => 'Jl. Melati No.2',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_id' => 4, // student2
                'student_type_id' => 2, // lentera_academy
                'phone' => '081234567891',
                'address' => 'Jl. Kenanga No.3',
                'school_name' => 'SMA 2',
                'school_address' => 'Jl. Anggrek No.4',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_id' => 5, // student3
                'student_type_id' => 1, // lentera_course
                'phone' => '081234567892',
                'address' => 'Jl. Dahlia No.5',
                'school_name' => 'SMA 3',
                'school_address' => 'Jl. Kamboja No.6',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
