<div x-data="navBadge({{ Auth::id() }})">

<nav class="bg-white/80 backdrop-blur-md border-b border-rose-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <span class="text-2xl text-rose-500">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-balloon-heart" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="m8 2.42-.717-.737c-1.13-1.161-3.243-.777-4.01.72-.35.685-.451 1.707.236 3.062C4.16 6.753 5.52 8.32 8 10.042c2.479-1.723 3.839-3.29 4.491-4.577.687-1.355.587-2.377.236-3.061-.767-1.498-2.88-1.882-4.01-.721zm-.49 8.5c-10.78-7.44-3-13.155.359-10.063q.068.062.132.129.065-.067.132-.129c3.36-3.092 11.137 2.624.357 10.063l.235.468a.25.25 0 1 1-.448.224l-.008-.017c.008.11.02.202.037.29.054.27.161.488.419 1.003.288.578.235 1.15.076 1.629-.157.469-.422.867-.588 1.115l-.004.007a.25.25 0 1 1-.416-.278c.168-.252.4-.6.533-1.003.133-.396.163-.824-.049-1.246l-.013-.028c-.24-.48-.38-.758-.448-1.102a3 3 0 0 1-.052-.45l-.04.08a.25.25 0 1 1-.447-.224l.235-.468ZM6.013 2.06c-.649-.18-1.483.083-1.85.798-.131.258-.245.689-.08 1.335.063.244.414.198.487-.043.21-.697.627-1.447 1.359-1.692.217-.073.304-.337.084-.398"/>
                  </svg>
                </span>
                <span class="font-bold text-xl bg-gradient-to-r from-rose-500 to-pink-600 bg-clip-text text-transparent">
                    {{ config('app.name', 'LaravelMatch') }}
                </span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden sm:flex items-center gap-1">
                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('dashboard') ? 'bg-rose-50 text-rose-600' : 'text-gray-500 hover:text-rose-500 hover:bg-rose-50' }}">
                    Home
                </a>
                <a href="{{ route('browse.index') }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('browse.*') ? 'bg-rose-50 text-rose-600' : 'text-gray-500 hover:text-rose-500 hover:bg-rose-50' }}">
                    Browse
                </a>
                <a href="{{ route('conversations.index') }}"
                   class="relative px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('conversations.*') ? 'bg-rose-50 text-rose-600' : 'text-gray-500 hover:text-rose-500 hover:bg-rose-50' }}">
                    Messages
                    <span x-show="unread > 0" x-text="unread > 9 ? '9+' : unread"
                          class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] px-1 flex items-center justify-center bg-rose-500 text-white text-[10px] font-bold rounded-full leading-none">
                    </span>
                </a>
                <a href="{{ route('dating-profile.edit') }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('dating-profile.*') ? 'bg-rose-50 text-rose-600' : 'text-gray-500 hover:text-rose-500 hover:bg-rose-50' }}">
                    My Profile
                </a>
            </div>

            <!-- User Menu (desktop) -->
            <div class="hidden sm:flex sm:items-center" x-data="{ open: false }">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 group">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-rose-400 to-pink-600 flex items-center justify-center text-white font-semibold text-sm shadow-md">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-rose-500 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            Account Settings
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Bottom Tab Bar -->
<div class="sm:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-t border-rose-100 shadow-[0_-4px_20px_rgba(244,63,94,0.08)]">
    <div class="flex justify-around items-center h-16 px-2">
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-0.5 px-4 py-1 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'text-rose-600' : 'text-gray-400' }}">
            <svg class="w-6 h-6" fill="{{ request()->routeIs('dashboard') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[10px] font-medium">Home</span>
        </a>
        <a href="{{ route('browse.index') }}" class="flex flex-col items-center gap-0.5 px-4 py-1 rounded-xl transition-all {{ request()->routeIs('browse.*') ? 'text-rose-600' : 'text-gray-400' }}">
            <svg class="w-6 h-6" fill="{{ request()->routeIs('browse.*') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-[10px] font-medium">Browse</span>
        </a>
        <a href="{{ route('conversations.index') }}" class="relative flex flex-col items-center gap-0.5 px-4 py-1 rounded-xl transition-all {{ request()->routeIs('conversations.*') ? 'text-rose-600' : 'text-gray-400' }}">
            <svg class="w-6 h-6" fill="{{ request()->routeIs('conversations.*') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <span x-show="unread > 0" x-text="unread > 9 ? '9+' : unread"
                  class="absolute top-0 right-2 min-w-[16px] h-4 px-1 flex items-center justify-center bg-rose-500 text-white text-[9px] font-bold rounded-full leading-none">
            </span>
            <span class="text-[10px] font-medium">Messages</span>
        </a>
        <a href="{{ route('dating-profile.edit') }}" class="flex flex-col items-center gap-0.5 px-4 py-1 rounded-xl transition-all {{ request()->routeIs('dating-profile.*') ? 'text-rose-600' : 'text-gray-400' }}">
            <svg class="w-6 h-6" fill="{{ request()->routeIs('dating-profile.*') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-[10px] font-medium">Profile</span>
        </a>
    </div>
