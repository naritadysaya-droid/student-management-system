<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id'); // Primary Key named course_id
            $table->string('title');
            $table->string('course_code')->unique();
            $table->integer('credits');
            $table->timestamps();
        });

        // Pivot table for Student <-> Course Many-to-Many relationship
        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            // Explicitly connect to student_id on the students table
            $table->foreignId('student_id')->constrained('students', 'student_id')->onDelete('cascade');
            // Explicitly connect to course_id on the courses table
            $table->foreignId('course_id')->constrained('courses', 'course_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_student');
        Schema::dropIfExists('courses');
    }
};