<x-app-layout>

    {{-- PAGE HEADER --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-[10px] font-mono tracking-[.24em] uppercase text-[#39FF14] mb-1">
                    Command Center / 01
                </p>

                <h2 class="font-semibold text-xl text-[#F5FFF7] leading-tight glitch-hover"
                    data-text="Dashboard Analisis">
                    {{ __('Dashboard Analisis') }}
                </h2>
            </div>

            <span class="system-live">
                <i class="system-live__dot"></i>
                SYSTEM ONLINE
            </span>
        </div>
    </x-slot>


    {{-- DASHBOARD CONTENT --}}
    <div class="dashboard-terminal-wrapper min-h-screen pt-3 pb-12 text-[#F5FFF7]">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- SECTION HEADING --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-7"
                 data-reveal>

                <div>
                    <p class="text-xs font-mono tracking-[.2em] uppercase text-[#89968D]">
                        Overview / Detection activity
                    </p>

                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight mt-2">
                        Your analysis at a glance<span class="text-[#39FF14]">.</span>
                    </h1>
                </div>

                <a href="{{ route('detect.index') }}"
                     class="realornot-glitch-secondary no-underline gap-3 px-6 py-3.5">

                        <span class="realornot-glitch-secondary__text">＋ New analysis</span>
                    
                </a>

    
            </div>


            {{-- =====================================================
                 METRIC CARDS
            ====================================================== --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 mb-6"
                 data-reveal>


                {{-- TOTAL SCANS --}}
                <article class="terminal-feature-card dashboard-terminal-card">

                    <div class="terminal-feature-header">
                        <span>01 // TOTAL IMAGE SCANS</span>
                        <span class="terminal-status">ALL DATA</span>
                    </div>

                    <div class="terminal-feature-body dashboard-metric-body">

                        <div class="dashboard-metric-layout">

                            <div>
                                <p class="dashboard-metric-label">
                                    Total image scans
                                </p>

                                <p class="dashboard-metric-value dashboard-metric-value--green"
                                   data-count-up="{{ $totalScans }}">
                                    {{ $totalScans }}
                                </p>

                                <p class="dashboard-metric-description">
                                    All processed uploads
                                </p>
                            </div>

                            <div class="dashboard-metric-icon dashboard-metric-icon--green"
                                 aria-hidden="true">

                                <svg class="w-6 h-6"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.7">

                                    <rect x="3" y="3" width="18" height="18" rx="4"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <path d="m21 15-5-5L5 21"/>

                                </svg>
                            </div>

                        </div>

                        <div class="terminal-feature-footer">
                            <span>STATUS: PROCESSED</span>
                            <span>MODULE_01</span>
                        </div>

                    </div>

                </article>


                {{-- FAKE SCANS --}}
                <article class="terminal-feature-card dashboard-terminal-card dashboard-terminal-card--red">

                    <div class="terminal-feature-header">
                        <span>02 // FAKE DETECTION</span>
                        <span class="terminal-status">WARNING</span>
                    </div>

                    <div class="terminal-feature-body dashboard-metric-body">

                        <div class="dashboard-metric-layout">

                            <div>
                                <p class="dashboard-metric-label">
                                    Flagged as fake
                                </p>

                                <p class="dashboard-metric-value dashboard-metric-value--red"
                                   data-count-up="{{ $totalFake }}">
                                    {{ $totalFake }}
                                </p>

                                <p class="dashboard-metric-description">
                                    Potentially manipulated
                                </p>
                            </div>

                            <div class="dashboard-metric-icon dashboard-metric-icon--red"
                                 aria-hidden="true">

                                <svg class="w-6 h-6"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.7">

                                    <path d="M12 3 2.8 19a1.3 1.3 0 0 0 1.1 2h16.2a1.3 1.3 0 0 0 1.1-2L12 3Z"/>
                                    <path d="M12 9v5m0 3h.01"/>

                                </svg>

                            </div>

                        </div>

                        <div class="terminal-feature-footer">
                            <span>STATUS: FLAGGED</span>
                            <span>MODULE_02</span>
                        </div>

                    </div>

                </article>


                {{-- REAL SCANS --}}
                <article class="terminal-feature-card dashboard-terminal-card dashboard-terminal-card--green sm:col-span-2 xl:col-span-1">

                    <div class="terminal-feature-header">
                        <span>03 // REAL DETECTION</span>
                        <span class="terminal-status">VERIFIED</span>
                    </div>

                    <div class="terminal-feature-body dashboard-metric-body">

                        <div class="dashboard-metric-layout">

                            <div>
                                <p class="dashboard-metric-label">
                                    Flagged as real
                                </p>

                                <p class="dashboard-metric-value dashboard-metric-value--green"
                                   data-count-up="{{ $totalReal }}">
                                    {{ $totalReal }}
                                </p>

                                <p class="dashboard-metric-description">
                                    Likely authentic images
                                </p>
                            </div>

                            <div class="dashboard-metric-icon dashboard-metric-icon--green"
                                 aria-hidden="true">

                                <svg class="w-6 h-6"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.7">

                                    <path d="m5 12 4 4L19 6"/>
                                    <circle cx="12" cy="12" r="9"/>

                                </svg>

                            </div>

                        </div>

                        <div class="terminal-feature-footer">
                            <span>STATUS: AUTHENTIC</span>
                            <span>MODULE_03</span>
                        </div>

                    </div>

                </article>

            </div>


            {{-- =====================================================
                 DISTRIBUTION & CTA
            ====================================================== --}}

            <div class="grid lg:grid-cols-[.88fr_1.12fr] gap-5">


                {{-- DETECTION BREAKDOWN --}}
                <section class="terminal-feature-card dashboard-terminal-panel">

                    <div class="terminal-feature-header">
                        <span>04 // SIGNAL DISTRIBUTION</span>
                        <span class="terminal-status">LIVE DATA</span>
                    </div>

                    <div class="terminal-feature-body dashboard-panel-body">

                        <div class="dashboard-panel-heading">

                            <p class="dashboard-metric-label">
                                Analysis statistics
                            </p>

                            <h3 class="terminal-feature-title">
                                Detection breakdown
                            </h3>

                        </div>


                        {{-- CHART --}}
                        <div class="dashboard-chart-area">

                            @if($totalScans > 0)

                                <canvas id="statsChart"
                                        aria-label="Detection breakdown chart">
                                </canvas>

                                <div class="chart-center-label">
                                    <strong>{{ $totalScans }}</strong>
                                    <span>SCANS</span>
                                </div>

                            @else

                                <div class="dashboard-empty-state">

                                    <span class="text-4xl text-[#39FF14]/70">
                                        ◌
                                    </span>

                                    <p>No scan data yet</p>

                                    <span class="text-[9px] mt-2 tracking-widest">
                                        WAITING FOR INPUT
                                    </span>

                                </div>

                            @endif

                        </div>


                        {{-- LEGEND --}}
                        <div class="dashboard-chart-legend">

                            <span>
                                <i class="legend-dot legend-dot--red"></i>
                                FAKE
                            </span>

                            <span>
                                <i class="legend-dot legend-dot--green"></i>
                                REAL
                            </span>

                        </div>


                        <div class="terminal-feature-footer">
                            <span>DATA SOURCE: DATABASE</span>
                            <span>CHART_01</span>
                        </div>

                    </div>

                </section>


                {{-- ANALYSIS CTA --}}
                <section class="terminal-feature-card dashboard-terminal-cta">

                    <div class="terminal-feature-header">
                        <span>05 // ANALYSIS MODULE</span>
                        <span class="terminal-status">READY</span>
                    </div>

                    <div class="terminal-feature-body dashboard-cta-body">

                        <div class="dashboard-cta-decoration" aria-hidden="true">
                            R/N
                        </div>

                        <div class="dashboard-cta-content">

                            <span class="terminal-cta-label">
                                <i class="terminal-cta-dot"></i>
                                ANALYSIS MODULE READY
                            </span>

                            <h3 class="dashboard-cta-heading">
                                Investigate an image.
                                <br>

                                <span class="text-[#39FF14] glitch-hover"
                                      data-text="Reveal the signal.">
                                    Reveal the signal.
                                </span>
                            </h3>

                            <p class="terminal-feature-description">
                                Upload a facial image to run the deepfake detection
                                workflow with EfficientNet-B2 and inspect model
                                attention through Grad-CAM visualization.
                            </p>

                            <div class="dashboard-cta-actions">

<a href="{{ route('detect.index') }}"
   class="realornot-glitch-secondary no-underline gap-3 px-6 py-3.5">

    <span class="realornot-glitch-secondary__text">
        LAUNCH DETECTION
    </span>

    <span aria-hidden="true">→</span>

</a>

                                <span class="dashboard-model-label">
                                    MODEL // EFFICIENTNET-B2
                                </span>

                            </div>

                        </div>


                        <div class="terminal-feature-footer">
                            <span>SYSTEM: OPERATIONAL</span>
                            <span>REALORNOT AI</span>
                        </div>

                    </div>

                </section>

            </div>

        </div>

    </div>


    {{-- =====================================================
         CHART SCRIPT
    ====================================================== --}}

    @if($totalScans > 0)

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const canvas = document.getElementById('statsChart');

                if (!canvas || typeof Chart === 'undefined') return;

                const ctx = canvas.getContext('2d');

                new Chart(ctx, {

                    type: 'doughnut',

                    data: {

                        labels: [
                            'FAKE (Dimanipulasi)',
                            'REAL (Wajah Asli)'
                        ],

                        datasets: [{

                            data: [
                                {{ $totalFake }},
                                {{ $totalReal }}
                            ],

                            backgroundColor: [
                                '#E51B23',
                                '#39FF14'
                            ],

                            borderColor: [
                                '#030804',
                                '#030804'
                            ],

                            borderWidth: 4,
                            hoverOffset: 10,
                            spacing: 3

                        }]

                    },

                    options: {

                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '78%',

                        animation: {
                            animateRotate: true,
                            duration: 1200,
                            easing: 'easeOutQuart'
                        },

                        plugins: {

                            legend: {
                                display: false
                            },

                            tooltip: {

                                backgroundColor: 'rgba(3, 8, 4, 0.96)',
                                borderColor: 'rgba(57, 255, 20, 0.35)',
                                borderWidth: 1,

                                titleColor: '#F5FFF7',
                                bodyColor: '#89968D',

                                padding: 12,
                                displayColors: true

                            }

                        }

                    }

                });

            });
        </script>

    @endif

</x-app-layout>