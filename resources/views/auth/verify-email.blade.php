<x-guest-layout>
    <h2 class="text-xl font-bold text-gray-800 mb-2">Verify your email</h2>
    <p class="text-sm text-gray-500 mb-6">
        Thanks for signing up! Please click the verification link we sent to your email address to get started.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-100 rounded-xl px-4 py-3">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div class="flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full">
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-2.5 text-sm text-gray-500 hover:text-rose-500 font-medium transition-colors">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
