<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Management System</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
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

        /* Card slides up and fades in */
        .card-enter {
            animation: cardEnter 0.8s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        @keyframes cardEnter {
            from { opacity: 0; transform: translateY(40px) scale(0.96); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Staggered fade-in for form items */
        .fade-item {
            opacity: 0;
            animation: fadeItem 0.6s ease forwards;
        }
        .delay-1 { animation-delay: 0.25s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.55s; }
        .delay-4 { animation-delay: 0.7s; }
        @keyframes fadeItem {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Floating logo icon */
        .float-icon {
            animation: floatIcon 3s ease-in-out infinite;
        }
        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-8px); }
        }

        /* Soft floating blobs in the background */
        .blob {
            position: absolute;
            border-radius: 9999px;
            filter: blur(60px);
            opacity: 0.35;
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
<body class="animated-bg min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <!-- Background blobs -->
    <div class="blob bg-pink-400 w-72 h-72 -top-10 -left-10"></div>
    <div class="blob bg-cyan-300 w-80 h-80 bottom-0 right-0" style="animation-delay: 3s;"></div>

    <div class="card-enter relative w-full max-w-md bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-8">

        <!-- Logo + Title -->
        <div class="text-center mb-6">
            <div class="float-icon inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-blue-600 to-indigo-700 text-white text-2xl shadow-lg mb-3">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Student Management System</h2>
            <p class="text-sm text-gray-500 mt-1">Welcome back! Please log in to continue.</p>
        </div>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="shake mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email Field -->
            <div class="fade-item delay-1 mb-4">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email Address</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg bg-white
                               transition-all duration-300
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:shadow-lg focus:-translate-y-0.5">
                </div>
            </div>

            <!-- Password Field -->
            <div class="fade-item delay-2 mb-6">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="password" id="password" name="password" required
                        class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg bg-white
                               transition-all duration-300
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:shadow-lg focus:-translate-y-0.5">
                    <button type="button" id="togglePassword"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-indigo-600 transition-colors">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="fade-item delay-3 btn-shine w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg
                       shadow-md transition-all duration-300
                       hover:shadow-xl hover:-translate-y-0.5 hover:from-blue-700 hover:to-indigo-800
                       active:translate-y-0 active:scale-95">
                <i class="fa-solid fa-right-to-bracket mr-1"></i> Log In
            </button>
        </form>

        <!-- Register Link -->
        <p class="fade-item delay-4 text-sm text-center text-gray-600 mt-5">
            Don't have an account?
            <a href="{{ route('register') }}"
               class="text-indigo-600 font-semibold transition-colors duration-200 hover:text-blue-700 hover:underline">Register here</a>
        </p>
    </div>

    <script>
        // Show / hide password
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        toggle.addEventListener('click', () => {
            const isHidden = password.type === 'password';
            password.type = isHidden ? 'text' : 'password';
            toggle.innerHTML = isHidden
                ? '<i class="fa-solid fa-eye-slash"></i>'
                : '<i class="fa-solid fa-eye"></i>';
        });
    </script>

</body>
</html>