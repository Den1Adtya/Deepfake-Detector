@props(['active'])

@php
$classes = ($active ?? false)
    ? 'block w-full ps-3 pe-4 py-3 border-l-4 border-[#39FF14] text-start text-base font-medium text-[#39FF14] bg-[#39FF14]/10 focus:outline-none transition duration-150 ease-in-out'
    : 'block w-full ps-3 pe-4 py-3 border-l-4 border-transparent text-start text-base font-medium text-[#89968D] hover:text-[#F5FFF7] hover:bg-white/[0.04] hover:border-[#39FF14]/30 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
