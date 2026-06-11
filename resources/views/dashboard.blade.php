<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Welcome Banner -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-rose-500 via-pink-500 to-purple-600 p-8 mb-8 shadow-xl">
            <div class="relative z-10">
                <p class="text-rose-100 text-sm font-medium mb-1">Welcome back</p>
                <h1 class="text-white text-3xl font-bold mb-2 flex items-center gap-2">
                  {{ Auth::user()->name }}
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hearts" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.931.481c1.627-1.671 5.692 1.254 0 5.015-5.692-3.76-1.626-6.686 0-5.015m6.84 1.794c1.084-1.114 3.795.836 0 3.343-3.795-2.507-1.084-4.457 0-3.343M7.84 7.642c2.71-2.786 9.486 2.09 0 8.358-9.487-6.268-2.71-11.144 0-8.358"/>
                  </svg>
                </h1>
                <p class="text-rose-100 text-sm">Ready to find your perfect match?</p>
            </div>
            <div class="absolute -right-8 -top-8 w-40 h-40 rounded-full bg-white/10"></div>
            <div class="absolute -right-4 -bottom-12 w-56 h-56 rounded-full bg-white/10"></div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('browse.index') }}" class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all border border-rose-100 hover:border-rose-300 text-center">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center mb-4 group-hover:bg-rose-100 transition-colors mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="text-rose-500 block" viewBox="0 0 16 16">
                        <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018"/>
                        <path d="M13 6.5a6.47 6.47 0 0 1-1.258 3.844q.06.044.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">Browse Profiles</h3>
                <p class="text-sm text-gray-500">Discover people near you</p>
            </a>

            <a href="{{ route('conversations.index') }}" class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all border border-rose-100 hover:border-rose-300 text-center">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center mb-4 group-hover:bg-rose-100 transition-colors mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="text-rose-500 block" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v1.133l.941.502A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765L2 3.133zm0 2.267-.47.25A1 1 0 0 0 1 5.4v.817l1 .6zm1 3.15 3.75 2.25L8 8.917l1.25.75L13 7.417V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm11-.6 1-.6V5.4a1 1 0 0 0-.53-.882L14 4.267zM8 2.982C9.664 1.309 13.825 4.236 8 8 2.175 4.236 6.336 1.31 8 2.982m7 4.401-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734Z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">Messages</h3>
                <p class="text-sm text-gray-500">Check your conversations</p>
            </a>

            <a href="{{ route('dating-profile.edit') }}" class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all border border-rose-100 hover:border-rose-300 text-center">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center mb-4 group-hover:bg-rose-100 transition-colors mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="text-rose-500 block" viewBox="0 0 16 16">
                        <path d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">My Profile</h3>
                <p class="text-sm text-gray-500">Update your dating profile</p>
            </a>
        </div>
    </div>
</x-app-layout>
