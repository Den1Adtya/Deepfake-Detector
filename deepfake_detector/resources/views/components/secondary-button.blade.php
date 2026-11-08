<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'realornot-glitch-secondary'
    ]) }}
>
    <span class="realornot-glitch-secondary__text">
        {{ $slot }}
    </span>
</button>