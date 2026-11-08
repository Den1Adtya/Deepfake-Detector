<x-guest-layout>
<div class="glitch-card">
    <div class="card-header">

            <div class="card-title">

                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5">

                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                    <path d="M12 11.5a3 3 0 0 0 -3 2.824v1.176a3 3 0 0 0 6 0v-1.176a3 3 0 0 0 -3 -2.824z"></path>

                </svg>

                <span>Forget Password</span>

            </div>

            <div class="card-dots">
                <span></span><span></span><span></span>
            </div>

        </div>
        

    <!-- Session Status -->
    <x-auth-session-status class="mt-4 mx-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" >
        @csrf

            <div class="form-group mx-4 mt-4">

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

                <label for="email" class="form-label" data-text="EMAIL">
                    EMAIL
                </label>

                <x-input-error
                    :messages="$errors->get('email')"
                    class="glitch-error"
                />

            </div>

       

        <div class="flex items-center justify-center my-4 ">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</div>
</x-guest-layout>
