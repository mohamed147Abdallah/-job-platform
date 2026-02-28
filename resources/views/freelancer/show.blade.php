<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $freelancer->name }} | شغلني</title>
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
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 60%);
            z-index: -1; pointer-events: none;
        }

        .glass-panel {
            background: rgba(21, 23, 37, 0.6); backdrop-filter: blur(12px); border: 1px solid #1F2235;
            transition: all 0.3s ease;
        }

        .project-card:hover { border-color: #6366f1; transform: translateY(-5px); box-shadow: 0 10px 30px -10px rgba(99, 102, 241, 0.2); }

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
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
    </style>
</head>
<body class="min-h-screen pb-12 font-sans selection:bg-primary-500 selection:text-white">

    <div class="bg-glow"></div>

    <div class="pt-32 max-w-5xl mx-auto px-6">

        <!-- ✅ Back Button (Animated Delay 1) -->
        <div class="mb-8 reveal delay-1">
            <a href="{{ route('freelancers.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition group">
                <div class="w-8 h-8 rounded-full bg-dark-800 flex items-center justify-center border border-dark-700 group-hover:border-primary-500 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </div>
                <span class="text-sm font-bold">Back to Talent</span>
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm flex items-center gap-2 animate-pulse reveal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- ✅ Main Profile Card (Animated Delay 2) -->
        <div class="glass-panel rounded-3xl overflow-hidden relative border border-dark-700 mb-10 reveal delay-2">
            <!-- Banner -->
            <div class="h-48 w-full bg-gradient-to-r from-dark-800 via-primary-900/20 to-dark-800 relative">
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
            </div>

            <div class="px-8 pb-8">
                <div class="flex flex-col md:flex-row gap-8 items-start -mt-16 relative z-10">
                    
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="w-32 h-32 rounded-full p-1 bg-dark-900 shadow-2xl relative">
                            <img src="{{ $freelancer->profile_image ? asset('storage/' . $freelancer->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($freelancer->name) . '&background=151725&color=fff&bold=true&size=128' }}" 
                                 class="w-full h-full rounded-full object-cover border-4 border-dark-800">
                            <!-- Availability Dot -->
                            <span class="absolute bottom-2 right-2 w-5 h-5 bg-green-500 border-4 border-dark-900 rounded-full animate-pulse"></span>
                        </div>
                    </div>

                    <!-- Info & Actions -->
                    <div class="flex-1 pt-16 md:pt-16">
                        <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                            <div>
                                <h1 class="text-3xl font-bold text-white mb-1">{{ $freelancer->name }}</h1>
                                <p class="text-primary-400 font-medium text-lg">{{ $freelancer->specialization ?? 'Professional Freelancer' }}</p>
                                <div class="flex items-center gap-4 mt-3 text-sm text-gray-400">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        {{ $freelancer->email }}
                                    </span>
                                    <span class="w-1 h-1 rounded-full bg-dark-700"></span>
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Joined {{ $freelancer->created_at->format('M Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                @if(Auth::check() && Auth::user()->role === 'founder')
                                    <form action="{{ route('request.invite', $freelancer->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 transition transform hover:-translate-y-0.5 flex items-center gap-2 active:scale-95">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                            Invite to Team
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- ✅ Skills Sidebar (Animated Delay 3) -->
            <div class="lg:col-span-1 space-y-6 reveal delay-3">
                <div class="glass-panel p-6 rounded-3xl">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                        Core Expertise
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $skills = $freelancer->skills; 
                            if(is_string($skills)) $skills = json_decode($skills, true) ?? explode(',', $skills);
                            $skills = is_array($skills) ? $skills : [];
                        @endphp

                        @forelse($skills as $skill)
                            <span class="px-3 py-1.5 rounded-lg bg-dark-800 border border-dark-700 text-sm text-gray-300 font-medium hover:border-primary-500 transition-colors cursor-default">
                                {{ trim($skill) }}
                            </span>
                        @empty
                            <span class="text-gray-500 text-sm italic">No skills listed yet.</span>
                        @endforelse
                    </div>
                </div>

                <div class="glass-panel p-6 rounded-3xl">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Availability</h3>
                    <p class="text-sm text-white font-medium">Ready for new projects</p>
                </div>
            </div>

            <!-- ✅ Portfolio Section (Staggered Reveal Delay 4+) -->
            <div class="lg:col-span-2 space-y-6">
                <h3 class="text-xl font-bold text-white flex items-center gap-3 reveal delay-4">
                    <span class="w-1.5 h-6 bg-primary-500 rounded-full"></span>
                    Portfolio Highlights
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($projects as $project)
                        @php $itemDelay = 0.5 + ($loop->index * 0.08); @endphp
                        <div class="glass-panel p-5 rounded-2xl project-card transition-all group border-dark-700 reveal" style="animation-delay: {{ $itemDelay }}s">
                            <div class="flex justify-between items-start mb-3">
                                <div class="w-10 h-10 rounded-lg bg-primary-500/10 flex items-center justify-center text-primary-500 font-bold text-lg group-hover:scale-110 transition-transform">
                                    P
                                </div>
                                <span class="text-[10px] font-bold text-gray-600 uppercase tracking-tighter">{{ $project->created_at->format('M Y') }}</span>
                            </div>
                            <h4 class="text-white font-bold mb-2 group-hover:text-primary-400 transition-colors">{{ $project->title }}</h4>
                            <p class="text-xs text-gray-500 line-clamp-3 leading-relaxed mb-6">{{ $project->description }}</p>
                            
                            @if($project->link)
                                <a href="{{ $project->link }}" target="_blank" class="inline-flex items-center gap-2 text-[10px] font-black text-primary-400 uppercase tracking-widest hover:text-white transition-all">
                                    Project Details 
                                    <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center glass-panel rounded-3xl border-dashed border-dark-700 reveal delay-5">
                            <div class="w-12 h-12 bg-dark-800 rounded-full flex items-center justify-center mx-auto mb-4 border border-dark-700">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <p class="text-gray-500 text-sm">Portfolio is currently empty.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

</body>
</html>