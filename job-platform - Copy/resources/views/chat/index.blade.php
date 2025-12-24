<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Messages | شغلني</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- 1. الخطوط (Fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Blaka&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Noto+Kufi+Arabic:wght@100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=SUSE+Mono:ital,wght@0,100..800;1,100..800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- 2. مكتبة Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- 3. إعدادات الألوان (Theme Config) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif']
                    },
                    colors: {
                        dark: {
                            900: '#0B0C15',
                            800: '#151725',
                            700: '#1F2235',
                            600: '#2E3248'
                        },
                        primary: {
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5'
                        }
                    }
                }
            }
        }
    </script>

    <!-- 4. الستايلات الخاصة (Custom CSS) -->
    <style>
        body {
            background-color: #0B0C15;
            color: #e2e8f0;
            overflow-x: hidden;
        }

        /* إخفاء شريط التمرير */
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; }

        /* تأثير التوهج الخلفي */
        .bg-glow {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100vw;
            height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 60%);
            z-index: -1;
            pointer-events: none;
        }

        /* اللوحة الزجاجية */
        .glass-panel {
            background: rgba(21, 23, 37, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
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

        /* Staggered Delays (تبدأ من delay-1 للمحتوى الآن) */
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

    <!-- الخلفية المضيئة -->
    <div class="bg-glow"></div>

    <!-- ✅ Navbar (تمت إزالة الـ Reveal ليظهر فوراً) -->
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
                @php $dashboardRoute = Auth::user()->role === 'founder' ? route('founder.dashboard') : route('dashboard'); @endphp
                <a href="{{ $dashboardRoute }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Dashboard</a>

                <a href="{{ route('projects') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Projects</a>

                @if (Auth::user()->role === 'founder')
                    <a href="{{ route('jobs.my') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Jobs</a>
                    <a href="{{ route('freelancers.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Members</a>
                @else
                    <a href="{{ route('requests.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Requests</a>
                    <a href="{{ route('jobs.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Browse Jobs</a>
                @endif

                <a href="{{ route('chat.index') }}" class="text-white font-medium text-sm relative py-5 border-b-2 border-primary-500">Message</a>
                <a href="{{ route('connections.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My team </a>
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

    <!-- ✅ Main Content (يستمر التتابع هنا) -->
    <div class="pt-32 max-w-4xl mx-auto px-6">

        <!-- Header Section (Reveal Delay 1) -->
        <div class="mb-10 reveal delay-1">
            <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">Active Conversations</h1>
            <p class="text-gray-400">Connect and collaborate with your team.</p>
        </div>

        <!-- ✅ Chat List Container (Staggered Animation for Items - Delay 2) -->
        <div class="glass-panel rounded-2xl overflow-hidden divide-y divide-dark-700/50 reveal delay-2">

            @forelse($conversations as $chat)
                @php
                    // تحديد المستخدم الآخر في المحادثة         
                    $otherUser = auth()->id() === $chat->founder_id ? $chat->freelancer : $chat->founder;
                    // تحديد رابط البروفايل بناءً على الدور
                    $profileRoute = $otherUser->role === 'founder' ? 'founder.show' : 'freelancer.show';
                    // حساب التأخير لكل عنصر ليكون التتابع أسرع قليلاً بعد الهيدر
                    $itemDelay = 0.25 + ($loop->index * 0.06);
                @endphp

                <div class="flex items-center gap-4 p-5 hover:bg-dark-800/50 transition-all group relative reveal" style="animation-delay: {{ $itemDelay }}s">

                    <!-- Link to Chat -->
                    <a href="{{ route('chat.show', $chat->id) }}" class="absolute inset-0 z-0"></a>

                    <!-- Avatar -->
                    <div class="w-14 h-14 rounded-full overflow-hidden border-2 border-dark-600 shrink-0 relative z-10 transition-transform group-hover:scale-105 duration-300">
                        <img src="{{ $otherUser->profile_image ? asset('storage/' . $otherUser->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->name) . '&background=6366f1&color=fff&bold=true' }}"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Details -->
                    <div class="flex-1 min-w-0 relative z-10">
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="text-base font-bold text-white group-hover:text-primary-400 transition-colors truncate">
                                {{ $otherUser->name }}
                            </h3>
                            <span class="text-[10px] text-gray-500 font-mono bg-dark-900/50 px-2 py-0.5 rounded border border-dark-700">{{ $chat->updated_at->diffForHumans() }}</span>
                        </div>

                        <p class="text-sm text-gray-400 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="truncate opacity-80 italic">Job: {{ $chat->job->title ?? 'General Inquiry' }}</span>
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="relative z-20 flex items-center gap-2">
                        <a href="{{ route($profileRoute, $otherUser->id) }}"
                            class="px-4 py-2 rounded-lg border border-dark-600 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-white hover:bg-dark-700 transition shadow-inner">
                            Profile
                        </a>
                        <a href="{{ route('chat.show', $chat->id) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary-600 hover:bg-primary-500 text-white shadow-lg shadow-primary-500/20 transition transform group-hover:translate-x-1 active:scale-90">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>

                </div>
            @empty
                <div class="p-20 text-center reveal delay-1">
                    <div class="w-16 h-16 bg-dark-800 rounded-full flex items-center justify-center mx-auto mb-4 border border-dark-700 shadow-xl">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">No Active Chats</h3>
                    <p class="text-gray-500 text-sm">Start a conversation by accepting a job request from your dashboard.</p>
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