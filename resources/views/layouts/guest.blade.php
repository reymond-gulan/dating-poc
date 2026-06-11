<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('images/icon.ico') }}">

        <title>{{ config('app.name', 'LaravelMatch') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased min-h-screen bg-gradient-to-br from-rose-50 via-pink-50 to-purple-100 flex flex-col items-center justify-center p-4">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-2 mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="text-rose-500" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="m8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
            </svg>
            <span class="text-2xl font-extrabold bg-gradient-to-r from-rose-500 to-pink-600 bg-clip-text text-transparent">
                {{ config('app.name', 'LaravelMatch') }}
            </span>
        </a>

        {{-- Card --}}
        <div class="w-full max-w-md bg-white rounded-3xl shadow-sm border border-rose-50 px-8 py-8">
            {{ $slot }}
        </div>

    </body>
</html>
