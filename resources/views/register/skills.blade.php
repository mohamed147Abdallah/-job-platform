<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Skills | شغلني</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Unified Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"Fira Code"', 'monospace'] 
                    },
                    colors: {
                        dark: { 900: '#0B0C15', 800: '#151725', 700: '#1F2235', 600: '#2E3248' },
                        primary: { 400: '#818cf8', 500: '#6366f1', 600: '#4f46e5' }
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #0B0C15; color: #e2e8f0; overflow: hidden; height: 100vh; width: 100vw; }
        
        /* Glow Effect */
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
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            transition: all 0.3s ease;
        }

        /* Tab Styling */
        .tab-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
        }
        .tab-btn.active {
            background: #6366f1;
            color: white;
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
            border-color: #6366f1;
        }

        /* Skill Item Styling */
        .skill-item {
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
        }
        .skill-item:hover {
            border-color: #6366f1;
            background: rgba(99, 102, 241, 0.1);
        }
        .skill-item.selected {
            background: rgba(99, 102, 241, 0.2);
            border-color: #6366f1;
            color: #818cf8;
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.2);
        }

        /* Form Visibility */
        .skills-form-container {
            display: none;
            height: 100%;
        }
        .skills-form-container.active {
            display: flex;
            flex-direction: column;
            animation: fadeIn 0.4s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Custom Scrollbar for Content Area */
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 10px;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(99, 102, 241, 0.5);
        }

        /* Particle Animation */
        .particle {
            position: absolute;
            font-family: monospace;
            font-weight: 700;
            color: rgba(99, 102, 241, 0.2);
            pointer-events: none;
            user-select: none;
            animation: floatUp linear forwards;
        }

        @keyframes floatUp {
            0% { transform: translate3d(0, 20px, 0) rotate(0deg) scale(0.8); opacity: 0; }
            10% { opacity: 0.6; }
            100% { transform: translate3d(var(--tx, 0), -120vh, 0) rotate(var(--rot, 0deg)) scale(1.2); opacity: 0; }
        }
    </style>
