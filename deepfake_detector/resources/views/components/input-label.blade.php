@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#B7C4BA]']) }}>
    {{ $value ?? $slot }}
</label>
