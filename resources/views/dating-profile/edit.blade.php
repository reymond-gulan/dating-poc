<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
          <span class="text-gray-800">My Profile</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-hearts text-rose-500" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.5 1.246c.832-.855 2.913.642 0 2.566-2.913-1.924-.832-3.421 0-2.566M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276ZM15 2.165c.555-.57 1.942.428 0 1.711-1.942-1.283-.555-2.281 0-1.71Z"/>
          </svg>
        </h1>

        <div class="bg-white rounded-3xl shadow-sm border border-rose-50 overflow-hidden">
            <!-- Profile banner -->
            <div class="h-32 bg-gradient-to-br from-rose-400 via-pink-500 to-purple-500 relative">
                <div class="absolute -bottom-10 left-6">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-rose-500 to-pink-600 border-4 border-white flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-3xl">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </div>
            </div>

            <div class="pt-14 px-6 pb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-1">{{ Auth::user()->name }}</h2>
                <p class="text-sm text-gray-400 mb-6">{{ Auth::user()->email }}</p>

                @if (session('status'))
                    <div class="mb-4 flex items-center gap-2 bg-green-50 text-green-700 text-sm px-4 py-3 rounded-xl">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('dating-profile.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="age" class="block text-sm font-semibold text-gray-700 mb-1.5">Age</label>
                        <input
                            id="age"
                            name="age"
                            type="number"
                            value="{{ old('age', $user->profile?->age) }}"
                            min="18"
                            max="100"
                            required
                            class="w-full border-gray-200 focus:border-rose-400 focus:ring-rose-400 rounded-xl text-sm"
                        />
                        <p class="mt-1.5 text-xs text-gray-400">You must be at least 18 years old.</p>
                        <x-input-error :messages="$errors->get('age')" class="mt-1" />
                    </div>

                    <div>
                        <label for="bio" class="block text-sm font-semibold text-gray-700 mb-1.5">Bio</label>
                        <textarea
                            id="bio"
                            name="bio"
                            rows="5"
                            required
                            placeholder="Tell people a bit about yourself..."
                            class="w-full border-gray-200 focus:border-rose-400 focus:ring-rose-400 rounded-xl text-sm resize-none"
                        >{{ old('bio', $user->profile?->bio) }}</textarea>
                        <x-input-error :messages="$errors->get('bio')" class="mt-1.5" />
                    </div>

                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-semibold py-3 px-6 rounded-full transition-all shadow-md hover:shadow-lg active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
