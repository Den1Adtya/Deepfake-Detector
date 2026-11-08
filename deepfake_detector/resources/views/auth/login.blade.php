<x-guest-layout>
    <!-- LOGIN FORM -->
    <form method="POST"
        action="{{ route('login') }}"
        id="loginForm"
        class="glitch-card">

        @csrf

        <!-- Header -->
        <div class="card-header">

            <div class="card-title">

                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5">

                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                    <path d="M12 11.5a3 3 0 0 0 -3 2.824v1.176a3 3 0 0 0 6 0v-1.176a3 3 0 0 0 -3 -2.824z"></path>

                </svg>

                <span>LOGIN</span>

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

            <!-- Session Status -->
            <x-auth-session-status
                class="glitch-session-status"
                :status="session('status')" />


            <!-- Email -->
            <div class="form-group">

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder=" "
                >

                <label
                    for="email"
                    class="form-label"
                    data-text="EMAIL">

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
                    autocomplete="current-password"
                    placeholder=" "
                >

                <label
                    for="password"
                    class="form-label"
                    data-text="PASSWORD">

                    PASSWORD

                </label>


                <!-- Password Toggle -->
                <button
                    type="button"
                    class="glitch-password-toggle"
                    data-password-toggle="password"
                    aria-label="Show password"
                    aria-pressed="false">

                    <svg
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                    </svg>

                </button>

                <x-input-error
                    :messages="$errors->get('password')"
                    class="glitch-error"
                />

            </div>


            <!-- Remember Me & Forgot Password -->
            <div class="flex justify-between items-center gap-3 mb-5 flex-wrap">

                <!-- Remember Me -->
                <label for="remember" class="glitch-remember">

                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                        value="1"
                        class="glitch-remember__input"
                        {{ old('remember') ? 'checked' : '' }}
                    >

                    <span
                        class="glitch-remember__box"
                        aria-hidden="true">
                    </span>

                    <span class="glitch-remember__text">
                        Remember me
                    </span>

                </label>


                <!-- Forgot Password -->
                @if (Route::has('password.request'))

                    <a
                        href="{{ route('password.request') }}"
                        class="glitch-forgot">

                        FORGOT PASSWORD?

                    </a>

                @endif

            </div>


            <!-- Submit Button -->
            <button
                type="submit"
                id="loginButton"
                data-text="LOGIN"
                data-loading="LOGIN..."
                class="submit-btn">

                <span class="btn-text">
                    LOGIN
                </span>

            </button>

        </div>


        <!-- Footer -->
        <div class="glitch-card-footer">

            Don't have an account?

            <a href="{{ route('register') }}">
                REGISTER
            </a>

        </div>

    </form>


    <!-- JavaScript -->
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /* =====================================
               PASSWORD VISIBILITY
            ===================================== */

            document.querySelectorAll('[data-password-toggle]').forEach(button => {

                button.addEventListener('click', function () {

                    const input = document.getElementById(this.dataset.passwordToggle);

                    if (!input) return;

                    const svg = this.querySelector('svg');

                    const isPassword = input.type === 'password';

                    input.type = isPassword ? 'text' : 'password';

                    this.setAttribute('aria-pressed', isPassword);
                    this.setAttribute(
                        'aria-label',
                        isPassword ? 'Hide password' : 'Show password'
                    );

                    svg.innerHTML = isPassword

                        ? `
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.978 9.978 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"
                            />
                        `

                        : `
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                            />
                        `;

                });

            });


            /* =====================================
               LOGIN LOADING ANIMATION
            ===================================== */

            const loginForm = document.getElementById('loginForm');

            if (loginForm) {

                loginForm.addEventListener('submit', function () {

                    const button = document.getElementById('loginButton');

                    if (!button) return;

                    button.disabled = true;

                    button.querySelector('.btn-text').textContent =
                        button.dataset.loading;

                    button.dataset.text = button.dataset.loading;

                });

            }

        });

    </script>

</x-guest-layout>