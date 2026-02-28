<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post a Job | شغلني</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Unified Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Blaka&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Noto+Kufi+Arabic:wght@100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=SUSE+Mono:ital,wght@0,100..800;1,100..800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Leaflet CSS (Free Map) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
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
        
        /* ✅ Hide Scrollbar */
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
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        /* Form Elements */
        input, textarea, select {
            transition: all 0.2s ease;
        }
        input:focus, textarea:focus, select:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
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

        /* Staggered Delays for Internal Content Only */
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }

        /* Dropdown Animation */
        .dropdown-menu { display: none; transform-origin: top right; }
        .dropdown-menu.show { display: block; animation: scaleIn 0.15s ease-out forwards; }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95) translateY(-5px); } to { opacity: 1; transform: scale(1) translateY(0); } }
        
        /* Map Z-Index Fix */
        .leaflet-pane { z-index: 10 !important; }
    </style>
</head>
<body class="min-h-screen font-sans selection:bg-primary-500 selection:text-white pb-12">

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
                @php $dashboardRoute = Auth::user()->role === 'founder' ? route('founder.dashboard') : route('dashboard'); @endphp
                <a href="{{ $dashboardRoute }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Dashboard</a>
                <a href="{{ route('projects') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Projects</a>
                
                @if (Auth::user()->role === 'founder')
                    <a href="{{ route('jobs.my') }}" class="text-white font-medium text-sm border-b-2 border-primary-500 py-5">My Jobs</a>
                    <a href="{{ route('freelancers.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Members</a>
                @else
                    <a href="{{ route('requests.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Requests</a>
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
    <main class="pt-24 max-w-2xl mx-auto px-6">
        
        <!-- Header Section (Animated Delay 1) -->
        <div class="text-center mb-10 reveal delay-1">
            <h1 class="text-3xl font-bold text-white mb-2 tracking-tight leading-tight">Post a New Opportunity</h1>
            <p class="text-gray-400">Describe the role and find the perfect talent for your project.</p>
        </div>

        <!-- Form Card (Animated Delay 2) -->
        <div class="glass-panel p-8 rounded-3xl reveal delay-2">
            
            <!-- Error Handling -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jobs.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Job Title -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Job Title</label>
                    <input type="text" name="title" required placeholder="e.g. Senior Laravel Developer needed" 
                           class="w-full bg-dark-800 border border-dark-700 text-white text-sm rounded-xl py-3 px-4 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 placeholder-gray-600 transition-all shadow-inner">
                </div>

                <!-- Grid for Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Budget -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Budget Estimate</label>
                        <input type="text" name="budget" placeholder="e.g. $500 - $1,000" 
                               class="w-full bg-dark-800 border border-dark-700 text-white text-sm rounded-xl py-3 px-4 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 placeholder-gray-600 transition-all shadow-inner">
                    </div>

                    <!-- Job Type -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Job Type</label>
                        <div class="relative">
                            <select name="type" class="w-full bg-dark-800 border border-dark-700 text-white text-sm rounded-xl py-3 px-4 appearance-none focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 cursor-pointer shadow-inner">
                                <option value="freelance" selected>Freelance</option>
                                <option value="full_time">Full Time</option>
                                <option value="part_time">Part Time</option>
                                <option value="contract">Contract</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Location Type -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Location Type</label>
                        <div class="relative">
                            <select name="location_type" id="locationType" class="w-full bg-dark-800 border border-dark-700 text-white text-sm rounded-xl py-3 px-4 appearance-none focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 cursor-pointer shadow-inner">
                                <option value="remote" selected>Remote</option>
                                <option value="on_site">On-Site</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ✅ Location Details Section -->
                <div class="space-y-4 hidden" id="locationFieldWrapper">
                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">City / Address</label>
                        <input type="text" name="location" id="locationInput" placeholder="Enter specific location" 
                               class="w-full bg-dark-800 border border-dark-700 text-white text-sm rounded-xl py-3 px-4 focus:outline-none focus:border-primary-500 shadow-inner">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Google Maps Link</label>
                        <div class="relative">
                             <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </div>
                            <input type="url" name="map_link" placeholder="https://maps.app.goo.gl/..." 
                                   class="w-full bg-dark-800 border border-dark-700 text-white text-sm rounded-xl py-3 pl-10 pr-4 focus:outline-none focus:border-primary-500 shadow-inner">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Pin Exact Location</label>
                        <div id="map" class="w-full h-64 rounded-xl border border-dark-700 overflow-hidden relative z-0"></div>
                    </div>

                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                </div>

                <!-- Description -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Job Description</label>
                    <textarea name="description" rows="6" required placeholder="Describe the project requirements..." 
                              class="w-full bg-dark-800 border border-dark-700 text-white text-sm rounded-xl py-3 px-4 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 placeholder-gray-600 resize-none transition-all shadow-inner"></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-4">
                    <a href="{{ route('jobs.my') }}" class="w-1/3 py-3.5 bg-dark-700 hover:bg-dark-600 text-white font-bold rounded-xl text-center transition-all border border-dark-600 active:scale-95">
                        Cancel
                    </a>
                    <button type="submit" class="w-2/3 py-3.5 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 transition-all transform hover:-translate-y-1 active:scale-95">
                        Post Job Opportunity
                    </button>
                </div>

            </form>
        </div>
    </main>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navbar Logic
            const profileToggle = document.getElementById('profileToggle');
            const profileMenu = document.getElementById('profileMenu');
            if(profileToggle && profileMenu) {
                profileToggle.addEventListener('click', (e) => { 
                    e.stopPropagation(); 
                    profileMenu.classList.toggle('show'); 
                });
                document.addEventListener('click', (e) => {
                    if (!profileMenu.contains(e.target) && !profileToggle.contains(e.target)) {
                        profileMenu.classList.remove('show');
                    }
                });
            }

            // Map Logic
            const locationTypeSelect = document.getElementById('locationType');
            const locationWrapper = document.getElementById('locationFieldWrapper');
            const locationInput = document.getElementById('locationInput');
            let map;
            let marker;

            function initMap() {
                const defaultLocation = [30.0444, 31.2357]; // Cairo
                map = L.map('map').setView(defaultLocation, 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
                map.on('click', function(e) { placeMarker(e.latlng); });
            }

            function placeMarker(latlng) {
                if (marker) marker.setLatLng(latlng);
                else marker = L.marker(latlng).addTo(map);
                document.getElementById('latitude').value = latlng.lat;
                document.getElementById('longitude').value = latlng.lng;
                if(locationInput.value === '') locationInput.value = `${latlng.lat.toFixed(5)}, ${latlng.lng.toFixed(5)}`;
            }

            function toggleLocationField() {
                const value = locationTypeSelect.value;
                if (value === 'on_site' || value === 'hybrid') {
                    locationWrapper.classList.remove('hidden');
                    locationInput.required = true;
                    if (!map) setTimeout(initMap, 100);
                    else setTimeout(() => { map.invalidateSize(); }, 100);
                } else {
                    locationWrapper.classList.add('hidden');
                    locationInput.required = false;
                }
            }

            locationTypeSelect.addEventListener('change', toggleLocationField);
            toggleLocationField();
        });
    </script>

</body>
</html>