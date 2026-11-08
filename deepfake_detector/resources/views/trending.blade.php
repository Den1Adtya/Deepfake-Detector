<x-app-layout>

    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}
    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>
                <p class="text-[10px] font-mono tracking-[.24em] uppercase text-[#39FF14] mb-1">
                    Signal Watch / 04
                </p>

                <h2 class="font-semibold text-xl text-[#F5FFF7] leading-tight glitch-hover"
                    data-text="Top Trending">

                    {{ __('Top Trending (Sering Diuji)') }}

                </h2>
            </div>

            <span class="system-live">
                <i class="system-live__dot"></i>
                PATTERN MONITOR
            </span>

        </div>

    </x-slot>


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}
    <div class="min-h-screen pt-3 pb-12 text-[#F5FFF7]">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- PAGE INTRODUCTION --}}
            <div class="mb-7" data-reveal>

                <p class="text-[10px] font-mono tracking-[.2em] uppercase text-[#89968D]">
                    Repeated image signatures / Pattern recognition
                </p>

                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight mt-2">
                    Trending image signals<span class="text-[#39FF14]">.</span>
                </h1>

                <p class="text-sm text-[#89968D] mt-2 max-w-2xl">
                    Kumpulan citra dengan hash yang sering muncul dalam aktivitas pengujian.
                </p>

            </div>


            {{-- =================================================
                 TRENDING INFORMATION
            ================================================== --}}
            <div class="flex flex-wrap items-center justify-between gap-3 mb-5"
                 data-reveal>

                <p class="text-xs font-mono text-[#89968D]">
                    <span class="text-[#39FF14]">●</span>
                    MONITORED IMAGE SIGNATURES
                </p>

                <span class="text-[9px] font-mono tracking-wider text-[#718077]">
                    SIGNAL MONITOR // ACTIVE
                </span>

            </div>


            {{-- =================================================
                 TRENDING GRID
            ================================================== --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

                @forelse ($trendings as $item)

                    {{-- TRENDING CARD --}}
                    <article
                        class="terminal-feature-card trending-card trending-terminal-card {{ $item->label == 'FAKE' ? 'trending-terminal-card--fake' : '' }}"
                        data-reveal>


                        {{-- TERMINAL HEADER --}}
                        <div class="terminal-feature-header trending-terminal-header">

                            <span>
                                SIGNAL // IMAGE SIGNATURE
                            </span>

                            <span class="terminal-status">
                                {{ $item->label == 'FAKE' ? 'FLAGGED' : 'VERIFIED' }}
                            </span>

                        </div>


                        {{-- IMAGE PREVIEW --}}
                        <div class="trending-card__image trending-terminal-image relative">

                            <div class="trending-image-overlay"></div>

                            <img
                                data-image-zoom
                                src="{{ asset('storage/uploads/' . ($item->sample_crop_file ?? $item->sample_file)) }}"
                                alt="Cropped face preview"
                                class="trending-terminal-image__content"
                            >


                            {{-- SIGNATURE MATCH BADGE --}}
                            <span class="trending-image-badge">
                                SIGNATURE MATCH
                            </span>


                            {{-- PREVIEW INDICATOR --}}
                            <span class="trending-image-preview-label">
                                OPEN PREVIEW ↗
                            </span>


                            {{-- IMAGE CORNER LABEL --}}
                            <span class="trending-image-index">
                                IMG // 04
                            </span>

                        </div>


                        {{-- TERMINAL BODY --}}
                        <div class="terminal-feature-body trending-terminal-body">


                            {{-- TEST FREQUENCY & VERDICT --}}
                            <div class="flex justify-between items-center gap-3 flex-wrap">

                                <span class="trending-test-count">

                                    <i class="status-pulse"></i>

                                    TESTED {{ $item->total_count }} TIMES

                                </span>


                                <span class="neon-status-badge {{ $item->label == 'FAKE' ? 'neon-status-badge--fake' : 'neon-status-badge--real' }}">

                                    <i class="{{ $item->label == 'FAKE' ? 'trending-status-dot--fake' : 'trending-status-dot--real' }}"></i>

                                    {{ $item->label }}

                                </span>

                            </div>


                            {{-- IMAGE HASH --}}
                            <div class="trending-fingerprint">

                                <p class="trending-fingerprint__label">
                                    IMAGE FINGERPRINT
                                </p>

                                <div class="trending-fingerprint__value">

                                    <code title="{{ $item->image_hash }}">
                                        {{ $item->image_hash }}
                                    </code>

                                </div>

                            </div>


                            {{-- REPEATED SIGNATURE INFORMATION --}}
                            <p class="trending-signature-description">
                                Repeated signature detected in the archive.
                            </p>


                            {{-- TERMINAL FOOTER --}}
                            <div class="terminal-feature-footer">

                                <span>
                                    PATTERN DETECTED
                                </span>

                                <span>
                                    SIGNAL // MONITORED
                                </span>

                            </div>

                        </div>

                    </article>

                @empty


                    {{-- EMPTY STATE --}}
                    <div class="col-span-full">

                        <div class="terminal-feature-card trending-empty-card"
                             data-reveal>


                            {{-- HEADER --}}
                            <div class="terminal-feature-header">

                                <span>
                                    01 // SIGNAL MONITOR
                                </span>

                                <span class="terminal-status">
                                    NO DATA
                                </span>

                            </div>


                            {{-- BODY --}}
                            <div class="terminal-feature-body trending-empty-body">

                                <div class="trending-empty-icon">
                                    ⌁
                                </div>

                                <p class="trending-empty-label">
                                    SYSTEM // AWAITING INPUT
                                </p>

                                <h3 class="text-xl sm:text-2xl font-extrabold text-[#F5FFF7] mt-3">
                                    Belum ada sinyal trending
                                </h3>

                                <p class="text-sm text-[#89968D] max-w-lg mx-auto mt-3 leading-relaxed">
                                    Belum ada data gambar dengan kesamaan yang cukup
                                    untuk ditampilkan. Unggah gambar melalui workspace
                                    deteksi untuk mulai mengisi arsip.
                                </p>

                                <a href="{{ route('detect.index') }}"
                                   class="neon-button inline-flex items-center justify-center gap-3 mt-7 px-6 py-3 rounded-xl font-bold text-sm"
                                   data-ripple>

                                    OPEN DETECTION

                                    <span>↗</span>

                                </a>

                                <div class="terminal-feature-footer">

                                    <span>
                                        SYSTEM // REALORNOT AI
                                    </span>

                                    <span>
                                        WAITING FOR SIGNATURE
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforelse

            </div>


            {{-- PAGE FOOTER INFORMATION --}}
            @if($trendings->count() > 0)

                <div class="flex flex-wrap justify-between items-center gap-3 mt-6"
                     data-reveal>

                    <span class="text-[9px] font-mono tracking-wider text-[#718077]">
                        REALORNOT AI // SIGNAL ARCHIVE
                    </span>

                    <span class="text-[9px] font-mono tracking-wider text-[#718077]">
                        PATTERN MONITORING SYSTEM ACTIVE
                    </span>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>