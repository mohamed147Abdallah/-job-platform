<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $project->title }} | WorkConnect</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Unified Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        arabic: ['"Noto Kufi Arabic"', 'sans-serif'],
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

        .glass-panel {
            background: rgba(21, 23, 37, 0.7); backdrop-filter: blur(20px); 
            border: 1px solid #1F2235;
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

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }

        /* Dropdown Animation */
        .dropdown-menu { display: none; transform-origin: top right; }
        .dropdown-menu.show { display: block; animation: scaleIn 0.15s ease-out forwards; }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95) translateY(-5px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    </style>
</head>

<body class="min-h-screen font-sans selection:bg-primary-500 selection:text-white pb-12">

    <div class="bg-glow"></div>

    <!-- ✅ Navbar (Instant - Fixed) -->
    <nav class="fixed top-0 w-full z-50 border-b border-dark-700 bg-dark-900/80 backdrop-blur-xl h-16 flex items-center">
        <div class="max-w-7xl mx-auto px-6 w-full flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center overflow-hidden shadow-lg shadow-primary-500/20">
                    <img src="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png" alt="Logo" class="w-full h-full object-contain">
                </div>
                <span class="font-black text-2xl bg-clip-text text-transparent bg-gradient-to-r from-primary-400 via-white to-primary-500 font-arabic">
                    شغلني
                </span>
            </div>

            <div class="hidden md:flex items-center gap-8">
                @php $dashboardRoute = Auth::user()->role === 'founder' ? route('founder.dashboard') : route('dashboard'); @endphp
                <a href="{{ $dashboardRoute }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Dashboard</a>
                <a href="{{ route('projects') }}" class="text-white font-medium text-sm relative py-5 border-b-2 border-primary-500">My Projects</a>
                
                @if (Auth::user()->role === 'freelancer')
                    <a href="{{ route('requests.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Requests</a>
                    <a href="{{ route('jobs.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Browse Jobs</a>
                @else
                    <a href="{{ route('jobs.my') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Jobs</a>
                    <a href="{{ route('freelancers.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Members</a>
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
    <div class="pt-32 max-w-4xl mx-auto px-6 pb-12">

        <!-- Back Button (Reveal Delay 1) -->
        <div class="mb-8 reveal delay-1">
            <a href="{{ route('projects') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition group">
                <div class="w-8 h-8 rounded-full bg-dark-800 flex items-center justify-center border border-dark-700 group-hover:border-primary-500 transition shadow-inner">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </div>
                <span class="text-sm font-bold tracking-tight">Back to Projects</span>
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-8 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 flex items-center gap-3 reveal delay-1">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- ✅ Project Card (Reveal Delay 2) -->
        <div class="glass-panel rounded-3xl p-8 md:p-10 reveal delay-2">

            <!-- Header -->
            <div class="border-b border-dark-700/50 pb-8 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-lg bg-primary-500/10 border border-primary-500/20 text-primary-400 text-[10px] font-black uppercase tracking-widest mb-3">Project Workspace</div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white tracking-tight leading-tight">{{ $project->title }}</h1>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] font-bold text-gray-500 uppercase tracking-tighter block mb-1">Created At</span>
                        <p class="text-sm text-gray-300 font-mono">{{ $project->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-10">
                <h3 class="text-[11px] text-gray-500 uppercase font-black tracking-[0.2em] mb-4 ml-1 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-500"></span>
                    Description
                </h3>
                <div class="bg-dark-900/50 border border-dark-700/50 p-6 rounded-2xl">
                    <p class="text-gray-300 leading-relaxed whitespace-pre-wrap text-base italic opacity-90">
                        {{ $project->description }}
                    </p>
                </div>
            </div>

            <!-- Link Section -->
            @if ($project->link)
                <div class="mb-10">
                    <h3 class="text-[11px] text-gray-500 uppercase font-black tracking-[0.2em] mb-4 ml-1">Repository & Links</h3>
                    <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer"
                        class="group/link flex items-center justify-between p-4 rounded-2xl bg-dark-900/30 border border-dark-700 hover:border-primary-500/50 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-dark-800 border border-dark-700 flex items-center justify-center text-primary-400 group-hover/link:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </div>
                            <span class="text-sm font-bold text-gray-400 group-hover/link:text-primary-400 transition-colors break-all">{{ $project->link }}</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-600 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            @endif

            <!-- ✅ Actions (Reveal Delay 3) -->
            <div class="flex flex-col sm:flex-row gap-4 border-t border-dark-700/50 pt-10 mt-10 reveal delay-3">

                <a href="{{ route('projects.edit', $project->id) }}"
                    class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-black uppercase tracking-widest text-[11px] shadow-lg shadow-primary-500/20 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L17.5.232z"></path></svg>
                    Edit Project
                </a>

                <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');"
                    class="m-0 w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full px-8 py-3.5 rounded-xl bg-red-500/5 hover:bg-red-500 text-red-500 hover:text-white font-black uppercase tracking-widest text-[11px] border border-red-500/20 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Delete Workspace
                    </button>
                </form>

            </div>
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