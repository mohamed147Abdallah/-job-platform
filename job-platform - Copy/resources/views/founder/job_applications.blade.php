<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Applications for {{ $job->title }} | شغلني</title>
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
            position: fixed; top: 0; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 60%);
            z-index: -1; pointer-events: none;
        }
        .glass-panel {
            background: rgba(21, 23, 37, 0.6); backdrop-filter: blur(12px); border: 1px solid #1F2235;
        }
    </style>
</head>
<body class="min-h-screen font-sans selection:bg-primary-500 selection:text-white pb-12">

    <div class="bg-glow"></div>

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 border-b border-dark-700 bg-dark-900/80 backdrop-blur-xl h-16 flex items-center px-6 justify-between">
        <div class="text-white font-bold text-lg">WorkConnect</div>
        <a href="{{ route('jobs.show', $job->id) }}" class="text-gray-400 hover:text-white text-sm font-medium">&larr; Back to Job Details</a>
    </nav>

    <div class="pt-24 max-w-5xl mx-auto px-6">
        
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-white mb-2">Applicants for: <span class="text-primary-400">{{ $job->title }}</span></h1>
            <p class="text-gray-400">Review and manage incoming requests for this position.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm flex items-center gap-2 animate-pulse">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif
        
        <div class="space-y-4">
            {{-- ✅ التكرار على الطلبات الحقيقية من قاعدة البيانات --}}
            @forelse($job->requests as $request)
                @php
                    $isAccepted = $request->status === 'accepted';
                    $isRejected = $request->status === 'declined';
                    $isPending = $request->status === 'pending';
                    $applicant = $request->sender; // الفريلانسر المتقدم
                    
                    $bgColor = $isAccepted ? 'bg-green-900/20' : ($isRejected ? 'bg-red-900/20' : 'bg-dark-800');
                    $borderColor = $isAccepted ? 'border-green-500/50' : ($isRejected ? 'border-red-500/50' : 'border-dark-700');
                @endphp

                <div class="glass-panel p-6 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-4 transition-all {{ $bgColor }} {{ $borderColor }}">
                    
                    <!-- Applicant Info -->
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <div class="w-12 h-12 rounded-full bg-dark-800 overflow-hidden border border-dark-600 shrink-0">
                            @if($applicant->profile_image)
                                <img src="{{ asset('storage/' . $applicant->profile_image) }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($applicant->name) }}&background=6366f1&color=fff" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-lg">{{ $applicant->name }}</h4>
                            <p class="text-primary-400 text-sm">{{ $applicant->specialization ?? 'Freelancer' }}</p>
                        </div>
                    </div>

                    <!-- Status & Actions -->
                    <div class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">
                        
                        <span class="text-xs text-gray-500">{{ $request->created_at->diffForHumans() }}</span>

                        <!-- View Profile -->
                        <a href="{{ route('freelancer.show', $applicant->id) }}" class="px-3 py-1.5 rounded-lg border border-dark-600 text-gray-400 hover:text-white hover:bg-dark-800 transition text-xs font-bold w-full md:w-auto text-center">
                            View Profile
                        </a>
                        
                        @if($isPending)
                            <!-- أزرار القبول والرفض -->
                            <div class="flex gap-2 w-full md:w-auto">
                                <form action="{{ route('jobs.application.reject', $request->id) }}" method="POST" class="flex-1 md:flex-none">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-2 bg-red-600/20 hover:bg-red-600/50 text-red-400 text-xs font-bold rounded-lg transition border border-red-600/50">
                                        Reject
                                    </button>
                                </form>
                                <form action="{{ route('jobs.application.accept', $request->id) }}" method="POST" class="flex-1 md:flex-none">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-500 text-white text-xs font-bold rounded-lg transition">
                                        Accept
                                    </button>
                                </form>
                            </div>
                        @elseif($isAccepted)
                            <!-- حالة القبول: زر التواصل -->
                            <div class="flex gap-3">
                                <span class="px-3 py-1.5 rounded-lg bg-green-500 text-white text-xs font-bold shadow-md">
                                    HIRED
                                </span>
                                <!-- ✅ تم تعديل الرابط ليوجه إلى الشات (chat.index) -->
                                <a href="{{ route('chat.index') }}" class="px-3 py-1.5 rounded-lg bg-dark-700 text-primary-400 text-xs font-bold border border-dark-600 hover:bg-dark-600 transition flex items-center gap-1 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                    Chat Now
                                </a>
                            </div>
                        @elseif($isRejected)
                            <!-- حالة الرفض -->
                            <span class="px-3 py-1.5 rounded-lg bg-red-900/50 text-red-400 text-xs font-bold border border-red-400/50">
                                REJECTED
                            </span>
                        @endif

                    </div>
                </div>
            @empty
                <div class="glass-panel rounded-2xl overflow-hidden p-12 text-center border-dashed border-dark-700">
                    <p class="text-gray-500">No applicants have applied yet for this job.</p>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>