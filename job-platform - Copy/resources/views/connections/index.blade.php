<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Connections | شغلني</title>
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
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; }

        .bg-glow {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 60%); z-index: -1; pointer-events: none;
        }
        .glass-panel {
            background: rgba(21, 23, 37, 0.6); backdrop-filter: blur(12px); border: 1px solid #1F2235; transition: all 0.3s ease;
        }
        .glass-panel:hover { border-color: #6366f1; transform: translateY(-2px); }

        /* ✅ Entrance Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .reveal {
            opacity: 0;
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Staggered Delays */
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }

        .dropdown-menu { 
            display: none; 
            transform-origin: top right;
            transition: all 0.2s ease-out;
        }
        .dropdown-menu.show { 
            display: block; 
            animation: scaleIn 0.15s ease-out forwards;
        }
        @keyframes scaleIn { 
            from { opacity: 0; transform: scale(0.95) translateY(-10px); } 
            to { opacity: 1; transform: scale(1) translateY(0); } 
        }
    </style>
</head>
<body class="min-h-screen pb-12 font-sans">

    <div class="bg-glow"></div>

    <!-- ✅ Navbar (Instant Appearance) -->
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
                <a href="{{ Auth::user()->role === 'founder' ? route('founder.dashboard') : route('dashboard') }}"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Dashboard</a>

                @if (Auth::user()->role === 'founder')
                    <a href="{{ route('projects') }}"
                        class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Projects</a>
                    <a href="{{ route('jobs.my') }}"
                        class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Jobs</a>
                    <a href="{{ route('freelancers.index') }}"
                        class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Members</a>
                    <a href="{{ route('chat.index') }}"
                        class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Message</a>
                    <a href="{{ route('connections.index') }}"
                        class="text-white font-medium text-sm relative py-5 border-b-2 border-primary-500">My Team</a>
                @else
                    <a href="{{ route('projects') }}"
                        class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Projects</a>
                    <a href="{{ route('requests.index') }}"
                        class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Requests</a>
                    <a href="{{ route('jobs.index') }}"
                        class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Browse Jobs</a>
                    <a href="{{ route('chat.index') }}"
                        class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Message</a>
                    <a href="{{ route('connections.index') }}"
                        class="text-white font-medium text-sm relative py-5 border-b-2 border-primary-500">My Team</a>
                @endif
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

    <div class="pt-32 max-w-5xl mx-auto px-6">
        
        @php
            $groupedConnections = $connections->groupBy(function($conn) {
                return (auth()->id() === $conn->sender_id) ? $conn->receiver_id : $conn->sender_id;
            });
            $totalCount = $groupedConnections->count();
        @endphp

        <!-- ✅ Header (Animated Delay 1) -->
        <div class="mb-10 flex justify-between items-end reveal delay-1">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">
                    {{ Auth::user()->role === 'founder' ? 'My Team' : 'Connected Clients' }}
                </h1>
                <p class="text-gray-400">Manage the people you are collaborating with.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-gray-400 bg-dark-800 px-4 py-2 rounded-xl border border-dark-700 shadow-sm">
                    {{ $totalCount }} {{ $totalCount === 1 ? 'Member' : 'Members' }} 
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm flex items-center gap-2 reveal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- ✅ Connections Grid (Staggered Animation for Cards) -->
        <div class="grid gap-4">
            @forelse($groupedConnections as $userId => $userConnections)
                @php
                    $firstConn = $userConnections->first();
                    $otherUser = (auth()->id() === $firstConn->sender_id) ? $firstConn->receiver : $firstConn->sender;
                    $profileRoute = $otherUser->role === 'founder' ? route('founder.show', $otherUser->id) : route('freelancer.show', $otherUser->id);
                    $jobNames = $userConnections->pluck('job.title')->filter()->unique()->implode(', ');
                    
                    // Dynamic Delay for each card
                    $cardDelay = 0.2 + ($loop->index * 0.08);
                @endphp
                
                <div class="glass-panel p-5 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-6 group reveal" 
                     style="animation-delay: {{ $cardDelay }}s">
                    
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <div class="w-16 h-16 rounded-xl bg-dark-900 border border-dark-700 p-1 shrink-0 overflow-hidden relative">
                            @if($otherUser->profile_image)
                                <img src="{{ asset('storage/' . $otherUser->profile_image) }}" class="w-full h-full rounded-lg object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($otherUser->name) }}&background=151725&color=fff&bold=true" class="w-full h-full rounded-lg object-cover">
                            @endif
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-lg leading-tight group-hover:text-primary-400 transition-colors">{{ $otherUser->name }}</h3>
                            <div class="flex flex-col mt-1 gap-1">
                                <span class="text-[10px] text-primary-400 font-black uppercase tracking-widest bg-primary-500/10 px-2 py-0.5 rounded border border-primary-500/20 w-fit">
                                    {{ $otherUser->role }}
                                </span>
                                @if($jobNames)
                                    <p class="text-xs text-gray-500 font-medium leading-relaxed">
                                        <span class="text-gray-400 font-bold">Projects:</span> {{ $jobNames }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <a href="{{ $profileRoute }}" class="flex-1 md:flex-none px-6 py-2.5 bg-dark-800 hover:bg-dark-700 text-white text-xs font-bold rounded-xl border border-dark-600 transition text-center shadow-inner">
                            View Profile
                        </a>

                        {{-- Action Button (Delete) --}}
                        <form action="{{ route('connections.destroy', $firstConn->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this connection?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2.5 rounded-xl bg-red-500/10 hover:bg-red-500/20 text-red-500 border border-red-500/20 transition group" title="Remove Connection">
                                <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="text-center py-20 bg-dark-800/30 rounded-3xl border border-dashed border-dark-700 reveal delay-2">
                    <div class="w-16 h-16 bg-dark-800 rounded-full flex items-center justify-center mx-auto mb-4 border border-dark-700">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-white font-bold text-lg">No active team members</h3>
                    <p class="text-gray-500 text-sm mt-2">Team members will appear here once connected.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileToggle = document.getElementById('profileToggle');
            const profileMenu = document.getElementById('profileMenu');

            if (profileToggle && profileMenu) {
                profileToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    profileMenu.classList.toggle('show');
                });
                document.addEventListener('click', function(e) {
                    if (!profileMenu.contains(e.target) && !profileToggle.contains(e.target)) {
                        profileMenu.classList.remove('show');
                    }
                });
            }
        });
    </script>

</body>
</html>