<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>My Requests | شغلني</title>
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
        body { background-color: #0B0C15; color: #e2e8f0; overflow-x: hidden; }
        
        /* ✅ Hide Scrollbar */
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Unified Background Glow */
        .bg-glow {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 60%); z-index: -1; pointer-events: none;
        }
        
        .glass-panel {
            background: rgba(21, 23, 37, 0.7); backdrop-filter: blur(12px); border: 1px solid #1F2235; transition: all 0.3s ease;
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

        /* Staggered Delay for Header */
        .delay-1 { animation-delay: 0.1s; }

        /* Dropdown Animation */
        .dropdown-menu { display: none; transform-origin: top right; }
        .dropdown-menu.show { display: block; animation: scaleIn 0.15s ease-out forwards; }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95) translateY(-5px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    </style>
</head>

<body class="relative min-h-screen font-sans selection:bg-primary-500 selection:text-white pb-12">

    <div class="bg-glow"></div>

    <!-- ✅ Navbar (Appears instantly without animation) -->
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
                
                <!-- Requests Link (ACTIVE) -->
                <a href="{{ route('requests.index') }}" 
                    class="text-white font-medium text-sm relative py-5 border-b-2 border-primary-500">Requests</a>
                
                <!-- Role Specific Links -->
                @if (Auth::user()->role === 'founder')
                    <a href="{{ route('jobs.my') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Jobs</a>
                    <a href="{{ route('freelancers.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Members</a>
                @else
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

    <!-- ✅ محتوى الصفحة (Starts with Staggered Reveal) -->
    <div class="pt-32 max-w-4xl mx-auto px-6">
        
        <h1 class="text-3xl font-bold text-white mb-8 reveal delay-1">Inbox Requests</h1>

        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm flex items-center gap-2 reveal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            @forelse($requests as $req)
                @php 
                    // Calculate card delay: start at 0.2s and increase by 0.08s for each card
                    $cardDelay = 0.2 + ($loop->index * 0.08); 
                @endphp
                <div class="glass-panel p-6 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-6 hover:border-primary-500/30 transition-all reveal" 
                     style="animation-delay: {{ $cardDelay }}s">
                    
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <div class="w-16 h-16 rounded-xl bg-dark-800 overflow-hidden border border-dark-600 shrink-0 flex items-center justify-center shadow-inner">
                            @if($req->sender->profile_image)
                                <img src="{{ asset('storage/' . $req->sender->profile_image) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-2xl">🏢</span>
                            @endif
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-lg group-hover:text-primary-400 transition-colors">{{ $req->sender->company_name ?? $req->sender->name }}</h4>
                            <p class="text-gray-400 text-sm">
                                <span class="text-gray-500">Founder:</span> {{ $req->sender->name }}
                            </p>
                            <span class="text-xs text-gray-500 mt-1 block font-mono">{{ $req->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <div class="flex gap-3 w-full md:w-auto">
                        <!-- Decline Button -->
                        <form action="{{ route('request.decline', $req->id) }}" method="POST" class="flex-1 md:flex-none">
                            @csrf
                            <button type="submit" class="w-full md:w-auto px-5 py-2.5 rounded-xl border border-dark-600 text-gray-400 hover:text-white hover:bg-dark-800 transition text-sm font-bold active:scale-95">
                                Decline
                            </button>
                        </form>

                        <!-- Accept Button -->
                        <form action="{{ route('request.accept', $req->id) }}" method="POST" class="flex-1 md:flex-none">
                            @csrf
                            <button type="submit" class="w-full md:w-auto px-6 py-2.5 rounded-xl bg-primary-600 text-white hover:bg-primary-500 shadow-lg shadow-primary-500/20 transition text-sm font-bold flex items-center justify-center gap-2 transform active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Accept
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 glass-panel rounded-2xl border-dashed border-dark-700 reveal" style="animation-delay: 0.2s">
                    <div class="inline-flex p-4 rounded-full bg-dark-800 mb-3 text-gray-600 border border-dark-700">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-1">No pending requests</h3>
                    <p class="text-gray-500 text-sm">New invitations from founders will appear here.</p>
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