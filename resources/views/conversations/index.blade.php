<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
          <span class="text-gray-800">Messages</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="text-red-500 block flex-shrink-0" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l3.235 1.94a2.8 2.8 0 0 0-.233 1.027L1 7.384v5.733l3.479-2.087q.224.414.558.83l-4.002 2.402A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738l-4.002-2.401q.334-.418.558-.831L15 13.117V7.383l-3.002 1.801a2.8 2.8 0 0 0-.233-1.026L15 6.217V5.4a1 1 0 0 0-.53-.882zM7.06.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765zM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
          </svg>
        </h1>

        @if ($conversations->isEmpty())
            <div class="text-center py-16 bg-white rounded-3xl shadow-sm border border-rose-50">
                <span class="mb-4 flex items-center justify-center text-rose-500">
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-envelope-paper-heart" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v1.133l.941.502A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765L2 3.133zm0 2.267-.47.25A1 1 0 0 0 1 5.4v.817l1 .6zm1 3.15 3.75 2.25L8 8.917l1.25.75L13 7.417V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm11-.6 1-.6V5.4a1 1 0 0 0-.53-.882L14 4.267zM8 2.982C9.664 1.309 13.825 4.236 8 8 2.175 4.236 6.336 1.31 8 2.982m7 4.401-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734Z"/>
                  </svg>
                </span>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No messages yet</h3>
                <p class="text-gray-500 mb-6">Start browsing profiles to connect with someone!</p>
                <a href="{{ route('browse.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-500 to-pink-600 text-white font-semibold py-2.5 px-6 rounded-full shadow-md hover:shadow-lg transition-all">
                    Browse Profiles
                </a>
            </div>
        @else
            <div class="bg-white rounded-3xl shadow-sm border border-rose-50 overflow-hidden divide-y divide-gray-50">
                @foreach ($conversations as $conversation)
                    @php
                        $other = $conversation->participants->firstWhere('id', '!=', auth()->id());
                        $latest = $conversation->latestMessage->first();
                        $timestamp = ($latest?->created_at ?? $conversation->updated_at)->toISOString();
                    @endphp
                    <a
                        href="{{ route('conversations.show', $conversation) }}"
                        x-data="convRow({{ $conversation->id }}, {{ (int) $conversation->unread_count }}, {{ Auth::id() }}, @js($latest?->body), @js($timestamp))"
                        class="flex items-center gap-4 p-4 hover:bg-rose-50/50 transition-colors"
                        :class="unread > 0 ? 'bg-rose-50/40' : ''"
                    >
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-rose-400 to-pink-500 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                            {{ strtoupper(substr($other?->name ?? '?', 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-baseline">
                                <span :class="unread > 0 ? 'font-bold text-gray-900' : 'font-semibold text-gray-800'">{{ $other?->name ?? 'Unknown' }}</span>
                                <span class="text-xs text-gray-400 ml-2 flex-shrink-0" x-text="timeAgo(latestTime)"></span>
                            </div>
                            <p
                                class="text-sm truncate mt-0.5"
                                :class="latestBody ? (unread > 0 ? 'text-gray-800 font-medium' : 'text-gray-500') : 'text-gray-400 italic'"
                                x-text="latestBody ?? 'Start the conversation'"
                            ></p>
                        </div>
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            <span
                                x-show="unread > 0"
                                x-text="unread > 9 ? '9+' : unread"
                                class="min-w-[20px] h-5 px-1.5 flex items-center justify-center bg-rose-500 text-white text-[11px] font-bold rounded-full leading-none"
                            ></span>
                            <svg class="w-5 h-5 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    

    <script>
    function convRow(convId, initialUnread, myId, initialBody, initialTime) {
        return {
            unread: initialUnread,
            latestBody: initialBody,
            latestTime: initialTime,
            init() {
                window.Echo.private(`conversation.${convId}`)
                    .listen('.MessageSent', (e) => {
                        this.latestBody = e.body;
                        this.latestTime = e.created_at;
                        if (e.sender_id !== myId) this.unread++;
                    })
                    .listen('.MessagesRead', (e) => {
                        if (e.reader_id === myId) this.unread = 0;
                    });
            },
            timeAgo(iso) {
                if (!iso) return '';
                const diff = Math.floor((Date.now() - new Date(iso).getTime()) / 1000);
                if (diff < 60) return 'just now';
                if (diff < 3600) return Math.floor(diff / 60) + 'm ago';
                if (diff < 86400) return Math.floor(diff / 3600) + 'h ago';
                if (diff < 604800) return Math.floor(diff / 86400) + 'd ago';
                return new Date(iso).toLocaleDateString([], { month: 'short', day: 'numeric' });
            },
        };
    }
    </script>
</x-app-layout>
