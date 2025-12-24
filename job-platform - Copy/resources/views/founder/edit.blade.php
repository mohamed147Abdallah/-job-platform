<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Project | WorkConnect</title>
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

        /* Form Inputs Style */
        .form-input {
            width: 100%;
            background-color: #0B0C15;
            border: 1px solid #1F2235;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            color: white;
            transition: all 0.2s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

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

    <!-- ✅ محتوى الصفحة -->
    <div class="pt-32 max-w-4xl mx-auto px-6 pb-12">

        <!-- Back Button (Reveal Delay 1) -->
        <div class="mb-8 reveal delay-1">
            <a href="{{ route('projects.show', $project->id) }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition group">
                <div class="w-8 h-8 rounded-full bg-dark-800 flex items-center justify-center border border-dark-700 group-hover:border-primary-500 transition shadow-inner">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </div>
                <span class="text-sm font-bold tracking-tight">Discard Changes</span>
            </a>
        </div>

        <div class="glass-panel rounded-3xl p-8 md:p-10 reveal delay-2">

            <!-- Header -->
            <div class="border-b border-dark-700/50 pb-8 mb-8">
                <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">Edit Project Workspace</h1>
                <p class="text-sm text-gray-400">Modify the details of <span class="text-primary-400 font-bold">"{{ $project->title }}"</span></p>
            </div>

            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    <!-- Title -->
                    <div class="space-y-2">
                        <label for="title" class="text-[11px] text-gray-500 uppercase font-black tracking-[0.2em] ml-1">Project Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}"
                            required
                            class="form-input text-base font-bold placeholder-gray-600 shadow-inner"
                            placeholder="e.g. NextGen E-commerce App">
                        @error('title')
                            <p class="mt-2 text-xs text-red-400 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Link -->
                    <div class="space-y-2">
                        <label for="link" class="text-[11px] text-gray-500 uppercase font-black tracking-[0.2em] ml-1">Repository Link <span class="text-dark-600 font-normal ml-1">(Optional)</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-primary-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </div>
                            <input type="url" id="link" name="link" value="{{ old('link', $project->link) }}"
                                class="form-input pl-11 shadow-inner text-sm"
                                placeholder="https://github.com/username/project">
                        </div>
                        @error('link')
                            <p class="mt-2 text-xs text-red-400 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label for="description" class="text-[11px] text-gray-500 uppercase font-black tracking-[0.2em] ml-1">Full Description</label>
                        <textarea id="description" name="description" rows="6" required
                            class="form-input text-sm leading-relaxed placeholder-gray-600 resize-none shadow-inner"
                            placeholder="Describe your project goals and requirements...">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-xs text-red-400 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- ✅ Actions -->
                <div class="flex items-center justify-end gap-4 border-t border-dark-700/50 pt-10 mt-10">
                    <a href="{{ route('projects.show', $project->id) }}"
                        class="px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest text-gray-400 hover:text-white hover:bg-dark-700 transition-all active:scale-95">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-8 py-3.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-black uppercase tracking-widest text-[11px] shadow-lg shadow-primary-500/25 transition-all transform hover:-translate-y-0.5 active:scale-90 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Save Workspace
                    </button>
                </div>
            </form>
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