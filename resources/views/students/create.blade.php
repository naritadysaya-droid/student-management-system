<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student - Student Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Student</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <!-- Student Name -->
            <div class="mb-4">
                <label for="student_name" class="block text-gray-700 text-sm font-semibold mb-2">Student Name</label>
                <input type="text" id="student_name" name="student_name" value="{{ old('student_name') }}" required placeholder="Enter full name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Department Dropdown (Relational) -->
            <div class="mb-4">
                <label for="dept_id" class="block text-gray-700 text-sm font-semibold mb-2">Department Name</label>
                <select id="dept_id" name="dept_id" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Select Department --</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->dept_id }}" {{ old('dept_id') == $dept->dept_id ? 'selected' : '' }}>
                            {{ $dept->dept_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label for="gender" class="block text-gray-700 text-sm font-semibold mb-2">Gender</label>
                <select id="gender" name="gender" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Date of Birth -->
            <div class="mb-4">
                <label for="dob" class="block text-gray-700 text-sm font-semibold mb-2">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="{{ old('dob') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Enrollment Code -->
            <div class="mb-4">
                <label for="enrollment" class="block text-gray-700 text-sm font-semibold mb-2">Enrollment Number</label>
                <input type="text" id="enrollment" name="enrollment" value="{{ old('enrollment') }}" placeholder="e.g. ENR-2026-002"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Enrollment Date -->
            <div class="mb-4">
                <label for="enrollment_date" class="block text-gray-700 text-sm font-semibold mb-2">Enrollment Date</label>
                <input type="date" id="enrollment_date" name="enrollment_date" value="{{ old('enrollment_date') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-gray-700 text-sm font-semibold mb-2">Description / Notes</label>
                <textarea id="description" name="description" rows="3" placeholder="Optional details..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center">
                <a href="{{ route('students.index') }}" class="text-gray-600 hover:underline">Cancel</a>
                <button type="submit" class="bg-green-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-green-700 transition duration-200">
                    Save Student
                </button>
            </div>
        </form>
    </div>

</body>
</html>