<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with {{ (auth()->id() === $conversation->founder_id ? $conversation->freelancer->name : $conversation->founder->name) }} | شغلني</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/rGKqcHVS/Chat-GPT-Image-Dec-23-2025-08-15-13-PM.png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Unified Font -->
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
        body { background-color: #0B0C15; color: #e2e8f0; overflow: hidden; }
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; }
        
        .bg-glow {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100vw; height: 100vh;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, rgba(11, 12, 21, 0) 60%);
            z-index: -1; pointer-events: none;
        }
        
        .glass-panel {
            background: rgba(21, 23, 37, 0.75); backdrop-filter: blur(30px); border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* Bubble Styles with Tails */
        .chat-bubble-me { 
            background: linear-gradient(135deg, #6366f1, #4f46e5) !important; color: white !important; 
            border-radius: 1.25rem 1.25rem 0 1.25rem !important; position: relative;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }
        .chat-bubble-me::after {
            content: ''; position: absolute; bottom: 0; right: -7px;
            width: 15px; height: 15px; background: #4f46e5; clip-path: polygon(0 0, 0% 100%, 100% 100%);
        }

        .chat-bubble-other { 
            background: #1F2235 !important; color: #e2e8f0 !important; 
            border-radius: 1.25rem 1.25rem 1.25rem 0 !important; border: 1px solid rgba(255, 255, 255, 0.05) !important;
            position: relative;
        }
        .chat-bubble-other::before {
            content: ''; position: absolute; bottom: 0; left: -7px;
            width: 15px; height: 15px; background: #1F2235; clip-path: polygon(100% 0, 100% 100%, 0 100%);
        }
        
        .chat-message-text a { color: #67e8f9; text-decoration: underline; font-weight: 800; }
        .attachment-card { background: rgba(0, 0, 0, 0.35); border: 1px solid rgba(255, 255, 255, 0.1); min-width: 280px; }

        /* Modern Delete Button */
        .delete-btn { 
            opacity: 0; transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); transform: scale(0.8);
            background: rgba(239, 68, 68, 0.15); backdrop-filter: blur(8px);
            border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 50%;
            width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .msg-group:hover .delete-btn { opacity: 1; transform: scale(1); }
        .delete-btn:hover { background: #ef4444 !important; color: white !important; }

        .input-wrapper {
            background: rgba(15, 17, 26, 0.8); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 -10px 25px -5px rgba(0,0,0,0.3);
        }

        @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .msg-animate { animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
        .msg-sending { opacity: 0.6; filter: grayscale(0.5); }
    </style>
</head>
<body class="h-screen w-screen flex flex-col font-sans selection:bg-primary-500 selection:text-white overflow-hidden">

    <div class="bg-glow"></div>

    <!-- منطقة الشات الرئيسية -->
    <div class="flex-1 flex items-center justify-center p-4 overflow-hidden">
        <div class="w-full max-w-7xl h-full flex flex-col glass-panel rounded-[2.5rem] overflow-hidden">
            
            @php
                $myId = auth()->id();
                $otherUser = (int)$myId === (int)$conversation->founder_id ? $conversation->freelancer : $conversation->founder;
                $profileRoute = $otherUser->role === 'founder' ? route('founder.show', $otherUser->id) : route('freelancer.show', $otherUser->id);

                if (!function_exists('linkify')) {
                    function linkify($text) {
                        if (!$text || $text === "null") return "";
                        $urlPattern = '/(https?:\/\/[^\s]+)/';
                        return preg_replace($urlPattern, '<a href="$1" target="_blank" rel="noopener noreferrer" class="underline font-bold text-cyan-300">$1</a>', e($text));
                    }
                }
            @endphp

            <!-- الهيدر -->
            <div class="flex justify-between items-center p-6 border-b border-white/5 bg-dark-900/40 backdrop-blur-xl shrink-0">
                <div class="flex items-center gap-5">
                    <a href="{{ route('chat.index') }}" class="text-gray-400 hover:text-white transition p-2.5 bg-white/5 hover:bg-white/10 rounded-2xl border border-white/5 shadow-inner">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-dark-800 border border-white/10 overflow-hidden shadow-2xl relative cursor-pointer" onclick="window.location.href='{{ $profileRoute }}'">
                            <img src="{{ $otherUser->profile_image ? asset('storage/' . $otherUser->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->name) . '&background=151725&color=fff&bold=true&size=128' }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-white leading-none mb-1.5 tracking-tight">{{ $otherUser->name }}</h2>
                            <span class="text-[10px] text-primary-400 font-black uppercase tracking-[0.2em] bg-primary-500/10 px-2 py-0.5 rounded border border-primary-500/20">{{ strtoupper($otherUser->role) }}</span>
                        </div>
                    </div>
                </div>
                <a href="{{ $profileRoute }}" class="px-5 py-2.5 bg-white/5 hover:bg-white/10 text-white text-xs font-black uppercase tracking-widest rounded-xl border border-white/10 transition-all active:scale-95">View Profile</a>
            </div>

            <!-- عرض الرسائل -->
            <div class="flex-1 overflow-y-auto p-8 space-y-10 bg-dark-900/10" id="chat-box">
                @forelse($conversation->messages as $msg)
                    @php 
                        $isMe = (int)$msg->sender_id === (int)$myId; 
                        $cleanMessage = ($msg->message && $msg->message !== 'null') ? trim($msg->message) : null;
                    @endphp
                    
                    <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }} w-full msg-group msg-animate" data-id="{{ $msg->id }}">
                        <div class="flex items-center gap-3 {{ $isMe ? 'flex-row' : 'flex-row-reverse' }}">
                            
                            @if($isMe)
                                <form action="{{ route('chat.message.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Delete message?');" class="order-first">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="delete-btn text-red-500/70" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            @endif

                            <div class="max-w-[450px] px-6 py-4 {{ $isMe ? 'chat-bubble-me' : 'chat-bubble-other' }} shadow-2xl relative">
                                @if(!$isMe)<p class="font-black text-[9px] mb-2.5 text-primary-400 uppercase tracking-widest opacity-90 border-b border-white/5 pb-1">{{ $msg->sender->name }}</p>@endif
                                @if($cleanMessage)<div class="chat-message-text leading-relaxed text-[16px] font-medium mb-1 tracking-tight">{!! linkify($cleanMessage) !!}</div>@endif
                                @if($msg->file_path)
                                    <div class="mt-4 attachment-card rounded-2xl overflow-hidden shadow-inner">
                                        @php $ext = pathinfo($msg->file_path, PATHINFO_EXTENSION); $isImg = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']); @endphp
                                        @if($isImg)
                                            <a href="{{ asset('storage/' . $msg->file_path) }}" target="_blank" class="block group/img relative">
                                                <img src="{{ asset('storage/' . $msg->file_path) }}" class="w-full h-auto max-h-96 object-cover transition duration-700 group-hover:scale-105">
                                            </a>
                                        @else
                                            <div class="p-5 flex items-center gap-5">
                                                <div class="w-16 h-16 bg-dark-900 rounded-2xl flex items-center justify-center border border-white/10 shrink-0 shadow-lg"><svg class="w-9 h-9 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg></div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-base font-bold truncate text-white mb-2">{{ basename($msg->file_path) }}</p>
                                                    <a href="{{ asset('storage/' . $msg->file_path) }}" download class="text-[10px] text-primary-400 font-black uppercase hover:text-white transition flex items-center gap-1.5 bg-primary-500/10 px-3 py-1.5 rounded-lg border border-primary-500/20 w-fit"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>Download</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <div class="text-[10px] mt-3 flex justify-end items-center gap-2">
                                    <span class="font-bold opacity-60">{{ $msg->created_at ? $msg->created_at->format('H:i') : now()->format('H:i') }}</span>
                                    @if($isMe) <svg class="w-4 h-4 {{ $msg->is_read ? 'text-cyan-300' : 'text-white/30' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7m-9 9l4 4L19 7"></path></svg> @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div id="no-messages" class="flex flex-col items-center justify-center h-full opacity-20 text-center"><p class="text-white font-black text-lg uppercase tracking-widest">No Messages Yet</p></div>
                @endforelse
            </div>

            <!-- منطقة الإدخال -->
            <div class="input-wrapper p-6 z-30 shrink-0">
                <form id="chat-form" method="POST" action="{{ route('chat.send', $conversation->id) }}" enctype="multipart/form-data" class="max-w-5xl mx-auto">
                    @csrf
                    <div class="flex gap-4 items-end bg-dark-800 border border-white/10 rounded-[2rem] p-2 pl-4 shadow-2xl focus-within:border-primary-500 transition-all">
                        
                        <div class="relative pb-1">
                            <input type="file" name="attachment" id="attachment-input" class="hidden" onchange="updateFileStatus()">
                            <button type="button" onclick="document.getElementById('attachment-input').click()" 
                                    class="text-gray-400 hover:text-white transition p-3.5 bg-white/5 hover:bg-white/10 rounded-full border border-white/5 relative flex items-center justify-center focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                <span id="file-indicator" class="absolute -top-1 -right-1 w-4 h-4 bg-primary-500 rounded-full border-4 border-dark-900 hidden animate-pulse"></span>
                            </button>
                        </div>

                        <div class="flex-1">
                            <textarea id="message-input" name="message" rows="1" placeholder="Type your message here..." 
                                      class="w-full bg-transparent border-none text-white focus:ring-0 py-4 px-2 text-[15px] placeholder-gray-500 resize-none max-h-32 custom-scroll"></textarea>
                        </div>
                        
                        <div class="pb-1 pr-1">
                            <button type="submit" id="send-btn" class="bg-primary-600 hover:bg-primary-500 text-white w-14 h-14 rounded-full font-black shadow-2xl transition-all transform hover:scale-110 active:scale-90 flex items-center justify-center border border-primary-400/20">
                                <div id="btn-icon"><svg class="w-7 h-7 transform rotate-90 translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg></div>
                                <div id="btn-loader" class="hidden"><svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Logic -->
    <script>
        const chatBox = document.getElementById('chat-box');
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');
        const attachmentInput = document.getElementById('attachment-input');
        const sendBtn = document.getElementById('send-btn');
        const btnIcon = document.getElementById('btn-icon');
        const btnLoader = document.getElementById('btn-loader');
        const conversationId = "{{ $conversation->id }}";
        const scrollKey = `chat_scroll_pos_${conversationId}`;

        // 1. استعادة موقع التمرير عند التحميل
        window.onload = () => {
            const savedScrollPos = sessionStorage.getItem(scrollKey);
            if (savedScrollPos !== null) {
                chatBox.scrollTop = parseInt(savedScrollPos);
            } else {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        };

        // 2. حفظ الموقع عند التمرير اليدوي
        chatBox.addEventListener('scroll', () => {
            sessionStorage.setItem(scrollKey, chatBox.scrollTop);
        });

        // 3. ✅ نظام الإرسال SPA الاحترافي (بدون وميض وبدون اختفاء الرسايل)
        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const msgText = messageInput.value.trim();
            const hasFile = attachmentInput.files.length > 0;
            if (!msgText && !hasFile) return;

            // --- الخطوة 1: الإضافة المتفائلة (Optimistic Append) ---
            const tempId = 'temp-' + Date.now();
            const optimisticHtml = `
                <div class="flex justify-end w-full msg-animate msg-sending" id="${tempId}">
                    <div class="flex items-center gap-3">
                        <div class="max-w-[450px] px-6 py-4 chat-bubble-me shadow-2xl relative">
                            <div class="chat-message-text text-[16px] font-medium mb-1">${msgText || 'Sending attachment...'}</div>
                            <div class="text-[10px] text-right mt-3 opacity-60 italic">Sending...</div>
                        </div>
                    </div>
                </div>`;
            
            if(document.getElementById('no-messages')) document.getElementById('no-messages').remove();
            chatBox.insertAdjacentHTML('beforeend', optimisticHtml);
            chatBox.scrollTo({ top: chatBox.scrollHeight, behavior: 'smooth' });

            // تعطيل الزر
            sendBtn.disabled = true;
            btnIcon.classList.add('hidden');
            btnLoader.classList.remove('hidden');

            const formData = new FormData(chatForm);
            try {
                const response = await fetch(chatForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                if (response.ok) {
                    // مسح الحقول فوراً
                    messageInput.value = "";
                    attachmentInput.value = "";
                    document.getElementById('file-indicator').classList.add('hidden');
                    
                    // --- الخطوة 2: التحديث الذكي (Surgical Update) ---
                    // جلب الصفحة الجديدة ولكن بدلاً من استبدالها كلها، سنبحث عن الرسائل الجديدة
                    const html = await fetch(window.location.href).then(res => res.text());
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newMessagesNodes = doc.getElementById('chat-box').querySelectorAll('.msg-group');
                    
                    // إزالة الرسالة المؤقتة "Sending..."
                    document.getElementById(tempId)?.remove();

                    // إضافة الرسائل التي لم تكن موجودة فقط (بناءً على data-id)
                    newMessagesNodes.forEach(node => {
                        const id = node.getAttribute('data-id');
                        if (!chatBox.querySelector(`[data-id="${id}"]`)) {
                            chatBox.appendChild(node.cloneNode(true));
                        }
                    });
                    
                    // تحديث الـ Storage للقاع
                    sessionStorage.setItem(scrollKey, chatBox.scrollHeight);
                    chatBox.scrollTo({ top: chatBox.scrollHeight, behavior: 'smooth' });
                }
            } catch (error) {
                console.error("Error:", error);
                document.getElementById(tempId)?.remove();
            } finally {
                sendBtn.disabled = false;
                btnIcon.classList.remove('hidden');
                btnLoader.classList.add('hidden');
            }
        });

        function updateFileStatus() { 
            const indicator = document.getElementById('file-indicator');
            if(attachmentInput.files.length > 0) indicator.classList.remove('hidden');
            else indicator.classList.add('hidden');
        }

        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                chatForm.dispatchEvent(new Event('submit'));
            }
        });
    </script>
</body>
</html>