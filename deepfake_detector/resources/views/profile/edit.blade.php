<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-[10px] font-mono tracking-[.24em] uppercase text-[#39FF14] mb-1">
                    Account Control / 06
                </p>
                <h2 class="font-semibold text-xl text-[#F5FFF7] leading-tight glitch-hover"
                    data-text="Profile Settings">
                    {{ __('Profile Settings') }}
                </h2>
            </div>

            <span class="system-live">
                <i class="system-live__dot"></i>
                ACCOUNT CONFIGURATION
            </span>
        </div>
    </x-slot>

    <div class="profile-page min-h-screen pt-3 pb-12 text-[#F5FFF7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- PAGE INTRODUCTION --}}
            <div class="profile-page-intro mb-6" data-reveal>
                <p class="profile-eyebrow">USER CONFIGURATION / SECURITY & IDENTITY</p>
                <h1 class="profile-page-title">
                    Manage your account<span>.</span>
                </h1>
                <p class="profile-page-description">
                    Perbarui informasi akun, atur keamanan kata sandi, dan kelola akses akun RealOrNot AI.
                </p>
            </div>

            {{-- ACCOUNT SUMMARY --}}
            <div class="profile-account-summary mb-6" data-reveal>
                <div class="profile-account-avatar" aria-hidden="true">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div class="profile-account-identity">
                    <span class="profile-account-label">SIGNED IN AS</span>
                    <h3>{{ $user->name }}</h3>
                    <p>{{ $user->email }}</p>
                </div>

                <div class="profile-account-status">
                    <i></i>
                    ACCOUNT ACTIVE
                </div>
            </div>

            {{-- PROFILE MODULES --}}
            <div class="profile-terminal-grid">
                <div data-reveal>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div data-reveal>
                    @include('profile.partials.update-password-form')
                </div>

                <div class="profile-delete-panel" data-reveal>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
