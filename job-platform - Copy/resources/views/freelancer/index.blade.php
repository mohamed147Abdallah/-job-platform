<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Members | شغلني</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Unified Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Blaka&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Noto+Kufi+Arabic:wght@100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=SUSE+Mono:ital,wght@0,100..800;1,100..800&display=swap"
        rel="stylesheet">
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
        
        /* ✅ Hide Scrollbar Completely */
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; }

        /* Unified Background Glow */
        .bg-glow {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 60%);
            z-index: -1; pointer-events: none;
        }
        
        /* Glass Panel */
        .glass-panel {
            background: rgba(21, 23, 37, 0.6); backdrop-filter: blur(12px); border: 1px solid #1F2235; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-panel:hover { border-color: #6366f1; transform: translateY(-4px); box-shadow: 0 10px 40px -10px rgba(99, 102, 241, 0.15); }

        /* ✅ Entrance Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .reveal {
            opacity: 0;
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Staggered Delays for Internal Content Only */
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }

        /* Dropdown Animation */
        .dropdown-menu { display: none; transform-origin: top right; }
        .dropdown-menu.show { display: block; animation: scaleIn 0.1s ease-out forwards; }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95) translateY(-5px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    </style>
</head>
<body class="min-h-screen font-sans selection:bg-primary-500 selection:text-white pb-12">

    <div class="bg-glow"></div>

    <!-- ✅ Navbar (Instant - No Reveal Animation) -->
    <nav class="fixed top-0 w-full z-50 border-b border-dark-700 bg-dark-900/80 backdrop-blur-xl h-16 flex items-center">
        <div class="max-w-7xl mx-auto px-6 w-full flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div
                    class="w-8 h-8 rounded-lg bg-white flex items-center justify-center overflow-hidden shadow-lg shadow-primary-500/20">
                    <img src="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png" alt="Logo"
                        class="w-full h-full object-contain">
                </div>
                <span style="font-family: 'Noto Kufi Arabic', sans-serif;"
                    class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-primary-400 via-white to-primary-500 drop-shadow-[0_2px_10px_rgba(99,102,241,0.3)]">
                    شغلني
                </span>
            </div>
            
            <div class="hidden md:flex items-center gap-8">
                @php $dashboardRoute = Auth::user()->role === 'founder' ? route('founder.dashboard') : route('dashboard'); @endphp
                <a href="{{ $dashboardRoute }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Dashboard</a>
                <a href="{{ route('projects') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Projects</a>
                
                @if(Auth::user()->role === 'founder')
                    <a href="{{ route('jobs.my') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Jobs</a>
                    <a href="{{ route('freelancers.index') }}" class="text-white font-medium text-sm border-b-2 border-primary-500 py-5">Members</a>
                @else
                    <a href="{{ route('requests.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Requests</a>
                    <a href="{{ route('jobs.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Browse Jobs</a>
                @endif
                
                <a href="{{ route('chat.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Message</a>
                <a href="{{ route('connections.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Team</a>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="profileToggle" class="w-9 h-9 rounded-full border border-dark-700 overflow-hidden hover:border-primary-500 transition-colors focus:outline-none">
                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=151725&color=fff' }}" class="w-full h-full object-cover">
                </button>
                <div id="profileMenu" class="dropdown-menu absolute right-0 top-12 w-56 bg-dark-800 border border-dark-700 rounded-xl shadow-xl py-1 z-50 ring-1 ring-black ring-opacity-5">
                    <div class="px-4 py-3 border-b border-dark-700">
                        <p class="text-sm text-white font-bold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }} Account</p>
                    </div>
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-dark-700 hover:text-white transition">Settings</a>
                    <form action="{{ route('logout') }}" method="POST"> @csrf <button class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-dark-700 transition">Logout</button> </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- ✅ Main Content (Starts Here) -->
    <div class="pt-32 max-w-7xl mx-auto px-6">
        
        <!-- Header (Animated Delay 1) -->
        <div class="text-center mb-16 reveal delay-1">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-400 text-xs font-bold mb-6 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span> Elite Talent Network
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight leading-tight">
                Hire Top <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-primary-600">Freelancers.</span>
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto mb-10">
                Connect with developers, designers, and experts ready to build your vision.
            </p>

            <!-- Search Bar -->
            <div class="relative max-w-lg mx-auto group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-primary-500 to-purple-600 rounded-2xl opacity-20 group-hover:opacity-40 transition duration-500 blur"></div>
                <div class="relative flex items-center bg-dark-800 rounded-xl border border-dark-600 p-2 shadow-2xl">
                    <svg class="w-5 h-5 text-gray-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Search by skill (e.g. React, PHP)..." class="w-full bg-transparent border-none text-white focus:ring-0 placeholder-gray-500 h-10 px-3 font-medium">
                </div>
            </div>
        </div>

        <!-- Featured Title (Animated Delay 2) -->
        <div class="flex justify-between items-end mb-6 px-1 reveal delay-2">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <span class="p-1 rounded bg-primary-500/10 text-primary-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </span>
                Featured Experts
            </h3>
            <span class="text-xs font-semibold text-gray-400 bg-dark-800 px-3 py-1.5 rounded-lg border border-dark-700 shadow-inner">
                {{ $freelancers->count() }} Talents Available
            </span>
        </div>

        <!-- ✅ Freelancers Grid (Staggered Delay 3+) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($freelancers as $freelancer)
                @php 
                    $cardDelay = 0.3 + ($loop->index * 0.08); 
                @endphp
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center text-center group relative reveal" 
                     style="animation-delay: {{ $cardDelay }}s">
                    
                    <div class="relative w-24 h-24 mb-4">
                        <div class="absolute inset-0 bg-primary-500/20 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        <img src="{{ $freelancer->profile_image ? asset('storage/' . $freelancer->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($freelancer->name) . '&background=151725&color=fff&bold=true&size=128' }}" 
                             class="w-full h-full rounded-full object-cover border-2 border-dark-600 relative z-10 transition-transform group-hover:scale-105 duration-500 shadow-2xl">
                        <span class="absolute bottom-1 right-1 w-4 h-4 bg-green-500 border-2 border-dark-800 rounded-full z-20 shadow-md"></span>
                    </div>

                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-primary-400 transition-colors">
                        {{ $freelancer->name }}
                    </h3>
                    <p class="text-xs text-primary-400 font-semibold uppercase tracking-wider mb-4 opacity-80">
                        {{ $freelancer->specialization ?? 'Professional' }}
                    </p>

                    <div class="flex flex-wrap justify-center gap-2 mb-6 w-full">
                        @php
                            $skills = $freelancer->skills; 
                            if(is_string($skills)) $skills = json_decode($skills, true) ?? explode(',', $skills);
                            if(!is_array($skills) || empty($skills)) $skills = ['Development']; 
                        @endphp
                        @foreach(array_slice($skills, 0, 3) as $skill)
                            <span class="px-2.5 py-1 rounded-md bg-dark-800 border border-dark-600 text-[10px] font-bold text-gray-400 transition-all group-hover:border-primary-500/30">
                                {{ trim($skill) }}
                            </span>
                        @endforeach
                    </div>

                    <a href="{{ route('freelancer.show', $freelancer->id) }}" class="w-full py-2.5 bg-dark-700 hover:bg-primary-600 hover:text-white border border-dark-600 hover:border-primary-500 text-gray-300 text-xs font-bold rounded-xl transition-all duration-300 block shadow-inner">
                        View Profile
                    </a>
                </div>
            @empty
                <div class="col-span-full py-20 text-center glass-panel rounded-3xl border-dashed border-dark-700 reveal delay-3">
                    <p class="text-gray-500">No Talent Found</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16 flex justify-center reveal" style="animation-delay: 1s">
            <button class="px-8 py-3 bg-dark-800 hover:bg-dark-700 border border-dark-600 text-gray-400 hover:text-white rounded-xl text-sm font-bold transition-all transform hover:scale-105 active:scale-95 shadow-lg">
                Load More Talent
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileToggle = document.getElementById('profileToggle');
            const profileMenu = document.getElementById('profileMenu');
            if(profileToggle && profileMenu) {
                profileToggle.addEventListener('click', (e) => { 
                    e.stopPropagation(); 
                    profileMenu.classList.toggle('show'); 
                });
                document.addEventListener('click', (e) => {
                    if (!profileToggle.contains(e.target) && !profileMenu.contains(e.target)) {
                        profileMenu.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>
</html>