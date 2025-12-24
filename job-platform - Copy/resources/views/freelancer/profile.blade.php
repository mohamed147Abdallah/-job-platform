<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <title>Profile Settings | شغلني</title>
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
        
        /* ✅ Hide Scrollbar Completely */
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

        /* Form Inputs */
        .form-input {
            width: 100%;
            background-color: rgba(11, 12, 21, 0.6);
            border: 1px solid #1F2235;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            color: white;
            transition: all 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        /* Tags Styling */
        .tag-item {
            display: inline-flex; align-items: center;
            background: rgba(99, 102, 241, 0.1); color: #818cf8;
            border: 1px solid rgba(99, 102, 241, 0.2);
            padding: 0.25rem 0.75rem; border-radius: 9999px;
            font-size: 0.875rem; font-weight: 500; margin-right: 0.5rem; margin-bottom: 0.5rem;
        }
        .tag-remove { margin-left: 0.5rem; cursor: pointer; opacity: 0.7; }
        .tag-remove:hover { opacity: 1; }

        /* ✅ Entrance Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .reveal {
            opacity: 0;
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Staggered Delays للمحتوى الداخلي فقط */
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }

        /* Dropdown Animation */
        .dropdown-menu { display: none; transform-origin: top right; }
        .dropdown-menu.show { display: block; animation: scaleIn 0.1s ease-out forwards; }
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
                
                
            </div>

            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST" class="flex items-center"> 
                @csrf 
                <button type="submit" class="px-4 py-1.5 rounded-xl border border-red-500/20 text-red-400 text-xs font-bold hover:bg-red-500 hover:text-white transition-all active:scale-95">
                    Logout
                </button> 
            </form>
        </div>
    </nav>

    <!-- ✅ محتوى الصفحة (يبدأ التتابع من هنا) -->
    <div class="pt-32 max-w-5xl mx-auto px-6">
        
        <!-- Header (Animated Delay 1) -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-10 gap-4 reveal delay-1">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2 tracking-tight leading-tight">Account Settings</h1>
                <p class="text-gray-400">Update your information and public presence.</p>
            </div>
            <span class="px-4 py-1.5 rounded-full bg-dark-800 border border-dark-700 text-xs font-bold text-gray-300 uppercase tracking-wider shadow-sm">
                {{ ucfirst(Auth::user()->role) }} Account
            </span>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm flex items-center gap-2 reveal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column: Avatar & Danger Zone (Animated Delay 2) -->
                <div class="space-y-6 reveal delay-2">
                    <div class="glass-panel p-6 rounded-3xl text-center group">
                        <div class="relative w-32 h-32 mx-auto mb-6 avatar-group cursor-pointer">
                            <div class="w-full h-full rounded-full overflow-hidden border-4 border-dark-800 shadow-2xl relative bg-dark-900 transition-transform group-hover:scale-105 duration-500">
                                <img id="preview-img" src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=151725&color=fff' }}" 
                                     class="w-full h-full object-cover">
                                <label for="profile_image" class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                    <svg class="w-8 h-8 text-white mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="text-[10px] font-bold text-white uppercase tracking-wider">Change Image</span>
                                </label>
                            </div>
                            <input type="file" name="profile_image" id="profile_image" class="hidden" onchange="previewImage(event)">
                        </div>
                        <h3 class="text-white font-bold text-lg transition-colors group-hover:text-primary-400">{{ Auth::user()->name }}</h3>
                        <p class="text-sm text-gray-500 font-medium">{{ Auth::user()->email }}</p>
                    </div>

                    <!-- Danger Zone -->
                    <div class="glass-panel p-6 rounded-3xl border border-red-500/10 hover:border-red-500/30 transition-all duration-300">
                        <h4 class="text-red-400 font-bold text-sm mb-2 flex items-center gap-2">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                             Danger Zone
                        </h4>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Deleting your account is permanent and cannot be reversed.</p>
                        <button type="button" onclick="if(confirm('Are you absolutely sure?')) document.getElementById('delete-form').submit();" 
                                class="w-full py-2.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white text-xs font-bold rounded-xl border border-red-500/20 transition-all active:scale-95">
                            Delete My Account
                        </button>
                    </div>
                </div>

                <!-- ✅ Right Column: Details Form (Animated Delay 3) -->
                <div class="lg:col-span-2 space-y-6 reveal delay-3">
                    <div class="glass-panel p-8 rounded-3xl">
                        <h3 class="text-lg font-bold text-white mb-6 border-b border-dark-700 pb-4">Personal Details</h3>
                        
                        <div class="space-y-6">
                            <!-- Basic Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Full Name</label>
                                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="form-input shadow-inner">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Email Address</label>
                                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="form-input shadow-inner">
                                </div>
                            </div>

                            <!-- Role Fields -->
                            @if(Auth::user()->role === 'founder')
                                <div>
                                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Company Name</label>
                                    <input type="text" name="company_name" value="{{ old('company_name', Auth::user()->company_name) }}" class="form-input shadow-inner" placeholder="Enter company or startup name">
                                </div>
                            @else
                                <div>
                                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Professional Specialization</label>
                                    <input type="text" name="specialization" value="{{ old('specialization', Auth::user()->specialization) }}" class="form-input shadow-inner" placeholder="e.g. Senior Web Developer">
                                </div>

                                <!-- Skills Container -->
                                <div>
                                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Skills & Tags</label>
                                    <div class="form-input min-h-[50px] flex flex-wrap gap-2 focus-within:border-primary-500 shadow-inner" id="skills-wrapper">
                                        <div id="skills-container" class="flex flex-wrap">
                                            @php
                                                $skills = Auth::user()->skills;
                                                if (is_string($skills)) {
                                                    $decoded = json_decode($skills, true);
                                                    $skills = is_array($decoded) ? $decoded : explode(',', $skills);
                                                }
                                                $skills = is_array($skills) ? $skills : [];
                                            @endphp
                                            @foreach ($skills as $skill)
                                                @if (trim($skill) !== '')
                                                    <span class="tag-item">{{ trim($skill) }} <span class="tag-remove" onclick="removeTag(this)">×</span></span>
                                                @endif
                                            @endforeach
                                        </div>
                                        <input type="text" id="skill-input" placeholder="Type skill + Enter..." class="bg-transparent border-none outline-none text-white placeholder-gray-600 flex-1 min-w-[120px]">
                                    </div>
                                    <input type="hidden" name="skills" id="skills-hidden" value="{{ implode(',', array_map('trim', $skills)) }}">
                                </div>
                            @endif

                            <!-- Security -->
                            <div class="pt-6 border-t border-dark-700 mt-6">
                                <h4 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    Security Update
                                </h4>
                                <div class="space-y-4">
                                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">New Password (Optional)</label>
                                    <input type="password" name="password" placeholder="Leave blank to keep current password" class="form-input shadow-inner">
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 flex justify-end">
                            <button type="submit" class="px-10 py-3.5 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold rounded-xl shadow-lg shadow-primary-500/20 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Update Account
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- Hidden Delete Form -->
    <form id="delete-form" action="{{ route('profile.delete') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // Preview selected image
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview-img');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Tag System Logic
        const skillInput = document.getElementById('skill-input');
        if(skillInput) {
            const container = document.getElementById('skills-container');
            const hiddenInput = document.getElementById('skills-hidden');

            skillInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const val = skillInput.value.trim();
                    if (val !== '') {
                        addTag(val);
                        skillInput.value = '';
                    }
                }
            });

            function addTag(text) {
                const existing = [...container.querySelectorAll('.tag-item')].map(t => t.textContent.replace('×', '').trim().toLowerCase());
                if (existing.includes(text.toLowerCase())) return;

                const tag = document.createElement('span');
                tag.className = 'tag-item';
                tag.innerHTML = `${text} <span class="tag-remove" onclick="removeTag(this)">×</span>`;
                container.appendChild(tag);
                updateHiddenInput();
            }

            window.removeTag = function(span) {
                span.parentElement.remove();
                updateHiddenInput();
            }

            function updateHiddenInput() {
                const tags = [...container.querySelectorAll('.tag-item')].map(tag => tag.textContent.replace('×', '').trim());
                hiddenInput.value = tags.join(',');
            }
        }
    </script>
</body>
</html>