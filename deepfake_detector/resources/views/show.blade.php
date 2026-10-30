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
            <div class="bg-gray-800 shadow-sm sm:rounded-lg border border-gray-700 p-6">
                
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
                            <div class="bg-gray-900 p-2 rounded-lg border border-gray-700 flex justify-center items-center h-48">
                                <img src="{{ asset('storage/uploads/' . $prediction->heatmap_file) }}" alt="Heatmap" class="max-h-full rounded object-contain border border-gray-600">
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Sisi Kanan: Informasi Prediksi -->
                    <div class="flex flex-col justify-center">
                        <div class="bg-gray-700 p-6 rounded-lg text-center border {{ $prediction->label == 'FAKE' ? 'border-red-500/50' : 'border-green-500/50' }}">
                            <span class="text-sm text-gray-300 uppercase tracking-wider mb-2 block">Status Analisis AI</span>
                            <span class="text-5xl font-black {{ $prediction->label == 'FAKE' ? 'text-red-500' : 'text-green-500' }}">
                                {{ $prediction->label }}
                            </span>
                            
                            <div class="mt-6 space-y-4 text-left">
                                <div class="flex justify-between border-b border-gray-600 pb-2">
                                    <span class="text-gray-400">Tingkat Kepercayaan (Confidence)</span>
                                    <span class="font-bold text-gray-200">{{ $prediction->confidence }}%</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-600 pb-2">
                                    <span class="text-gray-400">Waktu Deteksi</span>
                                    <span class="text-gray-200">{{ $prediction->created_at->format('d M Y, H:i:s') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>