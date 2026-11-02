<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //namespace App\Models;

    protected $fillable = ['title', 'course_code', 'credits'];

    // Relationship: Course has many students (Many-to-Many)
    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student');
    }
}

