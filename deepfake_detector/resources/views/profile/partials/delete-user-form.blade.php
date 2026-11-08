<section class="terminal-feature-card profile-terminal-card profile-terminal-card--danger" aria-labelledby="delete-account-heading">
    <div class="terminal-feature-header">
        <span>03 // ACCOUNT CONTROL</span>
        <span class="terminal-status">DESTRUCTIVE ACTION</span>
    </div>

    <div class="profile-terminal-body">
        <div class="profile-delete-layout">
            <div>
                <header class="profile-section-heading">
                    <p class="profile-section-index profile-section-index--danger">ACCOUNT LIFECYCLE / PERMANENT ACTION</p>
                    <h2 id="delete-account-heading">{{ __('Delete Account') }}</h2>
                    <p>
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </p>
                </header>
            </div>

            <div class="profile-delete-action">
                <span class="profile-delete-warning">
                    <i></i>
                    THIS ACTION CANNOT BE UNDONE
                </span>

                <x-danger-button
                    class="profile-danger-button"
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                >
                    <span>{{ __('Delete Account') }}</span>
                    <span aria-hidden="true">→</span>
                </x-danger-button>
            </div>
        </div>

        <div class="profile-terminal-footer profile-terminal-footer--danger">
            <span>MODULE // ACCOUNT LIFECYCLE</span>
            <span>CAUTION / PERMANENT DELETION</span>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="profile-delete-modal-content">
            @csrf
            @method('delete')

            <p class="profile-modal-eyebrow">ACCOUNT CONTROL / CONFIRMATION REQUIRED</p>

            <h2 class="profile-modal-title">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="profile-modal-description">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="profile-field mt-6">
                <x-input-label for="password" :value="__('Password')" class="profile-field-label" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="profile-field-input mt-1 block w-full"
                    placeholder="{{ __('Password') }}"
                    autocomplete="current-password"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="profile-field-error mt-2" />
            </div>

            <div class="profile-modal-actions">
                <x-secondary-button class="profile-cancel-button" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="profile-danger-button profile-danger-button--compact">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
