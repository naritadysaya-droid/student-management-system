<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create([
            'student_name' => 'Sambath Nita',
            'gender' => 'Female',
            'dob' => '2003-05-15',
            'enrollment' => 'ENR-2026-001',
            'enrollment_date' => '2026-01-10',
            'description' => 'MIS Student Leader',
            'dept_id' => 1 // References Information Technology department
        ]);
    }
}