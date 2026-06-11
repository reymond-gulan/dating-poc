<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LaravelMatch') }}</title>
    <link rel="shortcut icon" href="{{ asset('images/icon.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-rose-50 via-pink-50 to-purple-100 flex items-center justify-center font-sans antialiased overflow-hidden">

    <div class="text-center px-6 w-full max-w-sm">

        {{-- Logo --}}
        <div class="flex items-center justify-center gap-2 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="text-rose-500" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="m8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
            </svg>
            <span class="text-3xl font-extrabold bg-gradient-to-r from-rose-500 to-pink-600 bg-clip-text text-transparent">
                {{ config('app.name', 'LaravelMatch') }}
            </span>
        </div>

        {{-- Tagline --}}
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Find your person.</h1>
        <p class="text-gray-500 text-sm mb-10">Meet real people, build real connections.</p>

        {{-- Actions --}}
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="block w-full py-3 bg-gradient-to-r from-rose-500 to-pink-600 text-white font-semibold rounded-full shadow-md hover:shadow-lg active:scale-95 transition-all text-sm">
                    Go to Dashboard
                </a>
            @else
                <div class="flex flex-col gap-3">
                    <a href="{{ route('login') }}"
                       class="block w-full py-3 bg-gradient-to-r from-rose-500 to-pink-600 text-white font-semibold rounded-full shadow-md hover:shadow-lg active:scale-95 transition-all text-sm">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="block w-full py-3 bg-white text-rose-500 font-semibold rounded-full shadow-sm border border-rose-200 hover:border-rose-400 hover:shadow-md active:scale-95 transition-all text-sm">
                            Create an account
                        </a>
                    @endif
                </div>
            @endauth
        @endif

    </div>

</body>
</html>
