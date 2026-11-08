<section class="terminal-feature-card profile-terminal-card" aria-labelledby="profile-information-heading">
    <div class="terminal-feature-header">
        <span>01 // IDENTITY SETTINGS</span>
        <span class="terminal-status">PROFILE DATA</span>
    </div>

    <div class="profile-terminal-body">
        <header class="profile-section-heading">
            <p class="profile-section-index">USER IDENTITY / GENERAL INFORMATION</p>
            <h2 id="profile-information-heading">{{ __('Profile Information') }}</h2>
            <p>{{ __("Update your account's profile information and email address.") }}</p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="profile-form">
            @csrf
            @method('patch')

            <div class="profile-field">
                <x-input-label for="name" :value="__('Name')" class="profile-field-label" />
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="profile-field-input mt-1 block w-full"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                    autocomplete="name"
                />
                <x-input-error class="profile-field-error mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="profile-field">
                <x-input-label for="email" :value="__('Email')" class="profile-field-label" />
                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    class="profile-field-input mt-1 block w-full"
                    :value="old('email', $user->email)"
                    required
                    autocomplete="username"
                />
                <x-input-error class="profile-field-error mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="profile-verification-notice">
                        <p>
                            {{ __('Your email address is unverified.') }}
                        </p>

                        <button
                            form="send-verification"
                            class="profile-inline-action"
                        >
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <p class="profile-verification-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif
            </div>

            <div class="profile-form-actions">
                <x-primary-button class="profile-save-button">
                    <span>{{ __('Save Changes') }}</span>
                </x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2500)"
                        class="profile-saved-message"
                    >
                        <span aria-hidden="true">✓</span>
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>

        <div class="profile-terminal-footer">
            <span>MODULE // IDENTITY</span>
            <span>PATCH / USER PROFILE</span>
        </div>
    </div>
</section>
