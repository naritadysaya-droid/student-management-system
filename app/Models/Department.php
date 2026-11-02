<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // Define custom primary key
    protected $primaryKey = 'dept_id';
    
    protected $fillable = ['dept_name', 'manager_id', 'location_id'];

    // Relationship: One department has many students
    public function students()
    {
        return $this->hasMany(Student::class, 'dept_id', 'dept_id');
    }
}