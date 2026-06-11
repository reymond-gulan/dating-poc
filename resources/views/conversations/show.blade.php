<x-app-layout>
    @php
        $other = $conversation->participants->firstWhere('id', '!=', $user->id);
    @endphp

    <div
        class="py-6 px-4 sm:px-6 lg:px-8 max-w-2xl mx-auto"
        x-data="chat({{ $conversation->id }}, {{ $user->id }})"
    >
        <!-- Header -->
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('conversations.index') }}" class="w-9 h-9 flex items-center justify-center rounded-full bg-white shadow-sm text-gray-500 hover:text-rose-500 transition-colors flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-rose-400 to-pink-500 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                {{ strtoupper(substr($other?->name ?? '?', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <h2 class="font-bold text-gray-800 truncate">{{ $other?->name ?? 'Unknown' }}</h2>
                <div class="h-4 flex items-center">
                    <template x-if="otherTyping">
                        <span class="flex items-center gap-1 text-xs text-rose-400">
                            typing
                            <span class="flex gap-0.5 items-center pb-0.5">
                                <span class="w-1 h-1 bg-rose-400 rounded-full animate-bounce" style="animation-delay:0ms"></span>
                                <span class="w-1 h-1 bg-rose-400 rounded-full animate-bounce" style="animation-delay:150ms"></span>
                                <span class="w-1 h-1 bg-rose-400 rounded-full animate-bounce" style="animation-delay:300ms"></span>
                            </span>
                        </span>
                    </template>
                    <template x-if="!otherTyping">
                        <span class="text-xs text-gray-400">{{ $other?->profile?->age ? $other->profile->age . ' years old' : '' }}</span>
                    </template>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div
            id="messages-container"
            class="bg-white rounded-3xl shadow-sm border border-rose-50 p-6 mb-4 space-y-3 overflow-y-auto"
            style="min-height: 320px; max-height: 60vh;"
        >
            @forelse ($conversation->messages as $message)
                @php $isMine = $message->sender_id === $user->id; @endphp
                <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}" id="msg-{{ $message->id }}">
                    @if (!$isMine)
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-rose-400 to-pink-500 flex items-center justify-center text-white font-bold text-xs mr-2 flex-shrink-0 self-end">
                            {{ strtoupper(substr($other?->name ?? '?', 0, 1)) }}
                        </div>
                    @endif
                    <div class="max-w-xs sm:max-w-sm">
                        <div class="px-4 py-2.5 rounded-2xl text-sm whitespace-pre-wrap {{ $isMine ? 'bg-gradient-to-r from-rose-500 to-pink-600 text-white rounded-br-sm' : 'bg-gray-100 text-gray-800 rounded-bl-sm' }}">{{ $message->body }}</div>
                        <div class="flex items-center gap-1 mt-1 {{ $isMine ? 'justify-end' : 'justify-start' }}">
                            <p class="text-xs text-gray-400">{{ $message->created_at->format('g:i A') }}</p>
                            @if ($isMine)
                                <span class="text-xs {{ $message->read_at ? 'text-rose-400' : 'text-gray-300' }}" title="{{ $message->read_at ? 'Seen' : 'Sent' }}">
                                    <svg class="w-3.5 h-3.5 inline" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18 7l-1.41-1.41-6.34 6.34 1.41 1.41L18 7zm4.24-1.41L11.66 16.17 7.48 12l-1.41 1.41L11.66 19l12-12-1.42-1.41zM.41 13.41L6 19l1.41-1.41L1.83 12 .41 13.41z"/>
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8" id="empty-state">
                    <span class="text-4xl block mb-2">👋</span>
                    <p class="text-gray-400 text-sm">No messages yet. Say hello!</p>
                </div>
            @endforelse

            <!-- Real-time messages appended here -->
            <template x-for="msg in messages" :key="msg.id">
                <div class="flex" :class="msg.sender_id === myId ? 'justify-end' : 'justify-start'">
                    <template x-if="msg.sender_id !== myId">
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-rose-400 to-pink-500 flex items-center justify-center text-white font-bold text-xs mr-2 flex-shrink-0 self-end">
                            {{ strtoupper(substr($other?->name ?? '?', 0, 1)) }}
                        </div>
                    </template>
                    <div class="max-w-xs sm:max-w-sm">
                        <div class="px-4 py-2.5 rounded-2xl text-sm whitespace-pre-wrap"
                             :class="msg.sender_id === myId
                                 ? 'bg-gradient-to-r from-rose-500 to-pink-600 text-white rounded-br-sm'
                                 : 'bg-gray-100 text-gray-800 rounded-bl-sm'"
                             x-text="msg.body"></div>
                        <div class="flex items-center gap-1 mt-1" :class="msg.sender_id === myId ? 'justify-end' : 'justify-start'">
                            <p class="text-xs text-gray-400" x-text="formatTime(msg.created_at)"></p>
                            <template x-if="msg.sender_id === myId">
                                <span class="text-xs" :class="msg.read_at ? 'text-rose-400' : 'text-gray-300'" :title="msg.read_at ? 'Seen' : 'Sent'">
                                    <svg class="w-3.5 h-3.5 inline" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18 7l-1.41-1.41-6.34 6.34 1.41 1.41L18 7zm4.24-1.41L11.66 16.17 7.48 12l-1.41 1.41L11.66 19l12-12-1.42-1.41zM.41 13.41L6 19l1.41-1.41L1.83 12 .41 13.41z"/>
                                    </svg>
                                </span>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Message Input -->
        <div class="bg-white rounded-2xl shadow-sm border border-rose-50 p-4">
            <form @submit.prevent="send" class="flex gap-3 items-end">
                @csrf
                <textarea
                    x-model="body"
                    x-ref="input"
                    rows="1"
                    placeholder="Type a message..."
                    class="flex-1 resize-none border-gray-200 focus:border-rose-400 focus:ring-rose-400 rounded-xl text-sm"
                    @keydown.enter="if (!$event.shiftKey) { $event.preventDefault(); send(); }"
                    @input="sendTyping()"
                    required
                ></textarea>
                <button
                    type="submit"
                    :disabled="sending || !body.trim()"
                    class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-gradient-to-br from-rose-500 to-pink-600 text-white rounded-full shadow-md hover:shadow-lg active:scale-95 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <svg x-show="!sending" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    <svg x-show="sending" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                </button>
            </form>
            <p class="mt-2 text-[14px] text-gray-800 text-center select-none">
                <kbd class="px-1 py-0.5 bg-gray-100 border border-gray-200 rounded text-[14px]">Enter</kbd> to send
                &nbsp;&bull;&nbsp;
                <kbd class="px-1 py-0.5 bg-gray-100 border border-gray-200 rounded text-[14px]">Shift</kbd> + <kbd class="px-1 py-0.5 bg-gray-100 border border-gray-200 rounded text-[14px]">Enter</kbd> for new line
            </p>
        </div>
    </div>

    <script>
    function chat(conversationId, myId) {
        return {
            conversationId,
            myId,
            body: '',
            messages: [],
            sending: false,
            otherTyping: false,
            _typingTimer: null,
            _lastTypingSent: 0,

            init() {
                this.scrollBottom();

                window.Echo.private(`conversation.${this.conversationId}`)
                    .listen('.MessageSent', (e) => {
                        if (e.sender_id !== this.myId) {
                            this.otherTyping = false;
                            this.messages.push(e);
                            this.$nextTick(() => this.scrollBottom());
                            this.markRead();
                        }
                    })
                    .listen('.MessagesRead', (e) => {
                        if (e.reader_id !== this.myId) {
                            this.messages = this.messages.map(m =>
                                m.sender_id === this.myId ? { ...m, read_at: new Date().toISOString() } : m
                            );
                        }
                    })
                    .listen('.UserTyping', (e) => {
                        if (e.user_id !== this.myId) {
                            this.otherTyping = true;
                            clearTimeout(this._typingTimer);
                            this._typingTimer = setTimeout(() => { this.otherTyping = false; }, 3000);
                        }
                    });
            },

            sendTyping() {
                const now = Date.now();
                if (now - this._lastTypingSent < 1000) return;
                this._lastTypingSent = now;
                fetch(`/conversations/${this.conversationId}/typing`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                });
            },

            async send() {
                const body = this.body.trim();
                if (!body || this.sending) return;

                this.sending = true;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    const res = await fetch(`/conversations/${this.conversationId}/messages`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({ body }),
                    });

                    if (!res.ok) throw new Error('Failed to send');

                    const msg = await res.json();
                    this.messages.push(msg);
                    this.body = '';

                    // Remove empty state if present
                    const empty = document.getElementById('empty-state');
                    if (empty) empty.remove();

                    this.$nextTick(() => {
                        this.scrollBottom();
                        this.$refs.input.focus();
                    });
                } finally {
                    this.sending = false;
                }
            },

            markRead() {
                fetch(`/conversations/${this.conversationId}/messages/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                });
            },

            scrollBottom() {
                const el = document.getElementById('messages-container');
                if (el) el.scrollTop = el.scrollHeight;
            },

            formatTime(iso) {
                const d = new Date(iso);
                return d.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
            },
        };
    }
    </script>
</x-app-layout>
