<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Jobs | شغلني</title>
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
        
        /* Hide Scrollbar */
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; }

        /* Unified Background Glow */
        .bg-glow {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 70%);
            z-index: -1; pointer-events: none;
        }
        
        /* Glass Panel */
        .glass-panel {
            background: rgba(21, 23, 37, 0.7); backdrop-filter: blur(20px); 
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
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

        /* Staggered Delays للمحتوى الداخلي */
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
                <a href="{{ route('projects') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Projects</a>
                <a href="{{ route('jobs.my') }}" class="text-white font-medium text-sm border-b-2 border-primary-500 py-5">My Jobs</a>
                <a href="{{ route('freelancers.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Members</a>
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
    <div class="pt-32 max-w-6xl mx-auto px-6">
        
        <!-- Header Section (Animated Delay 1) -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4 reveal delay-1">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 tracking-tight leading-tight">
                    My Posted <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-primary-600">Jobs</span>
                </h1>
                <p class="text-gray-400">Manage your job listings and view applicants.</p>
            </div>
            <a href="{{ route('jobs.create') }}" class="px-5 py-2.5 bg-primary-600 hover:bg-primary-500 text-white text-sm font-bold rounded-xl shadow-lg shadow-primary-500/20 transition-all flex items-center gap-2 active:scale-95 transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Post New Job
            </a>
        </div>

        <!-- Success Message (Reveal) -->
        @if(session('success'))
            <div class="mb-8 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm flex items-center gap-2 animate-pulse reveal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- ✅ Jobs List Table (Staggered Animation for Items - Delay 2) -->
        <div class="glass-panel rounded-2xl overflow-hidden reveal delay-2">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-dark-800/50 text-xs uppercase text-gray-500 font-bold border-b border-dark-700">
                        <tr>
                            <th class="px-6 py-4">Job Title</th>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">Budget</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Date Posted</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-700/50 text-sm text-gray-300">
                        @forelse($jobs as $job)
                            @php 
                                // تتابع ظهور الصفوف بعد الهيدر والحاوية
                                $rowDelay = 0.25 + ($loop->index * 0.05); 
                            @endphp
                            <tr class="hover:bg-dark-800/30 transition group reveal" style="animation-delay: {{ $rowDelay }}s">
                                <!-- Title -->
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white group-hover:text-primary-400 transition-colors line-clamp-1">
                                        {{ $job->title }}
                                    </div>
                                </td>
                                
                                <!-- Job Type Badge -->
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded text-[10px] font-bold border uppercase tracking-wider
                                        @if($job->type == 'full_time') bg-blue-500/10 text-blue-400 border-blue-500/20
                                        @elseif($job->type == 'part_time') bg-purple-500/10 text-purple-400 border-purple-500/20
                                        @elseif($job->type == 'contract') bg-orange-500/10 text-orange-400 border-orange-500/20
                                        @else bg-gray-500/10 text-gray-400 border-gray-500/20 @endif">
                                        {{ str_replace('_', ' ', $job->type ?? 'Freelance') }}
                                    </span>
                                </td>

                                <!-- Budget -->
                                <td class="px-6 py-4 font-mono text-primary-300">
                                    {{ $job->budget ?? 'Negotiable' }}
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-green-500/10 text-green-400 border border-green-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Open
                                    </span>
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4 text-gray-500 text-xs">
                                    {{ $job->created_at->format('M d, Y') }}
                                </td>

                                <!-- Action -->
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="inline-flex items-center justify-center px-4 py-1.5 bg-dark-700 hover:bg-primary-600 text-white text-xs font-bold rounded-lg border border-dark-600 hover:border-primary-500 transition-all shadow-inner active:scale-95">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="reveal delay-2">
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-dark-800 rounded-full flex items-center justify-center mb-4 border border-dark-700 shadow-xl">
                                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <h3 class="text-white font-bold text-lg mb-1">No Jobs Posted Yet</h3>
                                        <p class="text-gray-500 text-sm mb-6">Start building your team by posting your first opportunity.</p>
                                        <a href="{{ route('jobs.create') }}" class="px-6 py-2 bg-primary-600 hover:bg-primary-500 text-white rounded-xl font-bold text-sm transition-all shadow-lg shadow-primary-500/20">
                                            Create First Job Post
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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