<nav x-data="{ open: false }"
    class="site-navbar sticky top-0 z-50 w-full bg-transparent border-b border-transparent">

    {{-- ====================================================== --}}
    {{-- AUTHENTICATED NAVBAR (SUDAH LOGIN) --}}
    {{-- ====================================================== --}}

    @auth

        <div class="max-w-7xl mx-auto px-6 lg:px-10">

            <div class="relative flex items-center justify-between h-20">

                {{-- ================= LOGO ================= --}}

                <div class="shrink-0 flex items-center">

                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 group">

                        <img
                            src="{{ asset('images/RealOrNot_logo.svg') }}"
                            alt="RealOrNot Logo"
                            class="w-10 h-10 object-contain transition-transform duration-300 group-hover:scale-110"
                        >

                        <div class="hidden sm:block">

                            <span class="text-lg font-extrabold tracking-tight text-white">
                                RealOrNot<span class="text-[#39FF14]"> AI</span>
                            </span>

                            <p class="text-[9px] text-[#89968D] tracking-[0.2em] uppercase">
                                Deepfake Intelligence
                            </p>

                        </div>

                    </a>

                </div>


                {{-- ================= CENTER NAVIGATION ================= --}}

                <div class="hidden lg:flex items-center absolute left-1/2 -translate-x-1/2">

                    <div class="neon-nav-pill flex items-center gap-1
                        px-3 py-2
                        rounded-full
                        bg-white/[0.04]
                        border border-white/[0.08]
                        backdrop-blur-xl
                        shadow-lg shadow-black/10">

                        {{-- DASHBOARD --}}

                        <a href="{{ route('dashboard') }}"
                            @if(request()->routeIs('dashboard')) aria-current="page" @endif
                            class="neon-nav-link">
                            Dashboard
                        </a>


                        {{-- DETEKSI AI --}}

                        <a href="{{ route('detect.index') }}"
                            @if(request()->routeIs('detect.index')) aria-current="page" @endif
                            class="neon-nav-link">
                            Deteksi AI
                        </a>


                        {{-- RIWAYAT --}}

                        <a href="{{ route('detect.history') }}"
                            @if(request()->routeIs('detect.history')) aria-current="page" @endif
                            class="neon-nav-link">
                            Riwayat
                        </a>


                        {{-- TRENDING SEARCH --}}

                        <a href="{{ route('detect.trending') }}"
                            @if(request()->routeIs('detect.trending')) aria-current="page" @endif
                            class="neon-nav-link">
                            Trending Search
                        </a>

                    </div>

                </div>


                {{-- ================= USER PROFILE ================= --}}

                <div class="hidden lg:flex items-center">

                    <div class="profile-dropdown-root relative" x-data="{ profileOpen: false }" @keydown.escape.window="profileOpen = false" @click.outside="profileOpen = false">
                        <button
                            type="button"
                            class="neon-profile-trigger @if(request()->routeIs('profile.*')) is-current-page @endif"
                            aria-label="Open profile menu"
                            aria-haspopup="true"
                            :aria-expanded="profileOpen ? 'true' : 'false'"
                            :class="{ 'is-open': profileOpen }"
                            @click="profileOpen = !profileOpen">
                            <span class="neon-profile-name">{{ Auth::user()->name }}</span>
                            <svg class="neon-profile-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div
                            x-cloak
                            x-show="profileOpen"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1 scale-[0.98]"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-1 scale-[0.98]"
                            class="neon-profile-menu"
                            role="menu">

                            <div class="neon-profile-menu__meta">
                                <span>Signed in as</span>
                                <strong>{{ Auth::user()->email }}</strong>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                                class="neon-profile-menu__link @if(request()->routeIs('profile.*')) is-current-page @endif"
                                role="menuitem"
                                @if(request()->routeIs('profile.*')) aria-current="page" @endif>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Profile</span>
                                @if(request()->routeIs('profile.*')) <span class="neon-profile-menu__current">CURRENT</span> @endif
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="neon-profile-menu__link neon-profile-menu__logout" role="menuitem">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>


                {{-- ================= MOBILE HAMBURGER ================= --}}

                <div class="lg:hidden flex items-center">

                    <button
                        @click="open = !open"
                        class="inline-flex items-center justify-center
                        p-2 rounded-xl
                        text-[#B7C4BA]
                        hover:text-white
                        hover:bg-white/10
                        transition">

                        {{-- OPEN ICON --}}

                        <svg x-show="!open"
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />

                        </svg>


                        {{-- CLOSE ICON --}}

                        <svg x-show="open"
                            x-cloak
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />

                        </svg>

                    </button>

                </div>

            </div>

        </div>


        {{-- ====================================================== --}}
        {{-- AUTHENTICATED MOBILE MENU --}}
        {{-- ====================================================== --}}

        <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            x-cloak
            class="lg:hidden bg-[#0A100D]/95 backdrop-blur-xl border-t border-white/[0.08]">

            <div class="px-6 py-5 space-y-2">

                {{-- DASHBOARD --}}

                <a href="{{ route('dashboard') }}"
                    @if(request()->routeIs('dashboard')) aria-current="page" @endif
                    class="neon-mobile-link">
                    Dashboard
                </a>


                {{-- DETEKSI AI --}}

                <a href="{{ route('detect.index') }}"
                    @if(request()->routeIs('detect.index')) aria-current="page" @endif
                    class="neon-mobile-link">
                    Deteksi AI
                </a>


                {{-- RIWAYAT --}}

                <a href="{{ route('detect.history') }}"
                    @if(request()->routeIs('detect.history')) aria-current="page" @endif
                    class="neon-mobile-link">
                    Riwayat
                </a>


                {{-- TRENDING SEARCH --}}

                <a href="{{ route('detect.trending') }}"
                    @if(request()->routeIs('detect.trending')) aria-current="page" @endif
                    class="neon-mobile-link">
                    Trending Search
                </a>


                {{-- USER INFORMATION --}}

                <div class="border-t border-white/10 pt-5 mt-4">

                    <div class="px-4 mb-3">

                        <p class="text-sm font-semibold text-white">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-[#718077] mt-1">
                            {{ Auth::user()->email }}
                        </p>

                    </div>


                    {{-- PROFILE --}}

                    <a href="{{ route('profile.edit') }}"
                        @if(request()->routeIs('profile.*')) aria-current="page" @endif
                        class="neon-mobile-link @if(request()->routeIs('profile.*')) is-current-page @endif">
                        Profile
                    </a>


                    {{-- LOGOUT --}}

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                            class="w-full text-left px-4 py-3 rounded-xl text-sm text-[#FF6B81] hover:bg-[#FF2D55]/10 transition">

                            Log Out

                        </button>

                    </form>

                </div>

            </div>

        </div>


    @else


        {{-- ====================================================== --}}
        {{-- GUEST NAVBAR (BELUM LOGIN) --}}
        {{-- ====================================================== --}}

        <div class="max-w-7xl mx-auto px-6 lg:px-10">

            <div class="relative flex items-center justify-between h-20">


                {{-- ================= LOGO ================= --}}

                <a href="{{ url('/') }}"
                    class="flex items-center gap-3 shrink-0 group">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="RealOrNot AI"
                        class="w-10 h-10 object-contain transition-transform duration-300 group-hover:scale-110"
                    >

                    <div>

                        <span class="text-lg font-extrabold tracking-tight text-white">
                            RealOrNot<span class="text-[#39FF14]"> AI</span>
                        </span>

                        <p class="text-[9px] text-[#89968D] tracking-[0.2em] uppercase">
                            Deepfake Intelligence
                        </p>

                    </div>

                </a>


                {{-- ================= CENTER NAVIGATION ================= --}}

                <div class="hidden md:flex items-center absolute left-1/2 -translate-x-1/2">

                    <div class="neon-nav-pill flex items-center gap-1
                        rounded-full
                        px-3 py-2
                        bg-white/[0.04]
                        border border-white/[0.08]
                        backdrop-blur-xl
                        shadow-lg shadow-black/10">


                        {{-- FEATURES --}}

                        <a href="{{ url('/') }}#features"
                            class="neon-nav-link guest-section-link"
                            data-guest-section="features">

                            Features

                        </a>


                        {{-- HOW IT WORKS --}}

                        <a href="{{ url('/') }}#how-it-works"
                            class="neon-nav-link guest-section-link"
                            data-guest-section="how-it-works">

                            How It Works

                        </a>



                        {{-- TECHNOLOGY --}}

                        <a href="{{ url('/') }}#technology"
                            class="neon-nav-link guest-section-link"
                            data-guest-section="technology">

                            Technology

                        </a>

                        {{-- ABOUT --}}

                        <a href="{{ url('/') }}#about"
                            class="neon-nav-link guest-section-link"
                            data-guest-section="about">

                            About

                        </a>

                    </div>

                </div>


                {{-- ================= GUEST AUTH BUTTONS ================= --}}

                <div class="hidden sm:flex items-center gap-3">

                    {{-- LOGIN --}}

                    <a href="{{ route('login') }}"
                        class="neon-nav-link neon-guest-action"
                        @if(request()->routeIs('login')) aria-current="page" @endif>

                        Sign In

                    </a>


                    {{-- REGISTER --}}

                    @if (Route::has('register'))

                        <a href="{{ route('register') }}"
                            class="neon-nav-link neon-guest-action neon-guest-action--primary"
                            @if(request()->routeIs('register')) aria-current="page" @endif>

                            Get Started

                        </a>

                    @endif

                </div>


                {{-- ================= MOBILE HAMBURGER ================= --}}

                <div class="sm:hidden flex items-center">

                    <button
                        @click="open = !open"
                        class="inline-flex items-center justify-center
                        p-2 rounded-xl
                        text-[#B7C4BA]
                        hover:text-white
                        hover:bg-white/10
                        transition">

                        {{-- OPEN ICON --}}

                        <svg x-show="!open"
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />

                        </svg>


                        {{-- CLOSE ICON --}}

                        <svg x-show="open"
                            x-cloak
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />

                        </svg>

                    </button>

                </div>

            </div>

        </div>


        {{-- ====================================================== --}}
        {{-- GUEST MOBILE MENU --}}
        {{-- ====================================================== --}}

        <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            x-cloak
            class="sm:hidden bg-[#0A100D]/95 backdrop-blur-xl border-t border-white/[0.08]">

            <div class="px-6 py-5 space-y-2">


                {{-- FEATURES --}}

                <a href="{{ url('/') }}#features"
                    class="neon-mobile-link guest-section-link" data-guest-section="features">

                    Features

                </a>


                {{-- TECHNOLOGY --}}

                <a href="{{ url('/') }}#technology"
                    class="neon-mobile-link guest-section-link" data-guest-section="technology">

                    Technology

                </a>


                {{-- HOW IT WORKS --}}

                <a href="{{ url('/') }}#how-it-works"
                    class="neon-mobile-link guest-section-link" data-guest-section="how-it-works">

                    How It Works

                </a>


                {{-- ABOUT --}}

                <a href="{{ url('/') }}#about"
                    class="neon-mobile-link guest-section-link" data-guest-section="about">

                    About

                </a>


                {{-- MOBILE AUTH BUTTONS --}}

                <div class="border-t border-white/10 pt-5 mt-4">

                    {{-- LOGIN --}}

                    <a href="{{ route('login') }}"
                        class="neon-mobile-link neon-mobile-action"
                        @if(request()->routeIs('login')) aria-current="page" @endif>

                        Sign In

                    </a>


                    {{-- REGISTER --}}

                    @if (Route::has('register'))

                        <a href="{{ route('register') }}"
                            class="neon-mobile-link neon-mobile-action neon-mobile-action--primary"
                            @if(request()->routeIs('register')) aria-current="page" @endif>

                            Get Started

                        </a>

                    @endif

                </div>

            </div>

        </div>

       {{-- Landing page section navigation --}}
<script>
    (() => {
        const initGuestSectionNavigation = () => {
            const sectionLinks = Array.from(
                document.querySelectorAll('[data-guest-section]')
            );

            if (!sectionLinks.length) return;

            const setActiveSection = (sectionId) => {
                sectionLinks.forEach((link) => {
                    const isActive =
                        sectionId !== null &&
                        link.dataset.guestSection === sectionId;

                    if (isActive) {
                        link.setAttribute('aria-current', 'page');
                    } else {
                        link.removeAttribute('aria-current');
                    }
                });
            };

            const sections = Array.from(new Set(
                sectionLinks
                    .map(link =>
                        document.getElementById(link.dataset.guestSection)
                    )
                    .filter(Boolean)
            ));

            // Hapus active state ketika berada di paling atas.
            const clearActiveAtTop = () => {
                if (window.scrollY <= 80) {
                    setActiveSection(null);
                }
            };

            // Jalankan saat halaman pertama kali dimuat.
            clearActiveAtTop();

            // Pantau posisi scroll.
            window.addEventListener(
                'scroll',
                clearActiveAtTop,
                { passive: true }
            );

            if (!('IntersectionObserver' in window) || !sections.length) {
                return;
            }

            // Deteksi section yang sedang terlihat.
            const observer = new IntersectionObserver((entries) => {

                // Jangan tandai Features ketika masih di bagian hero.
                if (window.scrollY <= 80) {
                    setActiveSection(null);
                    return;
                }

                const visibleSections = entries
                    .filter(entry => entry.isIntersecting)
                    .sort((a, b) =>
                        b.intersectionRatio - a.intersectionRatio
                    );

                if (visibleSections.length) {
                    setActiveSection(
                        visibleSections[0].target.id
                    );
                }

            }, {
                root: null,
                rootMargin: '-22% 0px -58% 0px',
                threshold: [0, 0.1, 0.25, 0.5]
            });

            sections.forEach(section => observer.observe(section));
        };

        if (document.readyState === 'loading') {
            document.addEventListener(
                'DOMContentLoaded',
                initGuestSectionNavigation,
                { once: true }
            );
        } else {
            initGuestSectionNavigation();
        }
    })();
</script>
    @endauth

</nav>