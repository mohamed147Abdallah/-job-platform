<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Role | شغلني</title>
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
            z-index: -2; pointer-events: none;
        }
        
        /* Glass Panel */
        .glass-panel {
            background: rgba(21, 23, 37, 0.4); 
            backdrop-filter: blur(12px); 
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 10; /* Ensure cards are above images */
        }
        
        /* Hover State for Role Cards */
        .role-card:hover {
            transform: translateY(-8px);
            border-color: #6366f1;
            box-shadow: 0 20px 50px -10px rgba(99, 102, 241, 0.15);
            background: rgba(21, 23, 37, 0.6);
        }

        .role-card:hover .icon-container {
            background: rgba(99, 102, 241, 1);
            color: white;
            border-color: transparent;
            transform: scale(1.1) rotate(3deg);
        }

        /* --- ✅ Original Background Image Logic --- */
        .role-image {
            position: fixed;
            top: 0;
            width: 55vw; /* Slightly wider coverage */
            height: 100vh;
            object-fit: cover;
            object-position: center;
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
            z-index: 0; /* Behind cards */
            pointer-events: none;
        }

        /* Founder Image (Right Side) */
        .role-image.founder {
            right: 0;
            transform: translateX(100px) rotate(5deg) scale(1.1);
            mask-image: linear-gradient(to left, black 20%, transparent 100%);
            -webkit-mask-image: linear-gradient(to left, black 20%, transparent 100%);
        }

        /* Freelancer Image (Left Side) */
        .role-image.freelancer {
            left: 0;
            transform: translateX(-100px) rotate(-5deg) scale(1.1);
            mask-image: linear-gradient(to right, black 20%, transparent 100%);
            -webkit-mask-image: linear-gradient(to right, black 20%, transparent 100%);
        }

        /* Active State (When hovering card) */
        .role-image.active {
            opacity: 0.6; /* Visible but not overwhelming */
            transform: translateX(0) rotate(0) scale(1);
        }

        /* Entrance Animation */
        .animate-enter { animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; transform: translateY(20px); }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }

        @keyframes slideUpFade { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center font-sans selection:bg-primary-500 selection:text-white px-6">

    <div class="bg-glow"></div>

    <!-- ✅ Background Images (Hidden by default, shown on hover) -->
    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=1200&q=80" 
         class="role-image founder" id="img-founder" alt="Founder Background">
         
    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80" 
         class="role-image freelancer" id="img-freelancer" alt="Freelancer Background">


    <!-- Header -->
    <div class="text-center mb-16 animate-enter relative z-20">
        <div class="flex items-center justify-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-primary-500/20">W</div>
            <span class="font-bold text-2xl tracking-tight text-white">WorkConnect</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 tracking-tight">Choose your path</h1>
        <p class="text-gray-400 text-lg max-w-lg mx-auto">Select how you want to join our platform to get a personalized experience.</p>
    </div>

    <!-- Role Selection Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl w-full relative z-20">
        
        <!-- ✅ Founder Card (Triggers Founder Image) -->
        <a href="{{ route('register.founder') }}" 
           class="role-card glass-panel p-10 rounded-3xl group cursor-pointer animate-enter delay-100 flex flex-col items-center text-center h-[350px] justify-center"
           onmouseenter="document.getElementById('img-founder').classList.add('active')"
           onmouseleave="document.getElementById('img-founder').classList.remove('active')">
            
            <div class="icon-container w-20 h-20 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md flex items-center justify-center mb-8 transition-all duration-500 text-gray-300 shadow-2xl">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            
            <h2 class="text-3xl font-bold text-white mb-3 group-hover:text-primary-400 transition-colors">I'm a Founder</h2>
            <p class="text-gray-400 text-sm leading-relaxed mb-8 max-w-xs mx-auto">
                Post jobs, manage projects, and hire top-tier talent for your startup.
            </p>
            
            <div class="w-full py-3 rounded-xl bg-white/5 border border-white/10 text-gray-300 font-bold text-sm backdrop-blur-md group-hover:bg-primary-600 group-hover:text-white group-hover:border-primary-500 transition-all duration-300 flex items-center justify-center gap-2">
                Join as Founder <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
            </div>
        </a>

        <!-- ✅ Freelancer Card (Triggers Freelancer Image) -->
        <a href="{{ route('register.freelancer') }}" 
           class="role-card glass-panel p-10 rounded-3xl group cursor-pointer animate-enter delay-200 flex flex-col items-center text-center h-[350px] justify-center"
           onmouseenter="document.getElementById('img-freelancer').classList.add('active')"
           onmouseleave="document.getElementById('img-freelancer').classList.remove('active')">
            
            <div class="icon-container w-20 h-20 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md flex items-center justify-center mb-8 transition-all duration-500 text-gray-300 shadow-2xl">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            
            <h2 class="text-3xl font-bold text-white mb-3 group-hover:text-primary-400 transition-colors">I'm a Freelancer</h2>
            <p class="text-gray-400 text-sm leading-relaxed mb-8 max-w-xs mx-auto">
                Find work, showcase your skills, and collaborate on exciting projects.
            </p>
            
            <div class="w-full py-3 rounded-xl bg-white/5 border border-white/10 text-gray-300 font-bold text-sm backdrop-blur-md group-hover:bg-primary-600 group-hover:text-white group-hover:border-primary-500 transition-all duration-300 flex items-center justify-center gap-2">
                Join as Freelancer <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
            </div>
        </a>

    </div>

    <!-- Login Link -->
    <div class="mt-12 animate-enter delay-200 relative z-20">
        <p class="text-gray-500 text-sm">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-primary-400 font-bold hover:text-white transition-colors">Log In</a>
        </p>
    </div>

</body>
</html>