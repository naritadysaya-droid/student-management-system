<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Define custom primary key
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_name', 
        'gender', 
        'dob', 
        'enrollment', 
        'enrollment_date', 
        'description', 
        'dept_id'
    ];

    // Relationship: Student belongs to Department
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id', 'dept_id');
    }

    // Relationship: Student belongs to many courses (Many-to-Many)
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id');
    }
}