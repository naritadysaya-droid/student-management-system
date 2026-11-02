<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Department</h2>
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Department Name</label>
                <input type="text" name="dept_name" required class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Manager ID</label>
                <input type="text" name="manager_id" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Location ID / Room</label>
                <input type="text" name="location_id" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="flex justify-between items-center">
                <a href="{{ route('departments.index') }}" class="text-gray-600 hover:underline">Cancel</a>
                <button type="submit" class="bg-green-600 text-white py-2 px-6 rounded-lg hover:bg-green-700">Save</button>
            </div>
        </form>
    </div>
</body>
</html>