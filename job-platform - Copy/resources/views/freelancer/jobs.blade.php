<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <title>Find Work | شغلني</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Unified Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Blaka&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Noto+Kufi+Arabic:wght@100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=SUSE+Mono:ital,wght@0,100..800;1,100..800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 50%);
            z-index: -1; pointer-events: none;
        }

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
                <!-- Dashboard Link -->
                <a href="{{ Auth::user()->role === 'founder' ? route('founder.dashboard') : route('dashboard') }}" 
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Dashboard</a>
                
                <!-- My Projects Link -->
                <a href="{{ route('projects') }}" 
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Projects</a>
                
                <!-- Requests Link (Only for Freelancer) -->
                @if (Auth::user()->role === 'freelancer')
                    <a href="{{ route('requests.index') }}" 
                        class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Requests</a>
                @endif

                <!-- Jobs Market / Browse Jobs (ACTIVE) -->
                <a href="{{ route('jobs.index') }}" class="text-white font-medium text-sm border-b-2 border-primary-500 py-5">Browse Jobs</a>
                <a href="{{ route('chat.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Message</a>
                
                <!-- My Jobs / Members (Founder Specific) -->
                @if (Auth::user()->role === 'founder')
                    <a href="{{ route('jobs.my') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Jobs</a>
                    <a href="{{ route('freelancers.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Members</a>
                @endif
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

    <!-- ✅ محتوى الصفحة (Staggered Reveal Starts from Header) -->
    <div class="pt-32 max-w-7xl mx-auto px-6">
        
        <!-- Header (Animated Delay 1) -->
        <div class="text-center mb-16 reveal delay-1">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-400 text-xs font-bold mb-6 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span> Live Opportunities
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight leading-tight">
                Find Work That <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-primary-600">Inspires.</span>
            </h1>
            
            <div class="relative max-w-lg mx-auto group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-primary-500 to-purple-600 rounded-2xl opacity-20 group-hover:opacity-40 transition duration-500 blur"></div>
                <div class="relative flex items-center bg-dark-800 rounded-xl border border-dark-600 p-2 shadow-2xl">
                    <svg class="w-5 h-5 text-gray-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Search projects (e.g. Laravel, React)..." class="w-full bg-transparent border-none text-white focus:ring-0 placeholder-gray-500 h-10 px-3 font-medium">
                </div>
            </div>
        </div>

        <!-- ✅ Job Grid (Staggered Animation for cards - Delay 2+) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($jobs as $job)
                @php 
                    $cardDelay = 0.25 + ($loop->index * 0.08); 
                @endphp
                <div class="glass-panel p-6 rounded-2xl flex flex-col h-full group relative reveal" 
                     style="animation-delay: {{ $cardDelay }}s">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-dark-900 flex items-center justify-center border border-dark-700 group-hover:border-primary-500/30 transition-colors shrink-0 overflow-hidden relative shadow-inner">
                                @if($job->user && $job->user->profile_image)
                                    <img src="{{ asset('storage/' . $job->user->profile_image) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-2xl">💼</span>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-lg group-hover:text-primary-400 transition-colors line-clamp-1">{{ $job->title }}</h4>
                                <div class="flex items-center gap-2 text-xs text-gray-500 mt-1">
                                    <span class="font-medium text-gray-400">{{ $job->user->company_name ?? 'Individual' }}</span>
                                    <span class="w-1 h-1 rounded-full bg-dark-600"></span>
                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <span class="bg-primary-500/10 text-primary-400 text-[10px] font-black uppercase tracking-widest px-2.5 py-1 rounded border border-primary-500/20 shadow-sm">
                            {{ $job->budget ? $job->budget : 'Negotiable' }}
                        </span>
                    </div>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2 leading-relaxed pl-16 opacity-80 italic">
                        "{{ Str::limit($job->description, 160) }}"
                    </p>
                    <div class="mt-auto pl-16 flex justify-between items-center border-t border-dark-700/50 pt-4">
                        <div class="flex gap-2">
                            <span class="text-[10px] font-black uppercase text-gray-500 border border-dark-600 px-2.5 py-1 rounded bg-dark-900/50 tracking-wider">Remote</span>
                        </div>
                        <a href="{{ route('jobs.show', $job->id) }}" class="text-xs font-black uppercase tracking-widest text-white flex items-center gap-1.5 hover:text-primary-400 transition-all active:scale-95">
                            View Project <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center glass-panel rounded-3xl border-dashed border-dark-700 reveal delay-2">
                    <p class="text-gray-500 font-medium">No active jobs found in the market currently.</p>
                </div>
            @endforelse
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