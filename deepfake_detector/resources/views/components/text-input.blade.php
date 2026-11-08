@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'neon-input rounded-lg shadow-sm']) !!}>
