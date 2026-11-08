<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'glitch-primary-button'
    ]) }}
>
    <span class="glitch-primary-button__text">
        {{ $slot }}
    </span>

    <span
        class="glitch-primary-button__layer glitch-primary-button__layer--red"
        aria-hidden="true"
    >
        {{ $slot }}
    </span>

    <span
        class="glitch-primary-button__layer glitch-primary-button__layer--green"
        aria-hidden="true"
    >
        {{ $slot }}
    </span>
</button>