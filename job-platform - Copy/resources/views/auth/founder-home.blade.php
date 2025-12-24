<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Founder Dashboard | شغلني</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Unified Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Blaka&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Noto+Kufi+Arabic:wght@100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=SUSE+Mono:ital,wght@0,100..800;1,100..800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">


    <!-- Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.tailwindcss.com"></script>

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

    <style>
        body {
            background-color: #0B0C15;
            color: #e2e8f0;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        html,
        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

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

        .glass-panel {
            background: rgba(21, 23, 37, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid #1F2235;
            transition: all 0.3s ease;
        }

        /* ✅ Entrance Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .reveal {
            opacity: 0;
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Delays for Content (Starts after Navbar is already there) */
        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        .delay-3 {
            animation-delay: 0.3s;
        }

        .delay-4 {
            animation-delay: 0.4s;
        }

        .delay-5 {
            animation-delay: 0.5s;
        }

        .delay-6 {
            animation-delay: 0.6s;
        }

        /* GSAP Trail Content */
        .trail-content {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
            border-radius: 1.5rem;
        }

        .trail-content__img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 140px;
            opacity: 0;
            border-radius: 12px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        .trail-content__img-inner {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            border-radius: 12px;
        }

        .dropdown-menu {
            display: none;
            transform-origin: top right;
        }

        .dropdown-menu.show {
            display: block;
            animation: scaleIn 0.1s ease-out forwards;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-5px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen font-sans selection:bg-primary-500 selection:text-white pb-12">

    <div class="bg-glow"></div>

    <!-- ✅ Navbar (No Animation - Appears Instantly) -->
    <nav
        class="fixed top-0 w-full z-50 border-b border-dark-700 bg-dark-900/80 backdrop-blur-xl h-16 flex items-center">
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
                <a href="{{ route('dashboard') }}"
                    class="text-white font-medium text-sm border-b-2 border-primary-500 py-5">Dashboard</a>
                <a href="{{ route('projects') }}"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Projects</a>
                <a href="{{ route('jobs.my') }}"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My Jobs</a>
                <a href="{{ route('freelancers.index') }}"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Members</a>
                <a href="{{ route('chat.index') }}"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Message</a>
                <a href="{{ route('connections.index') }}"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium">My team </a>
            </div>

            <div class="relative">
                <button id="profileToggle"
                    class="w-9 h-9 rounded-full border border-dark-700 overflow-hidden hover:border-primary-500 transition-colors focus:outline-none">
                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=151725&color=fff' }}"
                        class="w-full h-full object-cover">
                </button>
                <div id="profileMenu"
                    class="dropdown-menu absolute right-0 top-12 w-56 bg-dark-800 border border-dark-700 rounded-xl shadow-xl py-1 z-50 ring-1 ring-black ring-opacity-5">
                    <div class="px-4 py-3 border-b border-dark-700">
                        <p class="text-sm text-white font-bold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }} Account</p>
                    </div>
                    <a href="{{ route('profile') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:bg-dark-700 hover:text-white transition">Settings</a>
                    <form action="{{ route('logout') }}" method="POST"> @csrf <button
                            class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-dark-700 transition">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-24 max-w-7xl mx-auto px-6">

        <!-- Welcome Header (Reveal Delay 1) -->
        <header
            class="relative h-[280px] flex flex-col justify-center mb-10 rounded-3xl border border-dark-700 bg-dark-800/30 overflow-hidden reveal delay-1"
            id="heroSection">
            <div class="trail-content">
                <div class="trail-content__img">
                    <div class="trail-content__img-inner"
                        style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=300')">
                    </div>
                </div>
                <div class="trail-content__img">
                    <div class="trail-content__img-inner"
                        style="background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?w=300')">
                    </div>
                </div>
                <div class="trail-content__img">
                    <div class="trail-content__img-inner"
                        style="background-image: url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=300')">
                    </div>
                </div>
                <div class="trail-content__img">
                    <div class="trail-content__img-inner"
                        style="background-image: url('https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=300')">
                    </div>
                </div>
            </div>

            <div class="relative z-10 px-10 pointer-events-none">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-400 text-xs font-bold mb-4 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span> Founder Dashboard
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-2 tracking-tight">Hello,
                    {{ explode(' ', Auth::user()->name)[0] }}</h1>
                <p class="text-gray-400 text-lg">Here's the overview for <span
                        class="text-white font-semibold">{{ Auth::user()->company_name ?? 'Your Company' }}</span>.</p>
            </div>
        </header>

        <!-- KPI Stats Grid (Staggered Reveal Delay 2, 3, 4) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="glass-panel p-5 rounded-2xl reveal delay-2">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-blue-500/10 rounded-lg text-blue-400 border border-blue-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs text-green-400 font-bold flex items-center gap-1">On Track</span>
                </div>
                <div class="text-3xl font-bold text-white mb-1">{{ $projects->count() }}</div>
                <div class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Active Projects</div>
            </div>

            <div class="glass-panel p-5 rounded-2xl reveal delay-3">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-purple-500/10 rounded-lg text-purple-400 border border-purple-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-white mb-1">{{ $myPostedJobsCount }}</div>
                <div class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Total Job Posts</div>
            </div>

            <div class="glass-panel p-5 rounded-2xl reveal delay-4">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-orange-500/10 rounded-lg text-orange-400 border border-orange-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    @if ($openJobsCount > 0)
                        <span
                            class="text-xs text-orange-400 font-bold bg-orange-500/10 px-2 py-1 rounded border border-orange-500/20">Hiring</span>
                    @endif
                </div>
                <div class="text-3xl font-bold text-white mb-1">{{ $openJobsCount }}</div>
                <div class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Open Positions</div>
            </div>
        </div>

        <!-- Charts & Lists Row (Reveal Delay 5) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8 reveal delay-5">
            <div class="lg:col-span-2 glass-panel p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="w-1 h-5 bg-primary-500 rounded-full"></span>
                        Project Activity
                    </h3>
                </div>
                <div id="activityChart" class="w-full h-64"></div>
            </div>

            <div class="glass-panel p-6 rounded-2xl flex flex-col">
                <h3 class="text-lg font-bold text-white mb-6">Quick Actions</h3>
                <div class="flex flex-col gap-4">
                    <a href="{{ route('projects.create') }}"
                        class="flex items-center justify-between p-4 rounded-xl bg-dark-800 border border-dark-700 hover:border-primary-500/50 hover:bg-dark-700 transition group cursor-pointer shadow-inner">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-primary-500/10 flex items-center justify-center text-primary-500 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-sm font-bold text-white block">Initialize Project</span>
                                <span class="text-xs text-gray-500">Create a new workspace</span>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('jobs.create') }}"
                        class="flex items-center justify-between p-4 rounded-xl bg-dark-800 border border-dark-700 hover:border-green-500/50 hover:bg-dark-700 transition group cursor-pointer shadow-inner">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center text-green-500 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-sm font-bold text-white block">Post a Job</span>
                                <span class="text-xs text-gray-500">Find new talent</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Table (Reveal Delay 6) -->
        <div class="glass-panel rounded-2xl overflow-hidden mb-10 reveal delay-6">
            <div class="p-6 border-b border-dark-700 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white">Your Active Projects</h3>
                <a href="{{ route('projects') }}"
                    class="text-xs font-semibold text-primary-400 hover:text-primary-300 transition">View All &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-dark-800/50 text-xs uppercase text-gray-500 font-bold">
                        <tr>
                            <th class="px-6 py-4">Project Name</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Repository</th> 
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-700/50 text-sm text-gray-300">
                        @forelse($projects as $project)
                            <tr class="hover:bg-dark-800/30 transition group">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white group-hover:text-primary-400 transition-colors">
                                        {{ $project->title }}</div>
                                </td>
                                
                                <!-- ✅ Link Column as an Image/Icon Button -->
                                
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-green-500/10 text-green-400 border border-green-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($project->link)
                                        <a href="{{ $project->link }}" target="_blank" 
                                           class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-dark-900 border border-dark-700 text-primary-400 hover:text-white hover:bg-primary-600 hover:border-primary-500 transition-all shadow-inner group/link"
                                           title="Visit Repository">
                                            <!-- GitHub Icon Placeholder -->
                                            <svg class="w-5 h-5 transition-transform group-hover/link:scale-110" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.041-1.416-4.041-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                        </a>
                                    @else
                                        <div class="w-10 h-10 rounded-xl bg-dark-900 border border-dark-700 text-dark-600 flex items-center justify-center opacity-40" title="No link provided">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                        </div>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('projects.show', $project->id) }}"
                                        class="text-xs font-bold text-white bg-dark-700 hover:bg-primary-600 px-3 py-1.5 rounded transition shadow-inner">Manage</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">No active projects found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('profileToggle');
            const menu = document.getElementById('profileMenu');
            if (toggle && menu) {
                toggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    menu.classList.toggle('show');
                });
                document.addEventListener('click', (e) => {
                    if (!toggle.contains(e.target)) menu.classList.remove('show');
                });
            }

            // ApexCharts Config
            var options = {
                series: [{
                    name: 'Activity',
                    data: @json($chartValues)
                }],
                chart: {
                    type: 'area',
                    height: 250,
                    toolbar: {
                        show: false
                    },
                    background: 'transparent'
                },
                colors: ['#6366f1'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    categories: @json($chartLabels),
                    labels: {
                        style: {
                            colors: '#94a3b8'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#94a3b8'
                        }
                    }
                },
                grid: {
                    borderColor: '#1F2235',
                    strokeDashArray: 4
                },
                tooltip: {
                    theme: 'dark'
                }
            };
            new ApexCharts(document.querySelector("#activityChart"), options).render();

            // GSAP Image Trail
            class ImageItem {
                constructor(el) {
                    this.DOM = {
                        el: el,
                        inner: el.querySelector('.trail-content__img-inner')
                    };
                }
            }
            class ImageTrail {
                constructor(container) {
                    this.container = container;
                    this.interactionArea = container.parentElement;
                    this.images = [...container.querySelectorAll('.trail-content__img')].map(img =>
                        new ImageItem(img));
                    this.imagesTotal = this.images.length;
                    this.imgPosition = 0;
                    this.zIndexVal = 1;
                    this.mousePos = {
                        x: 0,
                        y: 0
                    };
                    this.lastMousePos = {
                        x: 0,
                        y: 0
                    };
                    this.cacheMousePos = {
                        x: 0,
                        y: 0
                    };
                    this.interactionArea.addEventListener('mousemove', ev => {
                        const rect = this.interactionArea.getBoundingClientRect();
                        this.mousePos = {
                            x: ev.clientX - rect.left,
                            y: ev.clientY - rect.top
                        };
                    });
                    requestAnimationFrame(() => this.render());
                }
                render() {
                    this.cacheMousePos.x += (this.mousePos.x - this.cacheMousePos.x) * 0.1;
                    this.cacheMousePos.y += (this.mousePos.y - this.cacheMousePos.y) * 0.1;
                    if (Math.hypot(this.mousePos.x - this.lastMousePos.x, this.mousePos.y - this.lastMousePos
                            .y) > 100) {
                        this.showNextImage();
                        this.lastMousePos = {
                            ...this.mousePos
                        };
                    }
                    requestAnimationFrame(() => this.render());
                }
                showNextImage() {
                    ++this.zIndexVal;
                    this.imgPosition = (this.imgPosition + 1) % this.imagesTotal;
                    const img = this.images[this.imgPosition];
                    gsap.killTweensOf(img.DOM.el);
                    gsap.timeline().fromTo(img.DOM.el, {
                            opacity: 1,
                            scale: 0.5,
                            zIndex: this.zIndexVal,
                            x: this.cacheMousePos.x - 50,
                            y: this.cacheMousePos.y - 70
                        }, {
                            duration: 0.4,
                            scale: 1,
                            x: this.mousePos.x - 50,
                            y: this.mousePos.y - 70
                        })
                        .to(img.DOM.el, {
                            duration: 0.5,
                            opacity: 0,
                            scale: 0.2
                        }, 0.4);
                }
            }
            new ImageTrail(document.querySelector('.trail-content'));
        });
    </script>
</body>

</html>
