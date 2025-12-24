<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Post a Job | شغلني</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        body { background-color: #0B0C15; color: #e2e8f0; }
        .bg-glow {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 50%);
            z-index: -1; pointer-events: none;
        }
        .glass-card { background: rgba(21, 23, 37, 0.6); backdrop-filter: blur(12px); border: 1px solid #1F2235; }
        .form-input {
            width: 100%; background-color: rgba(11, 12, 21, 0.6); border: 1px solid #1F2235;
            border-radius: 0.75rem; padding: 0.75rem 1rem; color: white; transition: all 0.2s;
        }
        .form-input:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); }
        
        /* Loading Animation */
        .sparkle-loading {
            display: inline-block;
            animation: pulse-color 1.5s infinite;
        }
        @keyframes pulse-color {
            0% { color: #818cf8; }
            50% { color: #c084fc; }
            100% { color: #818cf8; }
        }
    </style>
</head>
<body class="min-h-screen font-sans pb-12">
    <div class="bg-glow"></div>

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
            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-400 hover:text-white">Exit</a>
        </div>
    </nav>

    <div class="pt-28 max-w-3xl mx-auto px-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-white transition-colors mb-6 group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Dashboard
        </a>

        <div class="mb-8 flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Post a New Job</h1>
                <p class="text-gray-400 mt-2">Find the perfect talent for your team.</p>
            </div>
            <span class="px-3 py-1 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-400 text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                <span class="text-lg">✨</span> AI Powered
            </span>
        </div>

        <div class="glass-card rounded-2xl p-8">
            <form action="{{ route('jobs.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Job Title</label>
                    <input type="text" name="title" id="jobTitle" class="form-input" placeholder="e.g. Senior React Developer" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Job Type</label>
                        <select name="type" id="jobType" class="form-input appearance-none cursor-pointer">
                            <option value="contract">Contract / Freelance</option>
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Budget / Salary</label>
                        <input type="text" name="budget" class="form-input" placeholder="e.g. $500 - $1000 or $50/hr">
                    </div>
                </div>

                <div class="mb-8 relative">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Description</label>
                        
                        <!-- ✨ AI Button -->
                        <button type="button" onclick="generateDescription()" id="aiBtn" class="text-xs flex items-center gap-1.5 text-primary-400 hover:text-white transition-colors bg-primary-500/10 hover:bg-primary-500/20 border border-primary-500/20 px-3 py-1.5 rounded-lg font-semibold">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z" fill="currentColor"/></svg>
                            Generate with AI
                        </button>
                    </div>
                    
                    <textarea name="description" id="jobDescription" rows="8" class="form-input resize-none leading-relaxed" placeholder="Describe the role, responsibilities, and requirements..." required></textarea>
                    
                    <!-- Loading Overlay -->
                    <div id="loadingOverlay" class="absolute inset-0 bg-dark-800/80 backdrop-blur-sm rounded-xl flex flex-col items-center justify-center z-10 hidden border border-dark-700">
                        <div class="sparkle-loading text-4xl mb-3">✨</div>
                        <p class="text-white font-medium text-sm">Gemini is writing your job description...</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 border-t border-dark-700/50 pt-6">
                    <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-bold shadow-lg shadow-primary-500/25 transition-all transform hover:-translate-y-0.5">
                        Publish Job
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- AI Generation Script -->
    <script>
        async function generateDescription() {
            const title = document.getElementById('jobTitle').value;
            const type = document.getElementById('jobType').value;
            const descriptionField = document.getElementById('jobDescription');
            const btn = document.getElementById('aiBtn');
            const overlay = document.getElementById('loadingOverlay');

            if (!title) {
                alert('Please enter a Job Title first.');
                document.getElementById('jobTitle').focus();
                return;
            }

            // UI State: Loading
            overlay.classList.remove('hidden');
            btn.disabled = true;

            try {
                const response = await fetch('{{ route("gemini.generate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ 
                        prompt: `Write a professional job description for a ${type} position titled "${title}". Include Key Responsibilities and Requirements. Keep it concise and engaging.` 
                    })
                });

                const data = await response.json();

                if (data.text) {
                    // Typewriter effect simulation could go here, but direct set is faster
                    descriptionField.value = data.text;
                } else {
                    alert('Failed to generate content. Please try again.');
                }

            } catch (error) {
                console.error('Error:', error);
                alert('Something went wrong with the AI generation.');
            } finally {
                // UI State: Reset
                overlay.classList.add('hidden');
                btn.disabled = false;
            }
        }
    </script>
</body>
</html>