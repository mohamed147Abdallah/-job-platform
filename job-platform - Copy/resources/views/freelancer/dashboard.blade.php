<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard | شغلني</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
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
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        dark: {
                            900: '#0B0C15', // Deep background
                            800: '#151725', // Cards
                            700: '#1F2235', // Borders
                            600: '#2E3248', // Hover states
                        },
                        primary: {
                            400: '#818cf8',
                            500: '#6366f1', // Indigo Accent
                            600: '#4f46e5',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #0B0C15; color: #e2e8f0; overflow-x: hidden; }
        
        /* Hide Scrollbar */
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Unified Background Glow Effect */
        .bg-glow {
            position: fixed;
            top: 0; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 50%);
            z-index: -1;
            pointer-events: none;
        }

        .glass-panel {
            background: rgba(21, 23, 37, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid #1F2235;
            transition: all 0.3s ease;
        }

        /* ✅ Entrance Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .reveal {
            opacity: 0;
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Staggered Delays for Content */
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }

        /* Dropdown Animation */
        .dropdown-menu { 
            display: none; 
            transform-origin: top right;
        }
        .dropdown-menu.show { 
            display: block; 
            animation: scaleIn 0.15s ease-out forwards; 
        }
        @keyframes scaleIn { 
            from { opacity: 0; transform: scale(0.95) translateY(-5px); } 
            to { opacity: 1; transform: scale(1) translateY(0); } 
        }
    </style>
</head>

