<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // 1. List all students & departments on the HTML table with optional search/filter
    public function index(Request $request)
    {
        $query = Student::with('department');

        // Search by student name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('student_name', 'like', "%{$search}%");
        }

        // Filter by department
        if ($request->filled('dept_id')) {
            $query->where('dept_id', $request->input('dept_id'));
        }

        $students = $query->get();
        $departments = Department::all();

        return view('students.index', compact('students', 'departments'));
    }

    // 2. Show the form to create a new student
    public function create()
    {
        $departments = Department::all();
        return view('students.create', compact('departments'));
    }

    // 3. Store a newly created student in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name'    => 'required|string|max:255',
            'gender'          => 'required|string',
            'dob'             => 'required|date',
            'enrollment'      => 'nullable|string',
            'enrollment_date' => 'nullable|date',
            'description'     => 'nullable|string',
            'dept_id'         => 'required|exists:departments,dept_id',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    // 4. Show the form for editing an existing student
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $departments = Department::all();
        return view('students.edit', compact('student', 'departments'));
    }

    // 5. Update the student in the database
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'student_name'    => 'required|string|max:255',
            'gender'          => 'required|string',
            'dob'             => 'required|date',
            'enrollment'      => 'nullable|string',
            'enrollment_date' => 'nullable|date',
            'description'     => 'nullable|string',
            'dept_id'         => 'required|exists:departments,dept_id',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // 6. Show the delete confirmation page (students/delete.blade.php)
    public function confirmDelete($id)
    {
        $student = Student::with('department')->findOrFail($id);

        return view('students.delete', compact('student'));
    }

    // 7. Delete a student from the database
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}