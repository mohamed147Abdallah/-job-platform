<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | شغلني</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Unified Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        dark: { 900: '#0B0C15', 800: '#151725', 700: '#1F2235', 600: '#2E3248' },
                        primary: { 400: '#818cf8', 500: '#6366f1', 600: '#4f46e5' }
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #0B0C15; color: #e2e8f0; overflow: hidden; }
        
        /* Glow Effect */
        .bg-glow {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 70%);
            z-index: -1; pointer-events: none;
        }
        
        /* Glass Panel */
        .glass-panel {
            background: rgba(21, 23, 37, 0.7); backdrop-filter: blur(20px); border: 1px solid #1F2235;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        /* Input Autofill Fix */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px #151725 inset !important;
            -webkit-text-fill-color: white !important;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center font-sans selection:bg-primary-500 selection:text-white">

    <div class="bg-glow"></div>

    <!-- Main Container -->
    <main class="w-full max-w-md px-6">
        
        <!-- Logo -->
        <div class="flex justify-center mb-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-primary-500/20">W</div>
                <span class="font-bold text-2xl tracking-tight text-white">WorkConnect</span>
            </div>
        </div>

        <!-- Login Card -->
        <div class="glass-panel p-8 rounded-2xl animate-[fadeIn_0.5s_ease-out]">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-white mb-2">Welcome Back</h1>
                <p class="text-gray-400 text-sm">Enter your credentials to access your account.</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider ml-1">Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-primary-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                        </div>
                        <input type="email" name="email" required placeholder="name@company.com" 
                               class="w-full bg-dark-800 border border-dark-600 text-white text-sm rounded-xl py-3 pl-11 pr-4 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all placeholder-gray-600">
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center ml-1">
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Password</label>
                        <a href="#" class="text-xs text-primary-400 hover:text-primary-300 transition">Forgot?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-primary-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" name="password" required placeholder="••••••••" 
                               class="w-full bg-dark-800 border border-dark-600 text-white text-sm rounded-xl py-3 pl-11 pr-4 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all placeholder-gray-600">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 transition-all transform hover:-translate-y-0.5 active:scale-95">
                    Sign In
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center border-t border-dark-600 pt-6">
                <p class="text-sm text-gray-400">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-white font-bold hover:text-primary-400 transition ml-1">Create Account</a>
                </p>
            </div>
        </div>
    </main>

</body>
</html>