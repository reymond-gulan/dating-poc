@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-200 focus:border-rose-400 focus:ring-rose-400 rounded-xl shadow-sm text-sm']) }}>
