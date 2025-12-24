<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <title>Home | شغلني</title>
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
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
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
                    },
                    animation: {
                        'slide-up': 'slideUp 1s ease-out forwards',
                    },
                    keyframes: {
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #0B0C15; color: #e2e8f0; }
        
        /* Background Glow */
        .bg-glow {
            position: fixed;
            top: 0; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 50%);
            z-index: -1;
            pointer-events: none;
        }

        /* Hero Slider */
        .hero-slide {
            position: absolute; inset: 0;
            background-size: cover; background-position: center;
            opacity: 0; transition: opacity 1.5s ease-in-out, transform 8s linear;
            transform: scale(1.05);
        }
        .hero-slide.active { opacity: 0.4; transform: scale(1); }
        
        /* Glass Effect */
        .glass-card {
            background: rgba(21, 23, 37, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid #1F2235;
        }
        
        /* Form Inputs */
        .form-input {
            width: 100%;
            background-color: rgba(11, 12, 21, 0.8);
            border: 1px solid #1F2235;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            color: white;
            transition: all 0.2s;
        }
        .form-input:focus {
            outline: none; border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        /* --- RESTORED ANIMATION CSS (حركتك الأصلية) --- */
        #heroTitle span {
            display: inline-block;
            opacity: 0;
            transform: scale(2);
            animation: popIn 0.6s forwards;
            white-space: pre; /* للحفاظ على المسافات بين الكلمات */
        }

        @keyframes popIn {
            0% {
                opacity: 0;
                transform: scale(2) translateY(-30px);
                color: #6366f1; /* Primary Color start */
            }
            60% {
                opacity: 1;
                transform: scale(1.2) translateY(0);
            }
            100% {
                transform: scale(1);
                opacity: 1;
                color: white;
            }
        }

        .shift-out {
            opacity: 0;
            transform: translateX(-60px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
    </style>
</head>

<body class="min-h-screen font-sans selection:bg-primary-500 selection:text-white">

    <nav class="fixed top-0 w-full z-50 border-b border-dark-700 bg-dark-900/80 backdrop-blur-xl transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            
            <div class="flex items-center gap-12">
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
                    <a href="#" class="text-sm font-medium text-white">Home</a>
                    <a href="#features" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Features</a>
                    <a href="#demo" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Demo</a>
                    <a href="#contact" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Contact</a>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-300 hover:text-white transition-colors">Log in</a>
                <a href="{{ route('register.choose') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold shadow-lg shadow-primary-500/25 transition-all transform hover:-translate-y-0.5">
                    Get Started
                </a>
            </div>
        </div>
    </nav>

    <header class="relative min-h-[85vh] flex items-center justify-center overflow-hidden pt-20">
        <div class="absolute inset-0 bg-dark-900 z-0">
            <div class="hero-slide active" style="background-image:url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1920&q=80');"></div>
            <div class="hero-slide" style="background-image:url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1920&q=80');"></div>
            <div class="hero-slide" style="background-image:url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1920&q=80');"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-dark-900/90 via-dark-900/80 to-dark-900"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-400 text-xs font-bold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span>
                The Future of Work
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tight min-h-[1.2em] transition-all duration-700" id="heroTitle">
                </h1>
            
            <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto leading-relaxed animate-slide-up" style="animation-delay: 0.2s;">
                Connect with top-tier founders and join ambitious teams building the next generation of products.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-slide-up" style="animation-delay: 0.4s;">
                <a href="{{ route('register.choose') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white text-dark-900 font-bold hover:bg-gray-100 transition shadow-[0_0_30px_rgba(255,255,255,0.2)]">
                    Start Your Journey
                </a>
                <a href="#features" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-dark-800 text-white font-bold border border-dark-700 hover:bg-dark-700 transition">
                    Learn More
                </a>
            </div>
        </div>
    </header>

    <section id="features" class="py-24 relative">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-dark-700 to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Why teams love WorkConnect</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">Built for modern workflows, designed to help you move faster.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="glass-card p-8 rounded-2xl hover:border-primary-500/50 transition-colors group">
                    <div class="w-12 h-12 rounded-xl bg-primary-500/10 flex items-center justify-center text-primary-500 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Smart Matching</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Find the right talent instantly with AI-assisted recommendations tailored to your stack.</p>
                </div>

                <div class="glass-card p-8 rounded-2xl hover:border-purple-500/50 transition-colors group">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-500 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Integrated Chat</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Seamless communication with file sharing and real-time messaging built right in.</p>
                </div>

                <div class="glass-card p-8 rounded-2xl hover:border-blue-500/50 transition-colors group">
                    <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Project Tools</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Manage milestones, tasks, and deliverables in one unified dashboard.</p>
                </div>

                <div class="glass-card p-8 rounded-2xl hover:border-green-500/50 transition-colors group">
                    <div class="w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center text-green-500 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Secure Payments</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Escrow-protected payments ensure peace of mind for both founders and freelancers.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="demo" class="py-20 relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-6 relative z-10">
            <div class="rounded-2xl border border-dark-700 bg-dark-800/50 backdrop-blur shadow-2xl overflow-hidden group">
                <div class="h-10 bg-dark-900 border-b border-dark-700 flex items-center px-4 gap-2">
                    <div class="w-3 h-3 rounded-full bg-red-500/50"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500/50"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500/50"></div>
                </div>
               <div class="relative max-w-4xl mx-auto">
    <img src="https://media.giphy.com/media/qgQUggAC3Pfv687qPC/giphy.gif" alt="App Demo" class="w-full h-auto opacity-80 group-hover:opacity-100 transition-opacity">
    <div class="absolute inset-0 bg-gradient-to-t from-dark-900 via-transparent to-transparent opacity-50"></div>
</div>
            </div>
        </div>
    </section>

    <section id="contact" class="py-24 bg-dark-800/30 border-t border-dark-700">
        <div class="max-w-xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Get in touch</h2>
            <p class="text-gray-400 mb-8">Questions, partnerships, or feedback? We'd love to hear from you.</p>
            
            <form class="space-y-4 text-left">
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" placeholder="Name" class="form-input">
                    <input type="email" placeholder="Email" class="form-input">
                </div>
                <textarea rows="4" placeholder="How can we help?" class="form-input resize-none"></textarea>
                <button type="button" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold shadow-lg shadow-primary-500/20 transition-all transform hover:-translate-y-0.5">
                    Send Message
                </button>
            </form>
        </div>
    </section>

    <footer class="py-12 border-t border-dark-700/50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 mb-4 opacity-50">
                <div class="w-6 h-6 rounded bg-gray-700 flex items-center justify-center text-xs font-bold text-white">W</div>
                <span class="font-bold text-gray-300">WorkConnect</span>
            </div>
            <p class="text-sm text-gray-600">© 2025 WorkConnect. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Hero Slider Logic (زي ما هو)
        const slides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;

        function rotateSlides() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }
        setInterval(rotateSlides, 4000);

        // ✅ Text Animation Logic (Fixed Word Breaking)
        const textElement = document.getElementById("heroTitle");
        const phrase = "The best place to start your career";
        
        function animateText() {
            textElement.innerHTML = "";
            // 1. نقسم النص لكلمات الأول عشان نحافظ على تماسك الكلمة
            const words = phrase.split(" ");
            
            let globalCharIndex = 0; // عشان نحسب التأخير الزمني لكل حرف بشكل متتابع

            words.forEach((word, wordIndex) => {
                // 2. نعمل حاوية لكل كلمة تمنع كسرها
                const wordSpan = document.createElement("span");
                // inline-block: عشان يجوا جنب بعض
                // whitespace-nowrap: عشان الكلمة نفسها متتكسرش
                // mr-2: مسافة بين الكلمات بديلة للـ space
                wordSpan.className = "inline-block whitespace-nowrap mr-3"; 

                // 3. نقسم الكلمة لحروف ونطبق الأنيميشن
                word.split("").forEach((ch) => {
                    const charSpan = document.createElement("span");
                    charSpan.textContent = ch;
                    charSpan.className = "inline-block word-anim";
                    
                    // تلوين كلمات معينة
                    if(["best", "start", "career"].includes(word)) {
                        charSpan.className += " text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-purple-500";
                    }

                    // حساب الـ Delay بناءً على ترتيب الحرف في الجملة كلها
                    charSpan.style.animationDelay = `${globalCharIndex * 0.05}s`;
                    
                    wordSpan.appendChild(charSpan);
                    globalCharIndex++;
                });

                textElement.appendChild(wordSpan);
            });
        }
        
        // Initial Trigger
        animateText();
        
        // Loop Animation
        setInterval(() => {
            textElement.classList.add('shift-out');
            setTimeout(() => {
                textElement.classList.remove('shift-out');
                animateText();
            }, 1000);
        }, 8000);
    </script>
</body>
</html>