<body class="relative min-h-screen font-sans selection:bg-primary-500 selection:text-white pb-12">

    <div class="bg-glow"></div>

    <!-- ✅ Navbar (Instant Appearance - No Delay) -->
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
                <a href="{{ route('dashboard') }}" class="text-white font-medium text-sm relative py-5 border-b-2 border-primary-500">Dashboard</a>
                <a href="{{ route('projects') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Projects</a>
                <a href="{{ route('requests.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Requests</a>
                <a href="{{ route('jobs.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Browse Jobs</a>
                <a href="{{ route('chat.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Message</a>
                <a href="{{ route('connections.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Team</a>
            </div>

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

    <!-- ✅ Main Content (Starts with Reveal Animation) -->
    <main class="relative z-10 pt-28 max-w-7xl mx-auto px-6">
        
        <!-- Welcome Section (Delay 1) -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4 reveal delay-1">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 tracking-tight leading-tight">Hello, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                <p class="text-gray-400">Here's your latest activity overview.</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="group px-5 py-2.5 bg-white text-dark-900 font-bold rounded-xl text-sm transition hover:bg-gray-100 flex items-center gap-2 shadow-[0_0_20px_rgba(255,255,255,0.1)] active:scale-95">
                <span>Find New Work</span>
                <svg class="w-4 h-4 text-dark-900 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <!-- KPI Grid (Delay 2) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 reveal delay-2">
            
            <div class="glass-panel p-6 rounded-2xl relative overflow-hidden group hover:border-primary-500/50 hover:-translate-y-1">
                <div class="absolute top-4 right-4 p-2 bg-dark-900/50 rounded-lg text-primary-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <p class="text-gray-400 text-sm font-medium mb-1">Market Opportunities</p>
                <h3 class="text-3xl font-bold text-white tracking-tight">{{ $marketJobsCount }}</h3>
                <span class="inline-flex items-center gap-1 mt-3 text-xs font-medium text-green-400 bg-green-400/10 px-2 py-1 rounded-md border border-green-400/20">
                    Available Jobs
                </span>
            </div>

            <div class="glass-panel p-6 rounded-2xl relative overflow-hidden group hover:border-purple-500/50 hover:-translate-y-1">
                <div class="absolute top-4 right-4 p-2 bg-dark-900/50 rounded-lg text-purple-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <p class="text-gray-400 text-sm font-medium mb-1">My Posted Jobs</p>
                <h3 class="text-3xl font-bold text-white tracking-tight">{{ $myPostedJobsCount }}</h3>
                <span class="inline-flex items-center gap-1 mt-3 text-xs font-medium text-gray-400 bg-dark-900/50 px-2 py-1 rounded-md border border-dark-700">
                    Projects Managed
                </span>
            </div>

            <div class="glass-panel p-6 rounded-2xl relative overflow-hidden group hover:border-blue-500/50 hover:-translate-y-1">
                <div class="absolute top-4 right-4 p-2 bg-dark-900/50 rounded-lg text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-gray-400 text-sm font-medium mb-1">Account Status</p>
                <h3 class="text-2xl font-bold text-white tracking-tight">Active</h3>
                <span class="inline-flex items-center gap-1 mt-3 text-xs font-medium text-blue-400 bg-blue-400/10 px-2 py-1 rounded-md border border-blue-400/20">
                    Member since {{ $user->created_at->format('M Y') }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Activity List (Delay 3) -->
            <div class="lg:col-span-2 reveal delay-3">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-primary-500 rounded-full"></span>
                    Latest Market Activity
                </h3>
                
                <div class="space-y-3">
                    @forelse($recentJobs as $job)
                        @php $jobDelay = 0.4 + ($loop->index * 0.05); @endphp
                        <div class="group bg-dark-800 border border-dark-700 p-4 rounded-xl flex items-center gap-4 hover:border-primary-500/30 hover:bg-dark-800/80 transition-all duration-300 reveal" style="animation-delay: {{ $jobDelay }}s">
                            <div class="w-10 h-10 rounded-xl bg-dark-900 flex items-center justify-center border border-dark-600 overflow-hidden shrink-0 group-hover:border-primary-500/50 transition-colors shadow-inner">
                                @if($job->user && $job->user->profile_image)
                                    <img src="{{ asset('storage/' . $job->user->profile_image) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-base">💼</span>
                                @endif
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-white truncate group-hover:text-primary-400 transition-colors">{{ $job->title }}</h4>
                                <div class="flex items-center gap-2 text-xs text-gray-500 mt-0.5">
                                    <span class="truncate">by {{ $job->user->name ?? 'Unknown' }}</span>
                                    <span class="w-1 h-1 rounded-full bg-dark-600"></span>
                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('jobs.show', $job->id) }}" class="px-4 py-1.5 text-[10px] font-black uppercase tracking-widest text-white bg-dark-700 border border-dark-600 rounded-lg hover:bg-primary-600 hover:border-primary-500 transition-all active:scale-95 shadow-lg">
                                View
                            </a>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-12 glass-panel border-dashed border-dark-700 rounded-2xl">
                            <p>No recent activity found.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar Info (Delay 3 with inner staggered elements) -->
            <div class="space-y-6 reveal delay-3">
                <!-- Profile Summary -->
                <div class="glass-panel p-6 rounded-[2rem] text-center relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary-500 to-purple-600 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="w-20 h-20 mx-auto rounded-full p-1 bg-dark-900 border border-dark-700 mb-3 shadow-2xl relative">
                        <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=000&color=fff' }}" 
                             class="w-full h-full rounded-full object-cover border-2 border-dark-800">
                        <span class="absolute bottom-1 right-1 w-4 h-4 bg-green-500 border-2 border-dark-800 rounded-full"></span>
                    </div>
                    <h3 class="font-bold text-white text-lg group-hover:text-primary-400 transition-colors">{{ Auth::user()->name }}</h3>
                    <p class="text-xs text-gray-500 mb-5 font-mono opacity-80">{{ Auth::user()->email }}</p>
                    
                    <a href="{{ route('profile') }}" class="block w-full py-2.5 bg-dark-700 hover:bg-white hover:text-dark-900 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all border border-dark-600 shadow-inner">
                        Manage Profile
                    </a>
                </div>

                <!-- Suggestions -->
                <div class="glass-panel p-6 rounded-[2rem] border-dark-700/50 shadow-2xl">
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-4 ml-1">Suggested for you</h4>
                    <div class="space-y-3">
                        @forelse($suggestedJobs as $job)
                            @php $suggDelay = 0.5 + ($loop->index * 0.08); @endphp
                            <a href="{{ route('jobs.show', $job->id) }}" class="block p-3.5 rounded-2xl bg-dark-900/50 hover:bg-dark-700 border border-transparent hover:border-primary-500/20 transition-all group reveal shadow-sm" style="animation-delay: {{ $suggDelay }}s">
                                <h5 class="text-xs font-bold text-gray-200 group-hover:text-primary-400 mb-1.5 truncate">{{ $job->title }}</h5>
                                <div class="flex justify-between items-center">
                                    <span class="text-[10px] text-gray-500 font-medium">{{ $job->user->name ?? 'Client' }}</span>
                                    <span class="text-[10px] text-primary-400 bg-primary-400/10 px-2 py-0.5 rounded-lg border border-primary-500/10 font-bold">{{ $job->budget ?? 'N/A' }}</span>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-gray-500 text-center py-4 italic">No suggestions available.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </main>

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