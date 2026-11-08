<x-app-layout>

    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>
                <p class="text-[10px] font-mono tracking-[.24em] uppercase text-[#39FF14] mb-1">
                    Forensics / 05
                </p>

                <h2 class="font-semibold text-xl text-[#F5FFF7] leading-tight glitch-hover"
                    data-text="Detail Hasil Identifikasi">
                    {{ __('Detail Hasil Identifikasi') }}
                </h2>
            </div>

            <a href="{{ route('detect.history') }}"
                class="realornot-glitch-secondary w-full sm:w-auto gap-3 px-6 py-3.5">
                <span id="btnText" class="realornot-glitch-secondary__text">
                ← Back to Archive←</span>
            </a>

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
                    Detection archive / Forensic report
                </p>

                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight mt-2">
                    Analysis report<span class="text-[#39FF14]">.</span>
                </h1>

                <p class="text-sm text-[#89968D] mt-2">
                    Detail hasil identifikasi citra dan interpretasi visual dari model AI.
                </p>

            </div>


            {{-- =====================================================
                 MAIN FORENSIC REPORT
            ====================================================== --}}

            <section class="terminal-feature-card show-report-card mb-6"
                     data-reveal>

                {{-- TERMINAL HEADER --}}
                <div class="terminal-feature-header">

                    <span>01 // DETECTION REPORT</span>

                    <span class="terminal-status">
                        REPORT GENERATED
                    </span>

                </div>


                {{-- TERMINAL BODY --}}
                <div class="terminal-feature-body show-report-body">

                    <div class="grid grid-cols-1 lg:grid-cols-[1.1fr_.9fr] gap-7">


                        {{-- =================================================
                             LEFT COLUMN: IMAGE EVIDENCE
                        ================================================== --}}

                        <div class="show-evidence-column">

                            {{-- ORIGINAL IMAGE --}}
                            <div class="show-image-section">

                                <div class="show-section-heading">

                                    <div>
                                        <p class="show-section-label">
                                            01 / ORIGINAL INPUT
                                        </p>

                                        <h3 class="show-section-title">
                                            Citra Wajah Asli
                                        </h3>
                                    </div>

                                    <span class="show-image-status">
                                        SOURCE IMAGE
                                    </span>

                                </div>


                                <div class="show-image-frame preview-scanner">

                                    <img
                                        data-image-zoom
                                        src="{{ asset('storage/uploads/' . $prediction->filename) }}"
                                        alt="Gambar Wajah Asli"
                                        class="show-evidence-image"
                                    >

                                </div>

                            </div>


                            {{-- GRAD-CAM HEATMAP --}}
                            @if($prediction->heatmap_file)

                                <div class="show-image-section">

                                    <div class="show-section-heading">

                                        <div>
                                            <p class="show-section-label">
                                                02 / EXPLAINABLE AI
                                            </p>

                                            <h3 class="show-section-title">
                                                Visualisasi Grad-CAM
                                            </h3>
                                        </div>

                                        <span class="show-image-status">
                                            AI HEATMAP
                                        </span>

                                    </div>


                                    <div class="show-image-frame preview-scanner">

                                        <img
                                            data-image-zoom
                                            src="{{ asset('storage/uploads/' . $prediction->heatmap_file) }}"
                                            alt="Heatmap Grad-CAM"
                                            class="show-evidence-image show-heatmap-image"
                                        >

                                    </div>

                                </div>

                            @endif

                        </div>



                        {{-- =================================================
                             RIGHT COLUMN: DETECTION RESULT
                        ================================================== --}}

                        <div class="show-result-column">

                            <div class="show-result-panel {{ $prediction->label == 'FAKE' ? 'show-result-panel--fake' : 'show-result-panel--real' }}">

                                {{-- RESULT HEADER --}}
                                <div class="show-result-header">

                                    <span>03 // AI VERDICT</span>

                                    <span class="show-result-indicator">
                                        <i></i>

                                        {{ $prediction->label == 'FAKE' ? 'WARNING' : 'VERIFIED' }}
                                    </span>

                                </div>


                                {{-- RESULT CONTENT --}}
                                <div class="show-result-content">

                                    <p class="show-result-caption">
                                        STATUS ANALISIS AI
                                    </p>

                                    <h3 class="show-result-label glitch-hover"
                                        data-text="{{ $prediction->label }}">

                                        {{ $prediction->label }}

                                    </h3>

                                    <p class="show-result-description">

                                        {{ $prediction->label == 'FAKE'
                                            ? 'Potentially manipulated image'
                                            : 'Likely authentic image'
                                        }}

                                    </p>


                                    {{-- CONFIDENCE --}}
                                    <div class="show-confidence-section">

                                        <div class="flex justify-between items-center gap-3">

                                            <span>
                                                Tingkat Kepercayaan
                                            </span>

                                            <strong>
                                                {{ $prediction->confidence }}%
                                            </strong>

                                        </div>

                                        <div class="show-confidence-track">

                                            <div
                                                class="show-confidence-fill {{ $prediction->label == 'FAKE' ? 'show-confidence-fill--fake' : 'show-confidence-fill--real' }}"
                                                data-meter-width="{{ $prediction->confidence }}">
                                            </div>

                                        </div>

                                    </div>


                                    {{-- METADATA --}}
                                    <div class="show-result-metadata">

                                        <div class="show-metadata-item">

                                            <span>Waktu Deteksi</span>

                                            <strong>
                                                {{ $prediction->created_at->format('d M Y, H:i:s') }}
                                            </strong>

                                        </div>


                                        @if($prediction->image_hash)

                                            <div class="show-metadata-item show-hash-item">

                                                <span>Sidik Jari Citra (Hash)</span>

                                                <div class="show-hash-value">

                                                    <code>
                                                        {{ substr($prediction->image_hash, 0, 10) }}...
                                                    </code>

                                                    <button
                                                        type="button"
                                                        data-copy="{{ $prediction->image_hash }}"
                                                        class="show-copy-button"
                                                        aria-label="Salin image hash">

                                                        COPY

                                                    </button>

                                                </div>

                                            </div>

                                        @endif

                                    </div>

                                </div>


                                {{-- RESULT FOOTER --}}
                                <div class="show-result-footer">

                                    <span>
                                        MODEL // EFFICIENTNET-B2
                                    </span>

                                    <span>
                                        OUTPUT GENERATED
                                    </span>

                                </div>

                            </div>


                            {{-- ANALYSIS NOTE --}}
                            <div class="show-analysis-note">

                                <span class="show-note-indicator">
                                    <i></i>
                                    ANALYSIS NOTICE
                                </span>

                                <p>
                                    Hasil identifikasi merupakan prediksi berbasis AI.
                                    Nilai confidence menunjukkan tingkat keyakinan model,
                                    bukan jaminan kebenaran mutlak.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </section>



            {{-- =====================================================
                 XAI DATA PREPARATION
            ====================================================== --}}

            @php
                $xaiData = null;

                if ($prediction->analysis_details) {
                    $xaiData = is_string($prediction->analysis_details)
                        ? json_decode($prediction->analysis_details, true)
                        : $prediction->analysis_details;
                }
            @endphp



            {{-- =====================================================
                 EXPLAINABLE AI REPORT
            ====================================================== --}}

            @if($xaiData)

                <section class="terminal-feature-card show-xai-card"
                         data-reveal>

                    {{-- TERMINAL HEADER --}}
                    <div class="terminal-feature-header">

                        <span>02 // EXPLAINABLE AI SYSTEM</span>

                        <span class="terminal-status">
                            XAI ANALYSIS
                        </span>

                    </div>


                    {{-- TERMINAL BODY --}}
                    <div class="terminal-feature-body show-xai-body">


                        {{-- XAI HEADING --}}
                        <div class="show-xai-heading">

                            <div>
                                <p class="show-section-label">
                                    MODEL INTERPRETATION / GRAD-CAM
                                </p>

                                <h3 class="show-xai-title">
                                    Interpretasi Forensik Visual (XAI)
                                </h3>

                                <p class="show-xai-subtitle">
                                    Analisis distribusi anomali berdasarkan area anatomi wajah.
                                </p>
                            </div>

                            <span class="show-xai-icon">
                                XAI
                            </span>

                        </div>


                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">


                            {{-- =================================================
                                 LEFT: ANATOMICAL AREA ANALYSIS
                            ================================================== --}}

                            <div class="show-xai-section">

                                <div class="show-xai-section-heading">

                                    <span class="show-section-index">
                                        01
                                    </span>

                                    <h4>
                                        Distorsi Area Anatomi Wajah
                                    </h4>

                                </div>


                                <div class="show-anomaly-list">

                                    @forelse($xaiData as $bagian => $persentase)

                                        @php
                                            $barWidth = max(0, min(100, (float) $persentase));
                                        @endphp

                                        <div class="show-anomaly-item">

                                            <div class="flex justify-between items-center gap-3 mb-2">

                                                <span class="show-anomaly-name">
                                                    Area {{ $bagian }}
                                                </span>

                                                <strong class="{{ $barWidth > 40 ? 'show-anomaly-value--high' : 'show-anomaly-value--normal' }}">
                                                    {{ $barWidth }}% Anomali
                                                </strong>

                                            </div>

                                            <div class="show-anomaly-track">

                                                <div
                                                    class="show-anomaly-fill {{ $barWidth > 40 ? 'show-anomaly-fill--high' : 'show-anomaly-fill--normal' }}"
                                                    data-meter-width="{{ $barWidth }}"
                                                    style="width: {{ $barWidth }}%;">
                                                </div>

                                            </div>

                                        </div>

                                    @empty
                                        {{-- Empty state sebelumnya tetap dipertahankan --}}
                                    @endforelse

                                </div>


                                <p class="show-xai-footnote">
                                    SYSTEM OUTPUT // ANATOMICAL ANALYSIS
                                </p>

                            </div>



                            {{-- =================================================
                                 RIGHT: SYSTEM CONCLUSION
                            ================================================== --}}

                            <div class="show-xai-section show-xai-conclusion">

                                <div class="show-xai-section-heading">

                                    <span class="show-section-index">
                                        02
                                    </span>

                                    <h4>
                                        Kesimpulan Sistem
                                    </h4>

                                </div>


                                {{-- CONCLUSION --}}
                                <div class="show-conclusion-box {{ $prediction->label === 'FAKE' ? 'show-conclusion-box--fake' : 'show-conclusion-box--real' }}">

                                    <span class="show-conclusion-label">

                                        {{ $prediction->label === 'FAKE'
                                            ? 'MANIPULATION DETECTED'
                                            : 'AUTHENTICITY INDICATED'
                                        }}

                                    </span>


                                    @if($prediction->label === 'FAKE')

                                        <p>
                                            Model mendeteksi adanya manipulasi digital
                                            tingkat piksel. Area pada <i>heatmap</i>
                                            dengan warna <strong>merah pekat dan kuning</strong>
                                            menunjukkan letak artefak manipulasi wajah
                                            (seperti anomali pada mata, pinggiran bibir,
                                            atau batas <i>blending</i> kulit) yang tidak
                                            wajar atau tidak konsisten dengan anatomi asli.
                                        </p>

                                    @else

                                        <p>
                                            Wajah teridentifikasi otentik tanpa jejak
                                            rekayasa digital. Area yang tersorot pada
                                            <i>heatmap</i> hanyalah fitur wajah alami
                                            dominan yang memberikan parameter keyakinan
                                            tertinggi pada AI bahwa tidak ada distorsi
                                            artifisial pada susunan piksel tersebut.
                                        </p>

                                    @endif

                                </div>


                                {{-- HEATMAP LEGEND --}}
                                <div class="show-heatmap-legend">

                                    <p>
                                        LEGENDA PETA PANAS (HEATMAP)
                                    </p>

                                    <div class="show-legend-content">

                                        <span>
                                            Aman (Biru)
                                        </span>

                                        <div class="show-legend-gradient"></div>

                                        <span>
                                            Anomali (Merah)
                                        </span>

                                    </div>

                                </div>


                                <p class="show-xai-footnote">
                                    INTERPRETATION // GRAD-CAM
                                </p>

                            </div>

                        </div>


                        {{-- XAI FOOTER --}}
                        <div class="show-xai-footer">

                            <span>
                                SYSTEM // REALORNOT AI
                            </span>

                            <span>
                                EXPLAINABLE AI MODULE: ACTIVE
                            </span>

                        </div>

                    </div>

                </section>

            @endif

        </div>

    </div>

</x-app-layout>