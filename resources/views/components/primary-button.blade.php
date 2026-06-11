<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 border border-transparent rounded-full font-semibold text-sm text-white shadow-md hover:shadow-lg active:scale-95 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:ring-offset-2 transition-all']) }}>
    {{ $slot }}
</button>
