<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - Student Management System</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Dark background with slowly moving aurora colors */
        .dark-bg {
            background:
                radial-gradient(circle at 20% 20%, rgba(34, 211, 238, 0.18), transparent 45%),
                radial-gradient(circle at 80% 80%, rgba(168, 85, 247, 0.22), transparent 45%),
                linear-gradient(135deg, #0f172a, #111827 50%, #1e1b4b);
            background-size: 200% 200%, 200% 200%, 100% 100%;
            animation: auroraShift 16s ease-in-out infinite;
        }
        @keyframes auroraShift {
            0%, 100% { background-position: 0% 0%, 100% 100%, 0 0; }
            50%      { background-position: 100% 50%, 0% 50%, 0 0; }
        }

        /* Glass card with glowing border */
        .glass-card {
            background: rgba(15, 23, 42, 0.72);
            border: 1px solid rgba(148, 163, 184, 0.18);
            box-shadow: 0 0 40px rgba(34, 211, 238, 0.12), 0 25px 50px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(16px);
        }

        /* Card slides up and fades in */
        .card-enter {
            animation: cardEnter 0.8s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        @keyframes cardEnter {
            from { opacity: 0; transform: translateY(40px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Staggered fade-in for form items */
        .fade-item {
            opacity: 0;
            animation: fadeItem 0.6s ease forwards;
        }
        .d1 { animation-delay: 0.15s; }
        .d2 { animation-delay: 0.25s; }
        .d3 { animation-delay: 0.35s; }
        .d4 { animation-delay: 0.45s; }
        .d5 { animation-delay: 0.55s; }
        .d6 { animation-delay: 0.65s; }
        .d7 { animation-delay: 0.75s; }
        .d8 { animation-delay: 0.9s; }
        @keyframes fadeItem {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Floating header icon with glow */
        .float-icon {
            animation: floatIcon 3s ease-in-out infinite, glowPulse 3s ease-in-out infinite;
        }
        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-6px); }
        }
        @keyframes glowPulse {
            0%, 100% { box-shadow: 0 0 15px rgba(34, 211, 238, 0.45); }
            50%      { box-shadow: 0 0 30px rgba(168, 85, 247, 0.65); }
        }

        /* Soft floating glow orbs */
        .blob {
            position: fixed;
            border-radius: 9999px;
            filter: blur(80px);
            opacity: 0.25;
            pointer-events: none;
            animation: blobMove 12s ease-in-out infinite;
        }
        @keyframes blobMove {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%      { transform: translate(40px, -30px) scale(1.2); }
        }

        /* Dark form controls */
        .field {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(71, 85, 105, 0.8);
            color: #e2e8f0;
            color-scheme: dark;
            transition: all 0.3s ease;
        }
        .field::placeholder { color: #64748b; }
        .field:focus {
            outline: none;
            border-color: #22d3ee;
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.2), 0 0 18px rgba(34, 211, 238, 0.25);
            transform: translateY(-2px);
        }
        .field option { background: #1e293b; color: #e2e8f0; }

        /* Neon gradient button with shine */
        .btn-neon {
            position: relative;
            overflow: hidden;
            background: linear-gradient(90deg, #06b6d4, #8b5cf6);
            box-shadow: 0 0 18px rgba(6, 182, 212, 0.4);
            transition: all 0.3s ease;
        }
        .btn-neon:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 28px rgba(139, 92, 246, 0.6);
        }
        .btn-neon:active { transform: translateY(0) scale(0.95); }
        .btn-neon::after {
            content: "";
            position: absolute;
            top: 0; left: -75%;
            width: 50%; height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
            transform: skewX(-20deg);
        }
        .btn-neon:hover::after { animation: shine 0.9s ease; }
        @keyframes shine {
            to { left: 130%; }
        }

        /* Error shake */
        .shake {
            animation: shake 0.5s ease;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-6px); }
            40%, 80% { transform: translateX(6px); }
        }
    </style>
</head>
<body class="dark-bg min-h-screen flex items-center justify-center p-4 py-8 relative">

    <!-- Glow orbs -->
    <div class="blob bg-cyan-400 w-72 h-72 -top-10 -left-10"></div>
    <div class="blob bg-purple-500 w-80 h-80 bottom-0 right-0" style="animation-delay: 3s;"></div>

    <div class="card-enter glass-card relative w-full max-w-xl p-8 rounded-2xl">

        <!-- Title -->
        <div class="text-center mb-6">
            <div class="float-icon inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-cyan-500 to-purple-600 text-white text-2xl mb-3">
                <i class="fa-solid fa-user-pen"></i>
            </div>
            <h2 class="text-2xl font-bold text-white">Edit Student Record</h2>
            <p class="text-sm text-slate-400 mt-1">Update the student's information below.</p>
        </div>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="shake mb-4 bg-red-500/15 border border-red-500/40 text-red-300 px-4 py-3 rounded-lg text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.update', $student->student_id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Student Name -->
            <div class="fade-item d1 mb-4">
                <label for="student_name" class="block text-slate-300 text-sm font-semibold mb-2">Student Name</label>
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-cyan-400"></i>
                    <input type="text" id="student_name" name="student_name" value="{{ old('student_name', $student->student_name) }}" required
                        class="field w-full pl-10 pr-3 py-2.5 rounded-lg">
                </div>
            </div>

            <!-- Department Dropdown (Relational) -->
            <div class="fade-item d2 mb-4">
                <label for="dept_id" class="block text-slate-300 text-sm font-semibold mb-2">Department Name</label>
                <div class="relative">
                    <i class="fa-solid fa-building absolute left-3 top-1/2 -translate-y-1/2 text-cyan-400"></i>
                    <select id="dept_id" name="dept_id" required
                        class="field w-full pl-10 pr-3 py-2.5 rounded-lg">
                        <option value="">-- Select Department --</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->dept_id }}" {{ (old('dept_id', $student->dept_id) == $dept->dept_id) ? 'selected' : '' }}>
                                {{ $dept->dept_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Gender -->
            <div class="fade-item d3 mb-4">
                <label for="gender" class="block text-slate-300 text-sm font-semibold mb-2">Gender</label>
                <div class="relative">
                    <i class="fa-solid fa-venus-mars absolute left-3 top-1/2 -translate-y-1/2 text-cyan-400"></i>
                    <select id="gender" name="gender" required
                        class="field w-full pl-10 pr-3 py-2.5 rounded-lg">
                        <option value="Male" {{ (old('gender', $student->gender) == 'Male') ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ (old('gender', $student->gender) == 'Female') ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ (old('gender', $student->gender) == 'Other') ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>

            <!-- Date of Birth -->
            <div class="fade-item d4 mb-4">
                <label for="dob" class="block text-slate-300 text-sm font-semibold mb-2">Date of Birth</label>
                <div class="relative">
                    <i class="fa-solid fa-cake-candles absolute left-3 top-1/2 -translate-y-1/2 text-cyan-400"></i>
                    <input type="date" id="dob" name="dob" value="{{ old('dob', $student->dob) }}" required
                        class="field w-full pl-10 pr-3 py-2.5 rounded-lg">
                </div>
            </div>

            <!-- Enrollment Code -->
            <div class="fade-item d5 mb-4">
                <label for="enrollment" class="block text-slate-300 text-sm font-semibold mb-2">Enrollment Number</label>
                <div class="relative">
                    <i class="fa-solid fa-hashtag absolute left-3 top-1/2 -translate-y-1/2 text-cyan-400"></i>
                    <input type="text" id="enrollment" name="enrollment" value="{{ old('enrollment', $student->enrollment) }}"
                        class="field w-full pl-10 pr-3 py-2.5 rounded-lg">
                </div>
            </div>

            <!-- Enrollment Date -->
            <div class="fade-item d6 mb-4">
                <label for="enrollment_date" class="block text-slate-300 text-sm font-semibold mb-2">Enrollment Date</label>
                <div class="relative">
                    <i class="fa-solid fa-calendar-days absolute left-3 top-1/2 -translate-y-1/2 text-cyan-400"></i>
                    <input type="date" id="enrollment_date" name="enrollment_date" value="{{ old('enrollment_date', $student->enrollment_date) }}"
                        class="field w-full pl-10 pr-3 py-2.5 rounded-lg">
                </div>
            </div>

            <!-- Description -->
            <div class="fade-item d7 mb-6">
                <label for="description" class="block text-slate-300 text-sm font-semibold mb-2">Description / Notes</label>
                <textarea id="description" name="description" rows="3"
                    class="field w-full px-3 py-2.5 rounded-lg">{{ old('description', $student->description) }}</textarea>
            </div>

            <!-- Buttons -->
            <div class="fade-item d8 flex justify-between items-center">
                <a href="{{ route('students.index') }}"
                   class="text-slate-400 px-4 py-2 rounded-lg transition-all duration-200 hover:bg-slate-700/60 hover:text-white">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Cancel
                </a>
                <button type="submit" class="btn-neon text-white font-semibold py-2.5 px-6 rounded-lg">
                    <i class="fa-solid fa-floppy-disk mr-1"></i> Update Student
                </button>
            </div>
        </form>
    </div>

</body>
</html>