<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $founder->company_name ?? $founder->name }} | شغلني</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
        body { background-color: #0B0C15; color: #e2e8f0; }
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; }
        .bg-glow {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 60%);
            z-index: -1; pointer-events: none;
        }
        .glass-panel {
            background: rgba(21, 23, 37, 0.6); backdrop-filter: blur(12px); border: 1px solid #1F2235;
        }
        .dropdown-menu { display: none; transform-origin: top right; }
        .dropdown-menu.show { display: block; animation: scaleIn 0.1s ease-out forwards; }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95) translateY(-5px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    </style>
</head>
<body class="min-h-screen pb-12 font-sans selection:bg-primary-500 selection:text-white">

    <div class="bg-glow"></div>

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 border-b border-dark-700 bg-dark-900/80 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-6 h-16 flex justify-between items-center">
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
                <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Dashboard</a>
                <a href="{{ route('projects') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Projects</a>
                <a href="{{ route('requests.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Requests</a>
                <a href="{{ route('jobs.index') }}" class="text-white font-medium text-sm border-b-2 border-primary-500 py-5">Browse Jobs</a>
                <a href="{{ route('chat.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Message</a>
                <a href="{{ route('connections.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My team </a>
            </div>

            <div class="relative">
                <button id="profileToggle" class="w-9 h-9 rounded-full border border-dark-700 overflow-hidden hover:border-primary-500 transition-colors">
                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=151725&color=fff' }}" class="w-full h-full object-cover">
                </button>
                <div id="profileMenu" class="dropdown-menu absolute right-0 top-12 w-56 bg-dark-800 border border-dark-700 rounded-xl shadow-xl py-1 z-50 ring-1 ring-black ring-opacity-5">
                    <div class="px-4 py-3 border-b border-dark-700">
                        <p class="text-sm text-white font-bold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }} Account</p>
                    </div>
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-dark-700 hover:text-white">Settings</a>
                    <form action="{{ route('logout') }}" method="POST"> @csrf <button class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-dark-700">Logout</button> </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-32 max-w-5xl mx-auto px-6">
        
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition group">
                <div class="w-8 h-8 rounded-full bg-dark-800 flex items-center justify-center border border-dark-700 group-hover:border-primary-500 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </div>
                <span class="text-sm font-bold">Back to Market</span>
            </a>
        </div>

        <!-- Founder Profile Card -->
        <div class="glass-panel rounded-3xl overflow-hidden relative border border-dark-700 mb-12">
            <div class="h-40 w-full bg-gradient-to-r from-dark-800 via-primary-900/20 to-dark-800 relative">
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
            </div>
            
            <div class="px-8 pb-8">
                <div class="flex flex-col md:flex-row gap-6 items-end -mt-12 relative z-10">
                    <div class="w-32 h-32 rounded-2xl p-1 bg-dark-900 shadow-2xl">
                        @if($founder->profile_image)
                            <img src="{{ asset('storage/' . $founder->profile_image) }}" class="w-full h-full rounded-xl object-cover border-2 border-dark-700">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($founder->name) }}&background=151725&color=fff&bold=true" class="w-full h-full rounded-xl object-cover border-2 border-dark-700">
                        @endif
                    </div>

                    <div class="flex-1 pb-2">
                        <h1 class="text-3xl font-bold text-white mb-1">{{ $founder->company_name ?? $founder->name }}</h1>
                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ $founder->name }}
                            </span>
                            <span class="w-1 h-1 rounded-full bg-dark-600"></span>
                            <span>Joined {{ $founder->created_at->format('M Y') }}</span>
                        </div>
                    </div>

                    <div class="flex gap-6 bg-dark-800/50 px-6 py-3 rounded-xl border border-dark-700 backdrop-blur-sm">
                        <div class="text-center">
                            <span class="block text-2xl font-bold text-white">{{ $founderProjects->count() }}</span>
                            <span class="text-[10px] uppercase tracking-wider text-gray-500 font-bold">Open Jobs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-primary-500 animate-pulse"></span>
            Active Opportunities
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($founderProjects as $job)
                <div class="glass-panel p-6 rounded-2xl group relative hover:border-primary-500/30 transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <h4 class="text-lg font-bold text-white group-hover:text-primary-400 transition-colors">{{ $job->title }}</h4>
                        <span class="text-[10px] font-bold bg-primary-500/10 text-primary-400 px-2 py-1 rounded border border-primary-500/20">OPEN</span>
                    </div>
                    <p class="text-sm text-gray-400 line-clamp-2 mb-6">{{ Str::limit($job->description, 120) }}</p>
                    <div class="flex justify-between items-center border-t border-dark-700/50 pt-4">
                        <span class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                        <a href="{{ route('jobs.show', $job->id) }}" class="text-xs font-bold text-white flex items-center gap-1 hover:text-primary-400 transition">
                            View Details <span class="text-lg">&rarr;</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-12 border border-dashed border-dark-700 rounded-2xl bg-dark-800/30">
                    <p class="text-gray-500">No active jobs listed by this company yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        const profileToggle = document.getElementById('profileToggle');
        const profileMenu = document.getElementById('profileMenu');
        if(profileToggle && profileMenu) {
            profileToggle.addEventListener('click', (e) => { e.stopPropagation(); profileMenu.classList.toggle('show'); });
            document.addEventListener('click', (e) => { if (!profileToggle.contains(e.target) && !profileMenu.contains(e.target)) profileMenu.classList.remove('show'); });
        }
    </script>

</body>
</html>