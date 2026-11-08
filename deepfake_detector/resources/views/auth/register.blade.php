<x-guest-layout>

    <form method="POST" action="{{ route('register') }}" id="registerForm" class="glitch-card">

        @csrf

        <!-- Header -->
        <div class="card-header">

            <div class="card-title">

                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5">

                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <line x1="19" y1="8" x2="19" y2="14"></line>
                    <line x1="22" y1="11" x2="16" y2="11"></line>

                </svg>

                <span>REGISTER</span>

            </div>

             <!-- Terminal Dots - Center -->
    <div class="card-dots card-dots--center" aria-hidden="true">
        <span></span>
        <span></span>
        <span></span>
    </div>


    <!-- Back Button - Right -->
    <a href="{{ url('/') }}"
        class="auth-back-button auth-back-button--header"
        aria-label="Back to home">

        <span>BACK</span>

    </a>

        </div>


        <!-- Body -->
        <div class="card-body">

            <!-- Name -->
            <div class="form-group">

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder=" "
                >

                <label for="name" class="form-label" data-text="FULL_NAME">
                    FULL_NAME
                </label>

                <x-input-error
                    :messages="$errors->get('name')"
                    class="glitch-error"
                />

            </div>


            <!-- Email -->
            <div class="form-group">

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    placeholder=" "
                >

                <label for="email" class="form-label" data-text="EMAIL">
                    EMAIL
                </label>

                <x-input-error
                    :messages="$errors->get('email')"
                    class="glitch-error"
                />

            </div>


            <!-- Password -->
            <div class="form-group">

                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder=" "
                >

                <label for="password" class="form-label" data-text="PASSWORD">
                    PASSWORD
                </label>

                <button
                    type="button"
                    class="glitch-password-toggle"
                    data-password-toggle="password"
                    aria-label="Show password"
                    aria-pressed="false"
                >

                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                    </svg>

                </button>

                <x-input-error
                    :messages="$errors->get('password')"
                    class="glitch-error"
                />

            </div>


            <!-- Confirm Password -->
            <div class="form-group">

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder=" "
                >

                <label for="password_confirmation"
                    class="form-label"
                    data-text="CONFIRM_PASSWORD">

                    CONFIRM_PASSWORD

                </label>

                <button
                    type="button"
                    class="glitch-password-toggle"
                    data-password-toggle="password_confirmation"
                    aria-label="Show confirm password"
                    aria-pressed="false"
                >

                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                    </svg>

                </button>

            </div>


            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="glitch-error"
            />


            <!-- Submit -->
            <button
                type="submit"
                id="registerButton"
                data-text="CREATE_ACCOUNT"
                data-loading="CREATING_ACCOUNT..."
                class="submit-btn"
            >

                <span class="btn-text">
                    CREATE_ACCOUNT
                </span>

            </button>

        </div>


        <!-- Footer -->
        <div class="glitch-card-footer">

            Already have an account?

            <a href="{{ route('login') }}">
                LOGIN
            </a>

        </div>

    </form>


    <!-- JavaScript -->
    <script>

        // Password Visibility
        document.querySelectorAll('[data-password-toggle]').forEach(button => {

            button.addEventListener('click', function () {

                const input = document.getElementById(this.dataset.passwordToggle);
                const svg = this.querySelector('svg');

                const isPassword = input.type === 'password';

                input.type = isPassword ? 'text' : 'password';

                this.setAttribute('aria-pressed', isPassword);
                this.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');

                svg.innerHTML = isPassword
                    ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.978 9.978 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
                    : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;

            });

        });


        // Loading Animation
        document.getElementById('registerForm').addEventListener('submit', function () {

            const button = document.getElementById('registerButton');

            button.disabled = true;

            button.querySelector('.btn-text').textContent =
                button.dataset.loading;

            button.dataset.text = button.dataset.loading;

        });

    </script>

</x-guest-layout>