<section class="terminal-feature-card profile-terminal-card" aria-labelledby="update-password-heading">
    <div class="terminal-feature-header">
        <span>02 // SECURITY SETTINGS</span>
        <span class="terminal-status">PASSWORD</span>
    </div>

    <div class="profile-terminal-body">
        <header class="profile-section-heading">
            <p class="profile-section-index">ACCOUNT SECURITY / CREDENTIALS</p>
            <h2 id="update-password-heading">{{ __('Update Password') }}</h2>
            <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="profile-form">
            @csrf
            @method('put')

            <div class="profile-field">
                <x-input-label
                    for="update_password_current_password"
                    :value="__('Current Password')"
                    class="profile-field-label"
                />
                <x-text-input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="profile-field-input mt-1 block w-full"
                    autocomplete="current-password"
                />
                <x-input-error
                    :messages="$errors->updatePassword->get('current_password')"
                    class="profile-field-error mt-2"
                />
            </div>

            <div class="profile-field">
                <x-input-label
                    for="update_password_password"
                    :value="__('New Password')"
                    class="profile-field-label"
                />
                <x-text-input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="profile-field-input mt-1 block w-full"
                    autocomplete="new-password"
                />
                <x-input-error
                    :messages="$errors->updatePassword->get('password')"
                    class="profile-field-error mt-2"
                />
            </div>

            <div class="profile-field">
                <x-input-label
                    for="update_password_password_confirmation"
                    :value="__('Confirm Password')"
                    class="profile-field-label"
                />
                <x-text-input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="profile-field-input mt-1 block w-full"
                    autocomplete="new-password"
                />
                <x-input-error
                    :messages="$errors->updatePassword->get('password_confirmation')"
                    class="profile-field-error mt-2"
                />
            </div>

            <div class="profile-form-actions">
                <x-primary-button class="profile-save-button">
                    <span>{{ __('Update Password') }}</span>
                </x-primary-button>

                @if (session('status') === 'password-updated')
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
            <span>MODULE // SECURITY</span>
            <span>PUT / PASSWORD</span>
        </div>
    </div>
</section>
