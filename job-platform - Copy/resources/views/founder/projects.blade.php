<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Projects | شغلني</title>
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
                            600: '#2E3248', // Hover
                        },
                        primary: {
                            400: '#818cf8',
                            500: '#6366f1', // Indigo
                            600: '#4f46e5',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #0B0C15; color: #e2e8f0; overflow-x: hidden; }
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; }

        /* Unified Background Glow */
        .bg-glow {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 50%);
            z-index: -1; pointer-events: none;
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

        /* Staggered Delays للمحتوى */
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }

        /* Dropdown Animation */
        .dropdown-menu { display: none; transform-origin: top right; }
        .dropdown-menu.show { display: block; animation: scaleIn 0.15s ease-out forwards; }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95) translateY(-5px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    </style>
</head>

<body class="min-h-screen font-sans selection:bg-primary-500 selection:text-white pb-12">

    <div class="bg-glow"></div>

    <!-- ✅ Navbar (يظهر فوراً بدون أنيميشن) -->
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

                <a href="{{ route('projects') }}" class="text-white font-medium text-sm relative py-5 border-b-2 border-primary-500">My Projects</a>

                @if (Auth::user()->role === 'freelancer')
                    <a href="{{ route('requests.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Requests</a>
                @endif

                @if (Auth::user()->role === 'founder')
                    <a href="{{ route('jobs.my') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Jobs</a>
                    <a href="{{ route('freelancers.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Members</a>
                @else
                    <a href="{{ route('jobs.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Browse Jobs</a>
                @endif
                
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

    <!-- ✅ محتوى الصفحة (التتابع يبدأ من هنا) -->
    <div class="pt-28 max-w-7xl mx-auto px-6">

        <!-- Header Section (Reveal Delay 1) -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4 reveal delay-1">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2 tracking-tight leading-tight">My Projects</h1>
                <p class="text-gray-400">Manage your active work and track progress.</p>
            </div>
            <a href="{{ route('projects.create') }}"
                class="px-5 py-2.5 bg-primary-600 hover:bg-primary-500 text-white text-sm font-bold rounded-xl shadow-lg shadow-primary-500/20 transition-all flex items-center gap-2 transform hover:-translate-y-0.5 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>New Project</span>
            </a>
        </div>

        @if (session('success'))
            <div class="mb-8 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 flex items-center gap-3 reveal">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- ✅ Projects Grid (Staggered Animation for Items - Delay 2) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($projects as $project)
                @php 
                    // يبدأ تتابع الكروت بعد ظهور الهيدر
                    $itemDelay = 0.25 + ($loop->index * 0.08); 
                @endphp
                <div class="group relative bg-dark-800 border border-dark-700 hover:border-primary-500/50 rounded-2xl p-6 transition-all duration-300 hover:shadow-xl hover:shadow-primary-500/5 hover:-translate-y-1 overflow-hidden reveal" 
                     style="animation-delay: {{ $itemDelay }}s">

                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-lg bg-dark-900 border border-dark-700 flex items-center justify-center text-primary-500 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                        </div>
                        <span class="text-xs font-mono text-gray-500 bg-dark-900/50 px-2 py-0.5 rounded border border-dark-700">{{ $project->created_at->format('M d') }}</span>
                    </div>

                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-primary-400 transition-colors truncate">{{ $project->title }}</h3>

                    <p class="text-sm text-gray-400 mb-6 line-clamp-3 leading-relaxed h-[4.5em]">{{ Str::limit($project->description, 100) }}</p>

                    <div class="pt-4 border-t border-dark-700/50 flex items-center justify-between">
                        <span class="text-xs text-gray-500 font-medium bg-primary-500/5 px-2 py-0.5 rounded border border-primary-500/10">Active</span>
                        <a href="{{ route('projects.show', $project->id) }}"
                            class="text-sm font-bold text-white flex items-center gap-1 group/link hover:text-primary-400 transition-colors">
                            View Details
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-dark-800/30 rounded-2xl border border-dashed border-dark-700 reveal delay-1">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-dark-800 mb-4 text-gray-600 shadow-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.707.293V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-1">No Projects Found</h3>
                    <p class="text-gray-500 mb-6 italic">You haven't created any projects yet.</p>
                    <a href="{{ route('projects.create') }}" class="text-sm font-bold text-primary-500 hover:text-primary-400 hover:underline">Create your first project &rarr;</a>
                </div>
            @endforelse

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileToggle = document.getElementById('profileToggle');
            const profileMenu = document.getElementById('profileMenu');

            if (profileToggle && profileMenu) {
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