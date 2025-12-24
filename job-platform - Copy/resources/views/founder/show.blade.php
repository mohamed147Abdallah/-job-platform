<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $job->title }} | Details</title>
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

        /* Glow Effect */
        .bg-glow {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 60%);
            z-index: -1; pointer-events: none;
        }
        
        /* Glass Panel */
        .glass-panel {
            background: rgba(21, 23, 37, 0.6); backdrop-filter: blur(12px); 
            border: 1px solid #1F2235;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        /* Dropdown Animation */
        .dropdown-menu { display: none; transform-origin: top right; }
        .dropdown-menu.show { display: block; animation: scaleIn 0.1s ease-out forwards; }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95) translateY(-5px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    </style>
</head>
<body class="min-h-screen font-sans selection:bg-primary-500 selection:text-white pb-12">

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
                <!-- Dashboard Link -->
                <a href="{{ Auth::user()->role === 'founder' ? route('founder.dashboard') : route('dashboard') }}" 
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Dashboard</a>
                
                <!-- My Projects Link -->
                <a href="{{ route('projects') }}" 
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Projects</a>
                
                <!-- Dynamic Links based on role -->
                @if (Auth::user()->role === 'founder')
                    <a href="{{ route('jobs.my') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Jobs</a>
                    <a href="{{ route('freelancers.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Members</a>
                @else
                    <a href="{{ route('requests.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Requests</a>
                    <a href="{{ route('jobs.index') }}" class="text-white font-medium text-sm border-b-2 border-primary-500 py-5">Browse Jobs</a>
                @endif
                <a href="{{ route('chat.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Message</a>
                <a href="{{ route('connections.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My team </a>
            </div>

            <!-- Profile Dropdown -->
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

    <div class="pt-32 max-w-6xl mx-auto px-6">
        
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition group">
                <div class="w-8 h-8 rounded-full bg-dark-800 flex items-center justify-center border border-dark-700 group-hover:border-primary-500 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </div>
                <span class="text-sm font-bold">Back to Market</span>
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm flex items-center gap-2 animate-pulse">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Job Details -->
            <div class="lg:col-span-2 space-y-6">
                <div class="glass-panel p-8 rounded-3xl">
                    
                    <div class="flex justify-between items-start mb-6">
                        <h1 class="text-3xl font-bold text-white leading-tight">{{ $job->title }}</h1>
                        <span class="bg-primary-500/10 text-primary-400 text-sm font-bold px-3 py-1.5 rounded-lg border border-primary-500/20 shadow-sm whitespace-nowrap ml-4">
                            {{ $job->budget ? $job->budget : 'Negotiable' }}
                        </span>
                    </div>

                    <!-- ✅ Job Meta Info: Location, Type, Date -->
                    <div class="flex flex-wrap items-center gap-y-3 gap-x-6 text-sm text-gray-400 mb-8 border-b border-dark-700 pb-6">
                        
                        <!-- Date Posted -->
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Posted {{ $job->created_at->diffForHumans() }}
                        </span>
                        
                        <!-- Job Type (Full Time, Freelance, etc.) -->
                        <span class="flex items-center gap-2 capitalize">
                            <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ str_replace('_', ' ', $job->type ?? 'Freelance') }}
                        </span>

                        <!-- Location Type (Remote, On-Site) -->
                        <span class="flex items-center gap-2 capitalize">
                            <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            {{ ucfirst($job->location_type ?? 'Remote') }}
                        </span>

                        <!-- ✅ Location Name & Map Link -->
                        @if($job->location)
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $job->location }}
                                @if($job->map_link)
                                    <a href="{{ $job->map_link }}" target="_blank" class="text-xs bg-dark-700 hover:bg-dark-600 px-2 py-1 rounded ml-1 border border-dark-600 text-primary-400 hover:text-white transition flex items-center gap-1">
                                        View Map <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                @endif
                            </span>
                        @endif
                    </div>

                    <div class="prose prose-invert prose-p:text-gray-300 prose-headings:text-white max-w-none">
                        <h3 class="text-lg font-bold text-white mb-3">Job Description</h3>
                        <p class="whitespace-pre-line leading-relaxed text-sm">{{ $job->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Action & Client Info -->
            <div class="space-y-6">
                
                <!-- Apply Box / Management Box (Functional) -->
                <div class="glass-panel p-6 rounded-2xl">
                    @if(Auth::check() && Auth::user()->role === 'freelancer' && Auth::user()->id !== $job->user->id)
                        <!-- Freelancer View: Apply -->
                        <form action="{{ route('request.send', $job->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 transition-all transform hover:-translate-y-0.5 active:scale-95 mb-3">
                                Apply Now / Send Request
                            </button>
                        </form>
                        <button class="w-full py-3.5 bg-dark-800 hover:bg-dark-700 border border-dark-700 text-gray-300 hover:text-white font-bold rounded-xl transition-all">
                            Save Job
                        </button>
                    @elseif(Auth::check() && Auth::user()->id === $job->user->id)
                        <!-- Founder View: Management/Accepted Status -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-white mb-2">Job Management & Hires</h3>
                            
                            <!-- Metric: Applicants (Total REAL) -->
                            <div class="flex justify-between items-center bg-dark-800 p-3 rounded-lg border border-dark-700">
                                <span class="text-sm text-gray-400">Total Applicants</span>
                                <span class="text-xl font-bold text-white">{{ $job->requests->count() }}</span>
                            </div>
                            
                            <!-- ✅ List of Accepted Applicants (REAL DATA ASSUMPTION) -->
                            @php
                                // جلب الطلبات المقبولة
                                $acceptedApplicants = $job->acceptedRequests;
                            @endphp

                            @if($acceptedApplicants->count() > 0)
                                <div class="p-3 bg-green-500/10 rounded-lg border border-green-500/20 shadow-lg">
                                    <span class="text-xs text-green-400 font-bold uppercase tracking-widest block mb-2">Hired Team Members ({{ $acceptedApplicants->count() }})</span>
                                    <ul class="space-y-1">
                                        @foreach($acceptedApplicants as $request)
                                            <li class="flex justify-between items-center text-sm">
                                                <span class="text-white font-medium">{{ $request->sender->name }}</span>
                                                <!-- Link to accepted freelancer profile -->
                                                <a href="{{ route('freelancer.show', $request->sender->id) }}" class="text-xs text-green-300 bg-green-900/30 px-2 py-0.5 rounded-full hover:underline">View Profile</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="p-3 bg-dark-700/50 rounded-lg border border-dark-700">
                                    <span class="text-sm text-gray-500">No applicants have accepted yet.</span>
                                </div>
                            @endif

                            <!-- View All Applications (Existing Link) -->
                            <a href="{{ route('jobs.applications.show', $job->id) }}" class="w-full py-3.5 mt-5 bg-primary-600 hover:bg-primary-500 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 transition-all flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-2-2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2z"></path></svg>
                                View All Applications
                            </a>
                        </div>
                    @else
                        <!-- Unauthenticated or Owner is viewing -->
                        <button disabled class="w-full py-3.5 bg-dark-700 text-gray-500 font-bold rounded-xl mb-3 cursor-not-allowed">
                            Login to Apply
                        </button>
                    @endif
                </div>

                <!-- Client Card -->
                <div class="glass-panel p-6 rounded-2xl text-center">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-5">About the Client</h3>
                    
                    <div class="w-20 h-20 mx-auto rounded-full p-1 bg-dark-900 border border-dark-700 mb-3">
                        @if($job->user && $job->user->profile_image)
                            <img src="{{ asset('storage/' . $job->user->profile_image) }}" class="w-full h-full rounded-full object-cover">
                        @else
                            <div class="w-full h-full bg-dark-800 rounded-full flex items-center justify-center text-3xl">🏢</div>
                        @endif
                    </div>

                    <h4 class="text-white font-bold text-lg mb-1">{{ $job->user->name ?? 'Unknown' }}</h4>
                    <p class="text-sm text-primary-400 mb-6">{{ $job->user->company_name ?? 'Founder' }}</p>

                    <a href="{{ route('founder.show', $job->user->id) }}" class="block w-full py-2.5 bg-dark-800 hover:bg-dark-700 text-gray-300 hover:text-white text-xs font-bold rounded-lg border border-dark-600 transition">
                        View Company Profile
                    </a>
                </div>

            </div>
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