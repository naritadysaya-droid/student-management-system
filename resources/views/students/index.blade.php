<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Animated gradient background */
        .animated-bg {
            background: linear-gradient(-45deg, #4f46e5, #2563eb, #7c3aed, #0ea5e9);
            background-size: 400% 400%;
            animation: gradientShift 14s ease infinite;
        }
        @keyframes gradientShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .card-enter {
            animation: cardEnter 0.8s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        @keyframes cardEnter {
            from { opacity: 0; transform: translateY(40px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .fade-item {
            opacity: 0;
            animation: fadeItem 0.6s ease forwards;
        }
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.35s; }
        .delay-3 { animation-delay: 0.5s; }
        @keyframes fadeItem {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .row-enter {
            opacity: 0;
            animation: rowEnter 0.5s ease forwards;
        }
        @keyframes rowEnter {
            from { opacity: 0; transform: translateX(-20px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .float-icon {
            animation: floatIcon 3s ease-in-out infinite;
        }
        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-5px); }
        }

        .blob {
            position: fixed;
            border-radius: 9999px;
            filter: blur(60px);
            opacity: 0.35;
            pointer-events: none;
            animation: blobMove 12s ease-in-out infinite;
        }
        @keyframes blobMove {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%      { transform: translate(40px, -30px) scale(1.15); }
        }

        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::after {
            content: "";
            position: absolute;
            top: 0; left: -75%;
            width: 50%; height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.45), transparent);
            transform: skewX(-20deg);
        }
        .btn-shine:hover::after {
            animation: shine 0.9s ease;
        }
        @keyframes shine {
            to { left: 130%; }
        }
    </style>
</head>
<body class="animated-bg min-h-screen p-4 md:p-8 relative">

    <!-- Background blobs -->
    <div class="blob bg-pink-400 w-72 h-72 -top-10 -left-10"></div>
    <div class="blob bg-cyan-300 w-80 h-80 bottom-0 right-0" style="animation-delay: 3s;"></div>

    <div class="card-enter relative max-w-6xl mx-auto bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-2xl">

        <!-- Header -->
        <div class="flex flex-wrap justify-between items-center gap-3 mb-6">
            <div class="flex items-center gap-3">
                <div class="float-icon w-12 h-12 rounded-full bg-gradient-to-br from-blue-600 to-indigo-700 text-white flex items-center justify-center text-xl shadow-lg">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Student Management System</h2>
            </div>
            <a href="{{ route('students.create') }}"
               class="btn-shine bg-gradient-to-r from-green-500 to-teal-600 text-white px-4 py-2 rounded-lg shadow-md
                      transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 active:scale-95">
                <i class="fa-solid fa-plus mr-1"></i> Add New Student
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="fade-item mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                <i class="fa-solid fa-circle-check mr-1"></i>{{ session('success') }}
            </div>
        @endif

        <!-- Search & Filter Form -->
        <form method="GET" action="{{ route('students.index') }}" class="fade-item delay-1 mb-6 flex flex-wrap gap-3">
            <div class="relative w-full md:w-1/3">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search student name..."
                       class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 bg-white transition-all duration-300
                              focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:shadow-lg">
            </div>

            <select name="dept_id"
                    class="w-full md:w-1/4 border border-gray-300 rounded-lg px-4 py-2 bg-white transition-all duration-300
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:shadow-lg">
                <option value="">All Departments</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->dept_id }}" {{ request('dept_id') == $dept->dept_id ? 'selected' : '' }}>
                        {{ $dept->dept_name }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                    class="btn-shine bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-4 py-2 rounded-lg shadow-md
                           transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 active:scale-95">
                <i class="fa-solid fa-filter mr-1"></i> Filter
            </button>

            <a href="{{ route('students.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded-lg flex items-center shadow-md
                      transition-all duration-300 hover:bg-gray-600 hover:-translate-y-0.5 active:scale-95">
                <i class="fa-solid fa-rotate-left mr-1"></i> Reset
            </a>
        </form>

        <!-- HTML Table -->
        <div class="fade-item delay-2 overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white text-sm">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Student Name</th>
                        <th class="py-3 px-4">Gender</th>
                        <th class="py-3 px-4">DOB</th>
                        <th class="py-3 px-4">Department Name</th>
                        <th class="py-3 px-4">Enrollment Date</th>
                        <th class="py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr class="row-enter border-b border-gray-100 text-center text-sm
                                   transition-colors duration-200 hover:bg-indigo-50"
                            style="animation-delay: {{ $loop->index * 60 }}ms;">
                            <td class="py-3 px-4 text-gray-500">{{ $student->student_id }}</td>
                            <td class="py-3 px-4 font-medium text-gray-800">{{ $student->student_name }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ strtolower($student->gender) === 'female' ? 'bg-pink-100 text-pink-700' : (strtolower($student->gender) === 'male' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                    {{ $student->gender }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-gray-600">{{ $student->dob }}</td>
                            <!-- Relational Department Name -->
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                                    {{ $student->department->dept_name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-gray-600">{{ $student->enrollment_date }}</td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('students.edit', $student->student_id) }}"
                                       class="px-3 py-1 rounded-md bg-yellow-100 text-yellow-700 font-semibold
                                              transition-all duration-200 hover:bg-yellow-500 hover:text-white hover:-translate-y-0.5">
                                        <i class="fa-solid fa-pen-to-square mr-1"></i>Edit
                                    </a>

                                    <!-- Delete: goes to the confirmation page (students/delete.blade.php) -->
                                    <a href="{{ route('students.delete', $student->student_id) }}"
                                       class="px-3 py-1 rounded-md bg-red-100 text-red-700 font-semibold
                                              transition-all duration-200 hover:bg-red-600 hover:text-white hover:-translate-y-0.5">
                                        <i class="fa-solid fa-trash mr-1"></i>Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-500">
                                <i class="fa-solid fa-user-slash text-3xl mb-2 block text-gray-300"></i>
                                No student records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Log Out Button (bottom right) -->
        <div class="fade-item delay-3 flex justify-end mt-4">
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Are you sure you want to log out?');">
                @csrf
                <button type="submit"
                        class="btn-shine bg-gradient-to-r from-red-500 to-rose-600 text-white px-4 py-2 rounded-lg shadow-md
                               transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 active:scale-95">
                    <i class="fa-solid fa-right-from-bracket mr-1"></i> Log Out
                </button>
            </form>
        </div>
    </div>

</body>
</html>