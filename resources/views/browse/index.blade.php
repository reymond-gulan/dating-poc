<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
            <span class="text-gray-800">Discover People</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-rose-500 block flex-shrink-0" viewBox="0 0 16 16">
              <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018"/>
              <path d="M13 6.5a6.47 6.47 0 0 1-1.258 3.844q.06.044.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11"/>
            </svg>
        </h1>

        @if ($users->isEmpty())
            <div class="text-center py-16 bg-white rounded-3xl shadow-sm border border-rose-50">
                <span class="mb-4 flex items-center justify-center text-rose-500">
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-heartbreak" viewBox="0 0 16 16">
                    <path d="M8.867 14.41c13.308-9.322 4.79-16.563.064-13.824L7 3l1.5 4-2 3L8 15a38 38 0 0 0 .867-.59m-.303-1.01-.971-3.237 1.74-2.608a1 1 0 0 0 .103-.906l-1.3-3.468 1.45-1.813c1.861-.948 4.446.002 5.197 2.11.691 1.94-.055 5.521-6.219 9.922m-1.25 1.137a36 36 0 0 1-1.522-1.116C-5.077 4.97 1.842-1.472 6.454.293c.314.12.618.279.904.477L5.5 3 7 7l-1.5 3zm-2.3-3.06-.442-1.106a1 1 0 0 1 .034-.818l1.305-2.61L4.564 3.35a1 1 0 0 1 .168-.991l1.032-1.24c-1.688-.449-3.7.398-4.456 2.128-.711 1.627-.413 4.55 3.706 8.229Z"/>
                  </svg>
                </span>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No profiles yet</h3>
                <p class="text-gray-500">Check back soon - new people are joining every day!</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($users as $user)
                    <div class="bg-white rounded-3xl shadow-sm hover:shadow-lg transition-all overflow-hidden border border-rose-50 group flex flex-col">
                        <!-- Avatar area -->
                        <div class="h-48 bg-gradient-to-br from-rose-400 via-pink-400 to-purple-500 flex items-center justify-center relative">
                            <span class="text-white font-bold text-7xl opacity-80">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                            @if ($user->profile->age)
                            <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1 text-sm font-semibold text-gray-700 shadow">
                                {{ $user->profile->age ? $user->profile->age . ' years old' : '' }}
                            </div>
                            @endif
                        </div>

                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $user->name }}</h3>
                            @if ($user->profile->bio)
                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4">{{ $user->profile->bio }}</p>
                            @endif

                            <form method="POST" action="{{ route('conversations.store') }}" class="mt-auto">
                                @csrf
                                <input type="hidden" name="recipient_id" value="{{ $user->id }}">
                                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-semibold py-2.5 px-4 rounded-full transition-all shadow-md hover:shadow-lg active:scale-95">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/>
                                    </svg>
                                    Connect
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
