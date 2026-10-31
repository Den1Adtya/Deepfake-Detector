<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Detail Hasil Identifikasi') }}
            </h2>
            <a href="{{ route('detect.history') }}" class="text-sm bg-gray-700 hover:bg-gray-600 text-gray-200 py-2 px-4 rounded transition">
                ← Kembali ke Riwayat
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen text-gray-100">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- BLOK 1: INFORMASI UTAMA & GAMBAR -->
            <div class="bg-gray-800 shadow-lg sm:rounded-lg border border-gray-700 p-6 mb-8">
                <!-- Grid Wrapper agar Sisi Kiri dan Kanan Bersebelahan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Sisi Kiri: Gambar Asli & Heatmap -->
                    <div class="flex flex-col space-y-4">
                        <div>
                            <span class="text-sm text-gray-400 uppercase tracking-wider mb-2 block">Citra Wajah Asli</span>
                            <div class="bg-gray-900 p-2 rounded-lg border border-gray-700 flex justify-center items-center h-48">
                                <img src="{{ asset('storage/uploads/' . $prediction->filename) }}" alt="Gambar Wajah" class="max-h-full rounded object-contain">
                            </div>
                        </div>

                        @if($prediction->heatmap_file)
                        <div>
                            <span class="text-sm text-gray-400 uppercase tracking-wider mb-2 block">Visualisasi Grad-CAM</span>
                            <div class="bg-gray-900 p-2 rounded-lg border border-gray-700 flex justify-center items-center h-48 relative overflow-hidden">
                                <img src="{{ asset('storage/uploads/' . $prediction->heatmap_file) }}" alt="Heatmap" class="max-h-full rounded object-contain border border-gray-600">
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Sisi Kanan: Informasi Prediksi -->
                    <div class="flex flex-col justify-center">
                        <div class="bg-gray-700 p-6 rounded-lg text-center border shadow-inner {{ $prediction->label == 'FAKE' ? 'border-red-500/50' : 'border-green-500/50' }}">
                            <span class="text-sm text-gray-300 uppercase tracking-wider mb-2 block">Status Analisis AI</span>
                            <span class="text-5xl font-black {{ $prediction->label == 'FAKE' ? 'text-red-500' : 'text-green-500' }}">
                                {{ $prediction->label }}
                            </span>
                            
                            <div class="mt-6 space-y-4 text-left">
                                <div class="flex justify-between border-b border-gray-600 pb-2">
                                    <span class="text-gray-400">Tingkat Kepercayaan</span>
                                    <span class="font-bold text-gray-200">{{ $prediction->confidence }}%</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-600 pb-2">
                                    <span class="text-gray-400">Waktu Deteksi</span>
                                    <span class="text-gray-200">{{ $prediction->created_at->format('d M Y, H:i:s') }}</span>
                                </div>
                                @if($prediction->image_hash)
                                <div class="flex justify-between border-b border-gray-600 pb-2">
                                    <span class="text-gray-400">Sidik Jari Citra (Hash)</span>
                                    <span class="text-gray-200 text-xs font-mono self-center">{{ substr($prediction->image_hash, 0, 10) }}...</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- BLOK 2: PANEL EXPLAINABLE AI (XAI) -->
            @php
                $xaiData = null;
                if($prediction->analysis_details) {
                    $xaiData = is_string($prediction->analysis_details) ? json_decode($prediction->analysis_details, true) : $prediction->analysis_details;
                }
            @endphp

            @if($xaiData)
            <div class="bg-gray-800 shadow-lg sm:rounded-lg border border-gray-700 p-6">
                <h3 class="text-xl font-bold text-white mb-6 border-b border-gray-700 pb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Interpretasi Forensik Visual (XAI)
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Kolom Kiri: Bar Persentase Anatomi -->
                    <div>
                        <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Distorsi Area Anatomi Wajah</h4>
                        <div class="space-y-4">
                            @foreach($xaiData as $bagian => $persentase)
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="font-medium text-gray-300">Area {{ $bagian }}</span>
                                        <span class="{{ $persentase > 40 ? 'text-red-400' : 'text-green-400' }} font-bold">{{ $persentase }}% Anomali</span>
                                    </div>
                                    <div class="w-full bg-gray-900 border border-gray-700 rounded-full h-2.5">
                                        <div class="h-2.5 rounded-full {{ $persentase > 40 ? 'bg-red-500' : 'bg-green-500' }} transition-all duration-1000" style="width: {{ $persentase }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Kolom Kanan: Kesimpulan & Legenda Warna -->
                    <div class="flex flex-col justify-center">
                        <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Kesimpulan Sistem</h4>
                        
                        <div class="p-4 rounded-md border shadow-inner {{ $prediction->label === 'FAKE' ? 'bg-red-900/20 border-red-800/50 text-red-200' : 'bg-green-900/20 border-green-800/50 text-green-200' }} mb-4 text-sm leading-relaxed">
                            @if($prediction->label === 'FAKE')
                                Model mendeteksi adanya manipulasi digital tingkat piksel. Area pada <i>heatmap</i> dengan warna <strong>merah pekat dan kuning</strong> menunjukkan letak artefak manipulasi wajah (seperti anomali pada mata, pinggiran bibir, atau batas <i>blending</i> kulit) yang tidak wajar atau tidak konsisten dengan anatomi asli.
                            @else
                                Wajah teridentifikasi otentik tanpa jejak rekayasa digital. Area yang tersorot pada <i>heatmap</i> hanyalah fitur wajah alami dominan yang memberikan parameter keyakinan tertinggi pada AI bahwa tidak ada distorsi artifisial pada susunan piksel tersebut.
                            @endif
                        </div>

                        <!-- Legenda Warna -->
                        <div class="mt-auto bg-gray-900/50 p-3 rounded border border-gray-700">
                            <p class="text-xs text-gray-400 mb-2">Legenda Peta Panas (Heatmap):</p>
                            <div class="flex items-center space-x-2 text-xs font-medium text-gray-400">
                                <span>Aman (Biru)</span>
                                <div class="h-2 flex-grow bg-gradient-to-r from-blue-600 via-green-400 via-yellow-400 to-red-600 rounded"></div>
                                <span>Anomali (Merah)</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>