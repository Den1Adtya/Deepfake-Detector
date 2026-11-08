<x-app-layout>

    {{-- PAGE HEADER --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-[10px] font-mono tracking-[.24em] uppercase text-[#39FF14] mb-1">
                    Forensics / 02
                </p>
                <h2 class="font-semibold text-xl text-[#F5FFF7] leading-tight glitch-hover"
                    data-text="Deepfake Detection Workspace">
                    {{ __('Deepfake Detection Workspace') }}
                </h2>
            </div>

            <span class="system-live">
                <i class="system-live__dot"></i>
                ENGINE READY
            </span>
        </div>
    </x-slot>


    {{-- DETECTION WORKSPACE --}}
    <div class="detect-page-wrapper min-h-screen pt-3 pb-12 text-[#F5FFF7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- INTRO --}}
            <div class="mb-7" data-reveal>
                <p class="text-[10px] font-mono tracking-[.2em] uppercase text-[#89968D]">
                    Input terminal / Image authenticity
                </p>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight mt-2">
                    Submit an image for analysis<span class="text-[#39FF14]">.</span>
                </h1>
                <p class="text-sm text-[#89968D] mt-2 max-w-2xl leading-7">
                    Pilih atau tarik gambar wajah ke area upload. Sistem akan menyiapkan preview sebelum mengirim citra ke model deteksi.
                </p>
            </div>


            {{-- SESSION ERROR --}}
            @if(session('error'))
                <section class="terminal-feature-card detect-alert-card mb-6" role="alert" data-reveal>
                    <div class="terminal-feature-header detect-terminal-header--red">
                        <span>! // ANALYSIS INTERRUPTED</span>
                        <span class="terminal-status">SYSTEM WARNING</span>
                    </div>
                    <div class="terminal-feature-body detect-alert-body">
                        <div class="flex items-start gap-3">
                            <span class="text-xl text-[#FF3030]" aria-hidden="true">⚠</span>
                            <div>
                                <p class="font-bold text-sm text-[#FF4A4A]">Analisis dibatalkan</p>
                                <p class="text-sm mt-1 text-[#C9B7B7]">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                </section>
            @endif


            {{-- UPLOAD + PIPELINE --}}
            <div class="grid xl:grid-cols-[1.35fr_.65fr] gap-5 items-start">

                {{-- UPLOAD WORKSPACE --}}
                <section class="terminal-feature-card detect-upload-card" data-reveal>
                    <div class="terminal-feature-header">
                        <span>01 // INPUT IMAGE</span>
                        <span class="terminal-status">JPG · PNG</span>
                    </div>

                    <div class="terminal-feature-body detect-card-body">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                            <div>
                                <p class="text-[10px] font-mono tracking-[.2em] uppercase text-[#7CFF6B]">
                                    Image ingestion / Upload source
                                </p>
                                <h3 class="terminal-feature-title mt-2 mb-0">
                                    Unggah citra wajah
                                </h3>
                            </div>
                            <span class="detect-format-badge">IMAGE // JPG · PNG</span>
                        </div>

                        <form action="{{ route('detect.index') }}"
                              method="POST"
                              enctype="multipart/form-data"
                              id="uploadForm"
                              class="space-y-5">
                            @csrf

                            {{-- DROPZONE --}}
                            <label for="imageInput"
                                   id="uploadDropzone"
                                   class="upload-dropzone detect-upload-dropzone text-center px-5 py-8">
                                <div class="relative z-10 pointer-events-none">
                                    <div class="upload-dropzone__icon">
                                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="1.7">
                                            <path d="M12 16V4m0 0L7 9m5-5 5 5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M4 16v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3" stroke-linecap="round"/>
                                        </svg>
                                    </div>

                                    <p class="text-sm font-bold text-white">Drop your image here</p>
                                    <p class="text-xs text-[#89968D] mt-2">
                                        or <span class="text-[#39FF14] font-semibold">browse files</span> from your device
                                    </p>
                                    <p id="selectedFileName" class="text-[11px] font-mono text-[#7CFF6B] mt-4">
                                        No file selected
                                    </p>
                                    <p class="text-[10px] text-[#657168] mt-2">
                                        Image files only · Supported format depends on server validation
                                    </p>
                                </div>

                                <input id="imageInput"
                                       name="image"
                                       type="file"
                                       accept="image/*"
                                       required
                                       class="upload-dropzone__input"
                                       aria-label="Unggah foto wajah">
                            </label>

                            @error('image')
                                <p class="text-sm text-[#FF4A4A]" role="alert">{{ $message }}</p>
                            @enderror


                            {{-- IMAGE PREVIEW --}}
                            <div id="previewContainer" class="hidden detect-preview-card">
                                <div class="terminal-feature-header detect-preview-header">
                                    <span>02 // PREVIEW BUFFER</span>
                                    <button type="button"
                                            id="clearUploadButton"
                                            class="detect-remove-button">
                                        REMOVE IMAGE ×
                                    </button>
                                </div>

                                <div class="detect-preview-body">
                                    <p class="text-xs text-[#89968D] mb-3">
                                        Image loaded · Ready for analysis
                                    </p>
                                    <div class="preview-scanner detect-preview-scanner">
                                        <img id="imagePreview"
                                             src=""
                                             alt="Pratinjau gambar yang akan dianalisis"
                                             class="max-h-72 w-auto max-w-full object-contain rounded-lg">
                                    </div>
                                </div>
                            </div>


                            {{-- FORM ACTION --}}
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">
                                <p class="text-[10px] text-[#718077] leading-relaxed max-w-md">
                                    Pastikan gambar memiliki kualitas yang cukup dan wajah terlihat jelas. Hasil model merupakan prediksi berbasis AI, bukan verifikasi mutlak.
                                </p>

                                    <button type="submit"
                                            id="submitBtn"
                                            class="realornot-glitch-secondary w-full sm:w-auto gap-3 px-6 py-3.5">

                                        <span id="btnText" class="realornot-glitch-secondary__text">
                                            Run AI analysis
                                        </span>

                                    </button>
                            </div>
                        </form>

                        <div class="terminal-feature-footer detect-upload-footer">
                            <span>INPUT: USER PROVIDED</span>
                            <span>FORMAT: IMAGE</span>
                        </div>
                    </div>
                </section>


                {{-- PIPELINE SIDE PANEL --}}
                <aside class="terminal-feature-card detect-pipeline-card" data-reveal>
                    <div class="terminal-feature-header">
                        <span>02 // SYSTEM PIPELINE</span>
                        <span class="terminal-status">OPERATIONAL</span>
                    </div>

                    <div class="terminal-feature-body detect-card-body">
                        <div class="flex items-center justify-between gap-3 mb-5">
                            <div>
                                <p class="text-[10px] font-mono tracking-[.2em] uppercase text-[#89968D]">
                                    Processing sequence
                                </p>
                                <h3 class="terminal-feature-title mt-2 mb-0">Analysis protocol</h3>
                            </div>
                            <span class="status-pulse" aria-label="Ready"></span>
                        </div>

                        <div class="pipeline-list detect-pipeline-list">
                            <div class="pipeline-step pipeline-step--active">
                                <span class="pipeline-step__number">01</span>
                                <div>
                                    <p class="text-sm font-semibold text-white">Image ingestion</p>
                                    <p class="text-xs text-[#718077] mt-1">Read and prepare uploaded image</p>
                                </div>
                                <span class="pipeline-step__state">READY</span>
                            </div>

                            <div class="pipeline-step">
                                <span class="pipeline-step__number">02</span>
                                <div>
                                    <p class="text-sm font-semibold text-white">EfficientNet-B2</p>
                                    <p class="text-xs text-[#718077] mt-1">Extract visual features and predict</p>
                                </div>
                                <span class="pipeline-step__state">MODEL</span>
                            </div>

                            <div class="pipeline-step">
                                <span class="pipeline-step__number">03</span>
                                <div>
                                    <p class="text-sm font-semibold text-white">Grad-CAM</p>
                                    <p class="text-xs text-[#718077] mt-1">Visualize areas influencing prediction</p>
                                </div>
                                <span class="pipeline-step__state">XAI</span>
                            </div>

                            <div class="pipeline-step">
                                <span class="pipeline-step__number">04</span>
                                <div>
                                    <p class="text-sm font-semibold text-white">Result output</p>
                                    <p class="text-xs text-[#718077] mt-1">Store and display analysis summary</p>
                                </div>
                                <span class="pipeline-step__state">REPORT</span>
                            </div>
                        </div>

                        <div class="detect-pipeline-note">
                            <div class="flex items-center gap-2 text-[10px] font-mono uppercase tracking-wider text-[#89968D]">
                                <span class="status-pulse"></span>
                                Environment status: operational
                            </div>
                            <p class="text-xs text-[#718077] leading-relaxed mt-3">
                                Green and red markers are visual status cues. Always read the accompanying REAL / FAKE label and confidence value.
                            </p>
                        </div>

                        <div class="terminal-feature-footer">
                            <span>ENGINE: EFFICIENTNET-B2</span>
                            <span>PIPELINE_01</span>
                        </div>
                    </div>
                </aside>
            </div>


            {{-- ANALYSIS RESPONSE --}}
            @if (session('success'))
                <section class="terminal-feature-card detect-result-section mt-7" data-reveal aria-live="polite">
                    <div class="terminal-feature-header">
                        <span>04 // ANALYSIS OUTPUT</span>
                        <span class="terminal-status">PROCESS COMPLETE</span>
                    </div>

                    <div class="terminal-feature-body detect-result-body">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                            <div>
                                <p class="text-[10px] font-mono tracking-[.2em] uppercase text-[#7CFF6B]">
                                    Forensics report / Classification
                                </p>
                                <h3 class="terminal-feature-title mt-2 mb-0">Hasil analisis visual</h3>
                            </div>
                            <span class="detect-format-badge">PROCESS COMPLETE</span>
                        </div>

                        <div class="grid md:grid-cols-2 gap-5">

                            {{-- VERDICT --}}
                            <div class="result-panel detect-verdict-card {{ session('label') == 'FAKE' ? 'result-panel--fake' : 'result-panel--real' }} rounded-xl p-6 flex flex-col items-center justify-center text-center">
                                <span class="text-[10px] font-mono tracking-[.2em] text-[#89968D] uppercase mb-3">
                                    Detection verdict
                                </span>

                                <span class="text-5xl sm:text-6xl font-black tracking-tight">
                                    {{ session('label') ?? 'N/A' }}
                                </span>

                                <span class="mt-4 text-sm text-[#B7C4BA]">
                                    Confidence
                                    <strong class="text-white">{{ session('confidence') ?? '0' }}%</strong>
                                </span>

                                <div class="w-full mt-5 meter-track rounded-full h-2">
                                    <div class="meter-fill h-full rounded-full {{ session('label') == 'FAKE' ? 'detect-meter--fake' : 'bg-[#39FF14]' }}"
                                         data-meter-width="{{ session('confidence') ?? 0 }}"></div>
                                </div>

                                <p class="text-[10px] text-[#89968D] mt-3">
                                    AI prediction · Review supporting evidence
                                </p>
                            </div>


                            {{-- GRAD-CAM HEATMAP --}}
                            <div class="terminal-feature-card detect-heatmap-card">
                                <div class="terminal-feature-header">
                                    <span>05 // GRAD-CAM HEATMAP</span>
                                    <span class="terminal-status">XAI OUTPUT</span>
                                </div>

                                <div class="terminal-feature-body detect-heatmap-body">
                                    @if(session('heatmap_image'))
                                        <div class="preview-scanner detect-heatmap-preview">
                                            <img data-image-zoom
                                                 src="{{ asset('storage/uploads/' . session('heatmap_image')) }}"
                                                 alt="Heatmap Grad-CAM"
                                                 class="rounded-md max-h-64 object-contain mx-auto">
                                        </div>
                                        <p class="text-[10px] text-[#718077] mt-3 text-center">
                                            Click the heatmap to enlarge
                                        </p>
                                    @else
                                        <div class="detect-heatmap-empty">
                                            Visualisasi tidak tersedia
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="terminal-feature-footer mt-6">
                            <span>REPORT: GENERATED</span>
                            <span>REALORNOT // FORENSICS</span>
                        </div>
                    </div>
                </section>
            @endif

        </div>
    </div>

</x-app-layout>