</head>
<body class="h-screen w-screen flex items-center justify-center font-sans selection:bg-primary-500 selection:text-white p-6 md:p-12">

    <div class="bg-glow"></div>
    <div id="particleLayer" class="fixed inset-0 z-0 pointer-events-none"></div>

    <!-- Main Horizontal Layout -->
    <main class="relative z-10 w-full max-w-7xl h-full max-h-[800px] grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        
        <!-- Left Side: Header & Info -->
        <div class="lg:col-span-4 flex flex-col justify-center h-full space-y-6">
            <div>
               
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 tracking-tight leading-tight">
                    Showcase <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-primary-600">Your Skills.</span>
                </h1>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Select your specialization and technical stack to help our AI match you with the perfect projects.
                </p>
            </div>
            
           
        </div>

        <!-- Right Side: Interactive Panel -->
        <div class="lg:col-span-8 h-full flex flex-col">
            
            <!-- Navigation Tabs -->
            <div class="flex overflow-x-auto pb-4 gap-3 no-scrollbar mb-2">
                <button class="tab-btn active px-6 py-3 rounded-xl bg-dark-800 border border-dark-600 text-gray-400 text-sm font-bold hover:text-white hover:bg-dark-700" data-target="frontend">Frontend</button>
                <button class="tab-btn px-6 py-3 rounded-xl bg-dark-800 border border-dark-600 text-gray-400 text-sm font-bold hover:text-white hover:bg-dark-700" data-target="backend">Backend</button>
                <button class="tab-btn px-6 py-3 rounded-xl bg-dark-800 border border-dark-600 text-gray-400 text-sm font-bold hover:text-white hover:bg-dark-700" data-target="mobile">Mobile</button>
                <button class="tab-btn px-6 py-3 rounded-xl bg-dark-800 border border-dark-600 text-gray-400 text-sm font-bold hover:text-white hover:bg-dark-700" data-target="data">Data</button>
                <button class="tab-btn px-6 py-3 rounded-xl bg-dark-800 border border-dark-600 text-gray-400 text-sm font-bold hover:text-white hover:bg-dark-700" data-target="ai">AI/ML</button>
            </div>

            <!-- Content Area (Scrollable internally) -->
            <div class="glass-panel flex-1 rounded-3xl overflow-hidden relative border border-white/10">
                <div class="absolute inset-0 overflow-y-auto custom-scroll p-8 md:p-10">
                    
                    <!-- Frontend Form -->
                    <div id="form-frontend" class="skills-form-container active">
                        <form action="{{ route('skills.save') }}" method="POST" class="h-full flex flex-col">
                            @csrf
                            <input type="hidden" name="specialization" value="frontend">
                            <div class="mb-6 sticky top-0 bg-transparent z-10">
                                <h3 class="text-2xl font-bold text-white mb-2">Frontend Development</h3>
                                <p class="text-sm text-gray-400">Select the technologies you are proficient in.</p>
                            </div>
                            
                            <div class="flex flex-wrap gap-3 mb-8">
                                @foreach (['HTML','CSS','JavaScript','TypeScript','React','Vue.js','Angular','SASS/SCSS','Bootstrap','Tailwind CSS','Next.js','Three.js', 'Svelte', 'jQuery', 'Webpack', 'Vite'] as $skill)
                                    <label class="skill-item px-4 py-3 rounded-xl bg-dark-800 border border-dark-600 text-sm font-medium text-gray-300">
                                        {{ $skill }}
                                        <input type="checkbox" name="skills[]" value="{{ $skill }}" class="hidden" onchange="toggleStyle(this)">
                                    </label>
                                @endforeach
                            </div>

                            <div class="mt-auto pt-6 border-t border-white/5">
                                <button type="submit" class="w-full py-4 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 transition-all transform hover:-translate-y-0.5 active:scale-95">
                                    Save Frontend Skills
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Backend Form -->
                    <div id="form-backend" class="skills-form-container">
                        <form action="{{ route('skills.save') }}" method="POST" class="h-full flex flex-col">
                            @csrf
                            <input type="hidden" name="specialization" value="backend">
                            <div class="mb-6">
                                <h3 class="text-2xl font-bold text-white mb-2">Backend Development</h3>
                                <p class="text-sm text-gray-400">Select your server-side technologies.</p>
                            </div>
                            
                            <div class="flex flex-wrap gap-3 mb-8">
                                @foreach (['PHP','Laravel','Node.js','Express.js','Python','Django','Flask','Java','Spring Boot','MySQL','PostgreSQL','Redis','Docker','AWS', 'Go', 'Ruby', 'Ruby on Rails', 'MongoDB', 'GraphQL'] as $skill)
                                    <label class="skill-item px-4 py-3 rounded-xl bg-dark-800 border border-dark-600 text-sm font-medium text-gray-300">
                                        {{ $skill }}
                                        <input type="checkbox" name="skills[]" value="{{ $skill }}" class="hidden" onchange="toggleStyle(this)">
                                    </label>
                                @endforeach
                            </div>

                            <div class="mt-auto pt-6 border-t border-white/5">
                                <button type="submit" class="w-full py-4 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 transition-all">
                                    Save Backend Skills
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Mobile Form -->
                    <div id="form-mobile" class="skills-form-container">
                        <form action="{{ route('skills.save') }}" method="POST" class="h-full flex flex-col">
                            @csrf
                            <input type="hidden" name="specialization" value="mobile">
                            <div class="mb-6">
                                <h3 class="text-2xl font-bold text-white mb-2">Mobile Development</h3>
                                <p class="text-sm text-gray-400">Select your mobile app frameworks.</p>
                            </div>
                            
                            <div class="flex flex-wrap gap-3 mb-8">
                                @foreach (['Flutter','React Native','Kotlin','Swift','Java (Android)','Ionic','Objective-C','Xamarin', 'SwiftUI', 'Dart'] as $skill)
                                    <label class="skill-item px-4 py-3 rounded-xl bg-dark-800 border border-dark-600 text-sm font-medium text-gray-300">
                                        {{ $skill }}
                                        <input type="checkbox" name="skills[]" value="{{ $skill }}" class="hidden" onchange="toggleStyle(this)">
                                    </label>
                                @endforeach
                            </div>

                            <div class="mt-auto pt-6 border-t border-white/5">
                                <button type="submit" class="w-full py-4 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 transition-all">
                                    Save Mobile Skills
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Data Form -->
                    <div id="form-data" class="skills-form-container">
                        <form action="{{ route('skills.save') }}" method="POST" class="h-full flex flex-col">
                            @csrf
                            <input type="hidden" name="specialization" value="data">
                            <div class="mb-6">
                                <h3 class="text-2xl font-bold text-white mb-2">Data Science & Analytics</h3>
                                <p class="text-sm text-gray-400">Select your data tools and languages.</p>
                            </div>
                            
                            <div class="flex flex-wrap gap-3 mb-8">
                                @foreach (['SQL','NoSQL','Excel','Power BI','Tableau','Python (Pandas)','R','Apache Spark','Hadoop','BigQuery', 'Snowflake', 'Matplotlib', 'Seaborn'] as $skill)
                                    <label class="skill-item px-4 py-3 rounded-xl bg-dark-800 border border-dark-600 text-sm font-medium text-gray-300">
                                        {{ $skill }}
                                        <input type="checkbox" name="skills[]" value="{{ $skill }}" class="hidden" onchange="toggleStyle(this)">
                                    </label>
                                @endforeach
                            </div>

                            <div class="mt-auto pt-6 border-t border-white/5">
                                <button type="submit" class="w-full py-4 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 transition-all">
                                    Save Data Skills
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- AI Form -->
                    <div id="form-ai" class="skills-form-container">
                        <form action="{{ route('skills.save') }}" method="POST" class="h-full flex flex-col">
                            @csrf
                            <input type="hidden" name="specialization" value="ai">
                            <div class="mb-6">
                                <h3 class="text-2xl font-bold text-white mb-2">AI & Machine Learning</h3>
                                <p class="text-sm text-gray-400">Select your AI frameworks.</p>
                            </div>
                            
                            <div class="flex flex-wrap gap-3 mb-8">
                                @foreach (['Python','TensorFlow','PyTorch','OpenCV','Scikit-Learn','NLP','Deep Learning','Keras','Computer Vision','LLMs', 'LangChain', 'Hugging Face'] as $skill)
                                    <label class="skill-item px-4 py-3 rounded-xl bg-dark-800 border border-dark-600 text-sm font-medium text-gray-300">
                                        {{ $skill }}
                                        <input type="checkbox" name="skills[]" value="{{ $skill }}" class="hidden" onchange="toggleStyle(this)">
                                    </label>
                                @endforeach
                            </div>

                            <div class="mt-auto pt-6 border-t border-white/5">
                                <button type="submit" class="w-full py-4 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 transition-all">
                                    Save AI/ML Skills
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script>
        // --- 1. Toggle Skill Style ---
        function toggleStyle(checkbox) {
            const label = checkbox.parentElement;
            if (checkbox.checked) {
                label.classList.add('selected');
            } else {
                label.classList.remove('selected');
            }
        }

        // --- 2. Tab Logic ---
        const tabs = document.querySelectorAll('.tab-btn');
        const forms = document.querySelectorAll('.skills-form-container');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                const target = tab.getAttribute('data-target');
                forms.forEach(form => {
                    form.classList.remove('active');
                    if (form.id === 'form-' + target) {
                        setTimeout(() => form.classList.add('active'), 50);
                    }
                });
            });
        });

        // --- 3. Particles Animation ---
        (function() {
            const layer = document.getElementById('particleLayer');
            const symbols = ["</>", "{ }", "()", "=>", ";", "dev", "class", "laravel", "error", "<>", "html", "css", "npm", "git"];
            const MAX_PARTICLES = 25;
            const SPAWN_INTERVAL = 400;

            function createParticle() {
                const p = document.createElement('div');
                p.className = 'particle';
                p.textContent = symbols[Math.floor(Math.random() * symbols.length)];

                const vw = window.innerWidth;
                const vh = window.innerHeight;

                const startX = Math.random() * vw;
                const size = 12 + Math.random() * 16;
                p.style.fontSize = size + 'px';

                const tx = (Math.random() - 0.5) * (vw * 0.2);
                const rot = (Math.random() - 0.5) * 180;
                const dur = 6000 + Math.random() * 6000;
                const startY = vh + 50;

                p.style.left = startX + 'px';
                p.style.top = startY + 'px';
                p.style.setProperty('--tx', tx + 'px');
                p.style.setProperty('--rot', rot + 'deg');
                p.style.animation = `floatUp ${dur}ms linear forwards`;

                p.addEventListener('animationend', () => {
                    p.remove();
                });

                layer.appendChild(p);
            }

            setInterval(() => {
                if (layer.children.length < MAX_PARTICLES) {
                    createParticle();
                }
            }, SPAWN_INTERVAL);
        })();
    </script>

</body>
</html>