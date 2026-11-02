<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student - Student Management System</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Animated gradient background (danger theme) */
        .animated-bg {
            background: linear-gradient(-45deg, #dc2626, #be123c, #7c3aed, #1e293b);
            background-size: 400% 400%;
            animation: gradientShift 14s ease infinite;
        }
        @keyframes gradientShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Card slides up and fades in */
        .card-enter {
            animation: cardEnter 0.8s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        @keyframes cardEnter {
            from { opacity: 0; transform: translateY(40px) scale(0.96); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Staggered fade-in */
        .fade-item {
            opacity: 0;
            animation: fadeItem 0.6s ease forwards;
        }
        .d1 { animation-delay: 0.25s; }
        .d2 { animation-delay: 0.4s; }
        .d3 { animation-delay: 0.55s; }
        .d4 { animation-delay: 0.7s; }
        @keyframes fadeItem {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Warning icon: shake + pulse ring */
        .warn-icon {
            animation: iconShake 0.6s ease 0.5s both, pulseRing 1.8s ease-out 1.1s infinite;
        }
        @keyframes iconShake {
            0%, 100% { transform: rotate(0); }
            20%      { transform: rotate(-14deg); }
            40%      { transform: rotate(12deg); }
            60%      { transform: rotate(-8deg); }
            80%      { transform: rotate(6deg); }
        }
        @keyframes pulseRing {
            0%   { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.5); }
            100% { box-shadow: 0 0 0 20px rgba(239, 68, 68, 0); }
        }

        /* Soft floating blobs */
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

        /* Button shine effect */
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
<body class="animated-bg min-h-screen flex items-center justify-center p-4 py-8 relative">

    <!-- Background blobs -->
    <div class="blob bg-yellow-300 w-72 h-72 -top-10 -left-10"></div>
    <div class="blob bg-pink-400 w-80 h-80 bottom-0 right-0" style="animation-delay: 3s;"></div>

    <div class="card-enter relative w-full max-w-md bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-8 text-center">

        <!-- Warning icon -->
        <div class="warn-icon mx-auto mb-4 w-20 h-20 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-4xl">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>

        <h2 class="text-2xl font-bold text-gray-800">Delete Student?</h2>
        <p class="text-sm text-gray-500 mt-1 mb-6">
            This action <span class="font-semibold text-red-600">cannot be undone</span>.
        </p>

        <!-- Student details -->
        <div class="fade-item d1 bg-red-50 border border-red-200 rounded-xl p-4 text-left text-sm mb-6">
            <div class="flex items-center gap-3 mb-3 pb-3 border-b border-red-200">
                <div class="w-11 h-11 rounded-full bg-gradient-to-br from-red-500 to-rose-600 text-white flex items-center justify-center text-lg font-bold">
                    {{ strtoupper(substr($student->student_name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-bold text-gray-800">{{ $student->student_name }}</p>
                    <p class="text-xs text-gray-500">ID: {{ $student->student_id }}</p>
                </div>
            </div>

            <dl class="space-y-1.5">
                <div class="flex justify-between">
                    <dt class="text-gray-500"><i class="fa-solid fa-venus-mars w-5"></i> Gender</dt>
                    <dd class="font-medium text-gray-800">{{ $student->gender }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500"><i class="fa-solid fa-cake-candles w-5"></i> DOB</dt>
                    <dd class="font-medium text-gray-800">{{ $student->dob }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500"><i class="fa-solid fa-building w-5"></i> Department</dt>
                    <dd class="font-medium text-gray-800">{{ $student->department->dept_name ?? 'N/A' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500"><i class="fa-solid fa-calendar-days w-5"></i> Enrolled</dt>
                    <dd class="font-medium text-gray-800">{{ $student->enrollment_date }}</dd>
                </div>
            </dl>
        </div>

        <!-- Confirmation checkbox -->
        <label class="fade-item d2 flex items-center justify-center gap-2 text-sm text-gray-600 mb-5 cursor-pointer select-none">
            <input type="checkbox" id="confirmCheck" class="w-4 h-4 accent-red-600 cursor-pointer">
            I understand this student will be permanently deleted
        </label>

        <!-- Delete form -->
        <form action="{{ route('students.destroy', $student->student_id) }}" method="POST" class="fade-item d3">
            @csrf
            @method('DELETE')

            <div class="flex gap-3">
                <a href="{{ route('students.index') }}"
                   class="flex-1 py-2.5 rounded-lg bg-gray-100 text-gray-700 font-semibold flex items-center justify-center
                          transition-all duration-200 hover:bg-gray-200 active:scale-95">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Cancel
                </a>

                <button type="submit" id="deleteBtn" disabled
                        class="btn-shine flex-1 py-2.5 rounded-lg bg-gradient-to-r from-red-500 to-rose-600 text-white font-semibold shadow-md
                               transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 active:scale-95
                               disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:shadow-md disabled:hover:translate-y-0">
                    <i class="fa-solid fa-trash mr-1"></i> Yes, Delete
                </button>
            </div>
        </form>
    </div>

    <script>
        // The Delete button stays disabled until the checkbox is ticked
        const check = document.getElementById('confirmCheck');
        const btn   = document.getElementById('deleteBtn');
        check.addEventListener('change', () => { btn.disabled = !check.checked; });
    </script>

</body>
</html>