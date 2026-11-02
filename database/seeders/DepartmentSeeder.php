<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::create([
            'dept_name' => 'Information Technology',
            'manager_id' => 'MGR-001',
            'location_id' => 'Building A - Room 101'
        ]);

        Department::create([
            'dept_name' => 'Finance and Banking',
            'manager_id' => 'MGR-002',
            'location_id' => 'Building B - Room 202'
        ]);

        Department::create([
            'dept_name' => 'Design',
            'manager_id' => 'MGR-002',
            'location_id' => 'Building C - Room 203'
        ]);

        Department::create([
            'dept_name' => 'Marketing',
            'manager_id' => 'MGR-002',
            'location_id' => 'Building D - Room 204'
        ]);

        Department::create([
            'dept_name' => 'Networking',
            'manager_id' => 'MGR-002',
            'location_id' => 'Building E - Room 205'
        ]);
    }
}