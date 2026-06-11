@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }} @if($required)<span class="text-rose-500 ml-0.5 font-bold">*</span>@endif
</label>
