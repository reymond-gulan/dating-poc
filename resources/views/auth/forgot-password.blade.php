<x-guest-layout>
    <h2 class="text-xl font-bold text-gray-800 mb-2">Forgot your password?</h2>
    <p class="text-sm text-gray-500 mb-6">No worries - enter your email and we'll send you a reset link.</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="you@example.com" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            {{ __('Send Reset Link') }}
        </x-primary-button>

        <p class="text-center text-sm text-gray-500">
            <a href="{{ route('login') }}" class="text-rose-500 hover:text-rose-700 font-medium">Back to login</a>
        </p>
    </form>
</x-guest-layout>
