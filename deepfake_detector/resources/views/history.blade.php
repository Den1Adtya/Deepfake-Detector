<x-app-layout>

    {{-- PAGE HEADER --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-[10px] font-mono tracking-[.24em] uppercase text-[#39FF14] mb-1">
                    Archive / 03
                </p>

                <h2 class="font-semibold text-xl text-[#F5FFF7] leading-tight glitch-hover"
                    data-text="Riwayat Analisis">
                    {{ __('Riwayat Analisis') }}
                </h2>
            </div>

            <span class="system-live">
                <i class="system-live__dot"></i>
                RECORDS INDEXED
            </span>
        </div>
    </x-slot>


    {{-- MAIN CONTENT --}}
    <div class="min-h-screen pt-3 pb-12 text-[#F5FFF7]">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- PAGE INTRODUCTION --}}
            <div class="mb-7" data-reveal>

                <p class="text-[10px] font-mono tracking-[.2em] uppercase text-[#89968D]">
                    Detection archive / User activity
                </p>

                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight mt-2">
                    Log deteksi deepfake<span class="text-[#39FF14]">.</span>
                </h1>

                <p class="text-sm text-[#89968D] mt-2">
                    Telusuri kembali hasil analisis gambar yang pernah diproses.
                </p>

            </div>


            {{-- =================================================
                 UNIFIED SEARCH & HISTORY TERMINAL
            ================================================== --}}

            <section class="terminal-feature-card history-archive-card"
                     data-reveal>

                {{-- TERMINAL HEADER --}}
                <div class="terminal-feature-header">

                    <span>DETECTION ARCHIVE</span>

                    <span class="terminal-status">
                        RECORDS INDEXED
                    </span>

                </div>


                {{-- TERMINAL BODY --}}
                <div class="history-archive-body">


                    {{-- SEARCH SECTION --}}
                    <div class="history-archive-toolbar">

                        <div class="history-search-heading">

                            <p class="history-section-label">
                                ARCHIVE QUERY / FILTER
                            </p>

                            <h3 class="history-section-title">
                                Search detection records
                            </h3>

                            <p class="history-section-description">
                                Temukan hasil analisis berdasarkan nama file gambar.
                            </p>

                        </div>


                        {{-- SEARCH FORM --}}
                        <form action="{{ route('detect.history') }}"
                              method="GET"
                              class="history-search">

                            <div class="history-search-input-wrap">

                                <svg class="history-search-icon"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <circle cx="11" cy="11" r="7"/>
                                    <path d="m20 20-4-4"/>

                                </svg>

                                <input
                                    id="historyLiveSearch"
                                    type="text"
                                    name="search"
                                    value="{{ $search ?? '' }}"
                                    placeholder="Search file name..."
                                    autocomplete="off"
                                >

                            </div>


                           <div class="history-search-actions">

                                <button type="submit"
                                        class="realornot-glitch-secondary history-search-button">

                                    <span class="realornot-glitch-secondary__text">
                                        SEARCH
                                    </span>

                                </button>

                                @if(!empty($search))

                                    <a href="{{ route('detect.history') }}"
                                    class="realornot-glitch-secondary history-reset-button">
                                        <span class="realornot-glitch-secondary__text">RESET</span>
                                    </a>

                                @endif

                            </div>

                        </form>

                    </div>


                    {{-- DIVIDER --}}
                    <div class="history-archive-divider"></div>


                    {{-- TABLE INFORMATION --}}
                    <div class="history-archive-meta">

                        <p>
                            <span class="history-online-dot"></span>
                            STORED DETECTION RECORDS
                        </p>

                        <span>
                            LIVE FILTER // TYPE TO NARROW RESULTS
                        </span>

                    </div>


                    {{-- HISTORY TABLE --}}
                    <div class="history-table-viewport">

                        <table class="history-terminal-table">

                            <thead>
                                <tr>

                                    <th scope="col">
                                        Timestamp
                                    </th>

                                    <th scope="col">
                                        File name
                                    </th>

                                    <th scope="col">
                                        Verdict
                                    </th>

                                    <th scope="col">
                                        Confidence
                                    </th>

                                    <th scope="col" class="text-right">
                                        Action
                                    </th>

                                </tr>
                            </thead>


                            <tbody id="historyTableBody">

                                @forelse ($predictions as $item)

                                    <tr data-history-row>

                                        {{-- TIMESTAMP --}}
                                        <td class="history-timestamp">
                                            {{ $item->created_at->format('d M Y, H:i') }}
                                        </td>


                                        {{-- FILE NAME --}}
                                        <td class="history-filename">

                                            <span title="{{ $item->filename }}">
                                                {{ $item->filename }}
                                            </span>

                                        </td>


                                        {{-- VERDICT --}}
                                        <td>

                                            <span class="neon-status-badge {{ $item->label == 'FAKE' ? 'neon-status-badge--fake' : 'neon-status-badge--real' }}">

                                                <i class="{{ $item->label == 'FAKE' ? 'history-dot--fake' : 'history-dot--real' }}"></i>

                                                {{ $item->label }}

                                            </span>

                                        </td>


                                        {{-- CONFIDENCE --}}
                                        <td class="history-confidence">

                                            {{ $item->confidence }}%

                                        </td>


                                        {{-- ACTION --}}
                                        <td class="text-right">

                                            <a href="{{ route('detect.show', $item->id) }}"
                                               class="history-view-link">

                                                VIEW REPORT

                                                <span aria-hidden="true">
                                                    →
                                                </span>

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="history-empty-state">

                                            <span class="history-empty-icon">
                                                ⌁
                                            </span>

                                            <p>
                                                Belum ada riwayat deteksi.
                                            </p>

                                            <span>
                                                WAITING FOR RECORDS
                                            </span>

                                        </td>
                                    </tr>

                                @endforelse


                                {{-- LIVE SEARCH EMPTY STATE --}}
                                <tr id="historyNoMatch" class="hidden">

                                    <td colspan="5" class="history-empty-state">

                                        No visible records match your search.

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>


                    {{-- TERMINAL FOOTER --}}
                    <div class="history-archive-footer">

                        <span>
                            SYSTEM // REALORNOT AI
                        </span>

                        <span>
                            ARCHIVE STATUS: OPERATIONAL
                        </span>

                    </div>

                </div>

            </section>

        </div>

    </div>


    {{-- LIVE SEARCH SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const searchInput = document.getElementById('historyLiveSearch');
            const tableBody = document.getElementById('historyTableBody');
            const noMatch = document.getElementById('historyNoMatch');

            if (!searchInput || !tableBody) return;

            searchInput.addEventListener('input', function () {

                const query = this.value.toLowerCase().trim();

                const rows = tableBody.querySelectorAll('[data-history-row]');

                let visibleCount = 0;

                rows.forEach(row => {

                    const filename = row.querySelector('.history-filename');

                    const text = filename
                        ? filename.textContent.toLowerCase()
                        : '';

                    const matches = text.includes(query);

                    row.style.display = matches ? '' : 'none';

                    if (matches) {
                        visibleCount++;
                    }

                });

                if (noMatch) {
                    noMatch.classList.toggle(
                        'hidden',
                        visibleCount > 0 || rows.length === 0
                    );
                }

            });

        });
    </script>

</x-app-layout>