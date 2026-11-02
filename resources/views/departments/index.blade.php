<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments - Student Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Department Management</h2>
            <div class="flex gap-4">
                <a href="{{ route('students.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Manage Students</a>
                <a href="{{ route('departments.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add Department</a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="py-2 px-4 border">ID</th>
                    <th class="py-2 px-4 border">Department Name</th>
                    <th class="py-2 px-4 border">Manager ID</th>
                    <th class="py-2 px-4 border">Location</th>
                    <th class="py-2 px-4 border">Total Students</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $dept)
                    <tr class="border-b text-center">
                        <td class="py-2 px-4 border">{{ $dept->dept_id }}</td>
                        <td class="py-2 px-4 border font-medium">{{ $dept->dept_name }}</td>
                        <td class="py-2 px-4 border">{{ $dept->manager_id ?? '-' }}</td>
                        <td class="py-2 px-4 border">{{ $dept->location_id ?? '-' }}</td>
                        <td class="py-2 px-4 border">{{ $dept->students_count }}</td>
                        <td class="py-2 px-4 border flex justify-center gap-2">
                            <a href="{{ route('departments.edit', $dept->dept_id) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('departments.destroy', $dept->dept_id) }}" method="POST" onsubmit="return confirm('Delete this department?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500">No departments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>