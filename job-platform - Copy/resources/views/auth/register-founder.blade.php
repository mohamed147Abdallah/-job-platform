<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register as Founder | شغلني</title>
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
        body { background-color: #0B0C15; color: #e2e8f0; overflow-x: hidden; }
        
        /* Glow Effect */
        .bg-glow {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 70%);
            z-index: -1; pointer-events: none;
        }
        
        /* Glass Panel */
        .glass-panel {
            background: rgba(21, 23, 37, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        /* Form Elements */
        input {
            transition: all 0.2s ease;
        }
        input:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center font-sans selection:bg-primary-500 selection:text-white py-12 px-6">

    <div class="bg-glow"></div>

    <main class="w-full max-w-md">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-primary-500/20">W</div>
                <span class="font-bold text-2xl tracking-tight text-white">WorkConnect</span>
            </div>
            <h1 class="text-2xl font-bold text-white mb-2">Join as a Founder</h1>
            <p class="text-gray-400 text-sm">Create your profile to start hiring talent.</p>
        </div>

        <!-- Register Card -->
        <div class="glass-panel p-8 rounded-3xl animate-[fadeIn_0.5s_ease-out]">
            
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="role" value="founder">

                <!-- Full Name -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Jane Doe" 
                           class="w-full bg-dark-800 border border-dark-600 text-white text-sm rounded-xl py-3 px-4 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 placeholder-gray-600">
                </div>

                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="jane@startup.com" 
                           class="w-full bg-dark-800 border border-dark-600 text-white text-sm rounded-xl py-3 px-4 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 placeholder-gray-600">
                </div>

                <!-- Company Name (Founder Specific) -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Company Name</label>
                    <div class="relative">
                        <input type="text" name="company_name" value="{{ old('company_name') }}" required placeholder="TechVision Inc." 
                               class="w-full bg-dark-800 border border-dark-600 text-white text-sm rounded-xl py-3 px-4 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 placeholder-gray-600">
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Password</label>
                        <input type="password" name="password" required placeholder="••••••••" 
                               class="w-full bg-dark-800 border border-dark-600 text-white text-sm rounded-xl py-3 px-4 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 placeholder-gray-600">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Confirm</label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••" 
                               class="w-full bg-dark-800 border border-dark-600 text-white text-sm rounded-xl py-3 px-4 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 placeholder-gray-600">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3.5 mt-2 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 transition-all transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2">
                    Create Account <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>

                <p class="text-center text-xs text-gray-500 mt-4">
                    By registering, you agree to our <a href="#" class="text-primary-400 hover:underline">Terms</a> and <a href="#" class="text-primary-400 hover:underline">Privacy Policy</a>.
                </p>
            </form>
        </div>

        <div class="text-center mt-8">
            <p class="text-sm text-gray-400">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-white font-bold hover:text-primary-400 transition ml-1">Log In</a>
            </p>
        </div>

    </main>

</body>
</html>