<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Deepfake Detection Workspace') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">Unggah Citra Wajah</h3>
                    
                    <!-- Form Upload -->
                    <form action="{{ route('detect.process') }}" method="POST" enctype="multipart/form-data" class="mb-8">
                        @csrf
                        <div class="flex items-center justify-center w-full mb-4">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-700 hover:bg-gray-600 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-400"><span class="font-semibold">Klik untuk mengunggah</span></p>
                                    <p class="text-xs text-gray-400">PNG, JPG atau JPEG (Maks. 5MB)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="image" class="hidden" accept="image/jpeg, image/png, image/jpg" required />
                            </label>
                        </div>
                        <x-primary-button class="w-full justify-center text-lg py-3">
                            {{ __('Mulai Analisis AI') }}
                        </x-primary-button>
                    </form>

                    <!-- Panel Hasil Analisis (Akan muncul setelah gambar diproses) -->
                    @if (session('success'))
                        <div class="mt-8 border-t border-gray-700 pt-6">
                            <h3 class="text-xl font-bold mb-4">Hasil Analisis Visual</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Status Prediksi -->
                                <div class="bg-gray-700 p-4 rounded-lg flex flex-col justify-center items-center">
                                    <span class="text-sm text-gray-400 uppercase tracking-wider mb-2">Status Identifikasi</span>
                                    <span class="text-4xl font-black {{ session('label') == 'FAKE' ? 'text-red-500' : 'text-green-500' }}">
                                        {{ session('label') ?? 'N/A' }}
                                    </span>
                                    <span class="mt-2 text-lg text-gray-300">
                                        Confidence: <span class="font-bold">{{ session('confidence') ?? '0' }}%</span>
                                    </span>
                                </div>

                                <!-- Heatmap Grad-CAM -->
                                <div class="bg-gray-700 p-4 rounded-lg flex flex-col items-center">
                                    <span class="text-sm text-gray-400 uppercase tracking-wider mb-2">Grad-CAM Heatmap</span>
                                    @if(session('heatmap_image'))
                                        <img src="{{ asset('storage/uploads/' . session('heatmap_image')) }}" alt="Heatmap" class="rounded-md max-h-48 object-contain">                                    @else
                                        <div class="h-48 flex items-center justify-center text-gray-500">
                                            Visualisasi tidak tersedia
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mt-4 bg-red-900/50 border border-red-500 text-red-200 px-4 py-3 rounded">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>