</div>

<!-- Toast container -->
<div class="fixed top-20 right-4 z-[60] space-y-2" id="toast-container">
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="toast.visible"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-8"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="flex items-start gap-3 bg-white border border-rose-100 rounded-2xl shadow-lg p-3 w-72 cursor-pointer"
            @click="goToConversation(toast.conversationId)"
        >
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-rose-400 to-pink-500 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                <span x-text="toast.senderInitial"></span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-gray-800 text-sm truncate" x-text="toast.senderName"></p>
                <p class="text-gray-500 text-xs truncate mt-0.5" x-text="toast.body"></p>
            </div>
            <button @click.stop="dismissToast(toast.id)" class="text-gray-300 hover:text-gray-500 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
</div>

</div>{{-- end navBadge --}}

<script>
function navBadge(userId) {
    return {
        userId,
        unread: 0,
        toasts: [],
        toastIdCounter: 0,
        currentConversationId: null,

        init() {
            // Detect if user is currently in a conversation
            const match = window.location.pathname.match(/\/conversations\/(\d+)/);
            this.currentConversationId = match ? parseInt(match[1]) : null;

            this.fetchUnreadCount();

            // Listen on all conversations the user participates in
            // We subscribe per conversation via a global user channel approach
            // Since we don't have a user channel, poll for count + subscribe to all known convos
            this.subscribeToUserConversations();
        },

        fetchUnreadCount() {
            fetch('/conversations/unread-count', {
                headers: { 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => { this.unread = data.count; });
        },

        subscribeToUserConversations() {
            // We listen on a private user channel for inbound messages
            // The server broadcasts MessageSent on conversation.{id}
            // We need to know which conversations to subscribe to.
            // Simplest approach: fetch conversation list and subscribe to each.
            fetch('/conversations', {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.ok ? r.json() : null)
            .then(data => {
                if (!data || !data.conversationIds) return;
                data.conversationIds.forEach(id => this.listenConversation(id));
            })
            .catch(() => {});
        },

        listenConversation(convId) {
            window.Echo.private(`conversation.${convId}`)
                .listen('.MessageSent', (e) => {
                    if (e.sender_id === this.userId) return;

                    this.unread++;

                    if (this.currentConversationId !== convId) {
                        this.showToast(e, convId);
                    }
                })
                .listen('.MessagesRead', (e) => {
                    // When the current user reads messages, refetch the real count
                    if (e.reader_id === this.userId) {
                        this.fetchUnreadCount();
                    }
                });
        },

        showToast(msg, convId) {
            const id = ++this.toastIdCounter;
            this.toasts.push({
                id,
                conversationId: convId,
                senderName: msg.sender_name,
                senderInitial: msg.sender_name ? msg.sender_name.charAt(0).toUpperCase() : '?',
                body: msg.body,
                visible: true,
            });
            setTimeout(() => this.dismissToast(id), 5000);
        },

        dismissToast(id) {
            const t = this.toasts.find(t => t.id === id);
            if (t) t.visible = false;
            setTimeout(() => { this.toasts = this.toasts.filter(t => t.id !== id); }, 300);
        },

        goToConversation(convId) {
            window.location.href = `/conversations/${convId}`;
        },
    };
}
</script>
