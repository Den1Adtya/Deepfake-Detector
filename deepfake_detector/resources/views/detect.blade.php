<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            {{ __('Deepfake Detection Workspace') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">Unggah Citra Wajah</h3>
                    
                    <!-- Form Upload -->
                    <!-- Form Upload -->
                    <form action="{{ route('detect.index') }}" method="POST" enctype="multipart/form-data" id="uploadForm" class="mt-6">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-300 mb-2" for="image">Unggah Foto Wajah</label>
                            <input class="block w-full text-sm text-gray-300 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none" 
                                id="imageInput" name="image" type="file" accept="image/*" required onchange="previewImage(event)">
                        </div>

                        <!-- Area Pratinjau (Disembunyikan secara default) -->
                        <div id="previewContainer" class="hidden mb-6 flex flex-col items-center border border-gray-700 p-4 rounded-lg bg-gray-800">
                            <span class="text-sm text-green-400 mb-2 font-semibold">✓ Gambar berhasil dimuat dan siap dianalisis</span>
                            <img id="imagePreview" src="" alt="Pratinjau" class="max-h-64 rounded-md object-contain shadow-md">
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" id="submitBtn" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-6 rounded-md transition duration-150 flex items-center justify-center w-full md:w-auto">
                            <span id="btnText">Analisis Gambar Sekarang</span>
                            
                            <!-- Animasi Loading (Disembunyikan secara default) -->
                            <span id="btnLoading" class="hidden flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Sedang Menganalisis AI... (Mohon Tunggu)
                            </span>
                        </button>
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
                                        <img src="{{ asset('storage/uploads/' . session('heatmap_image')) }}" alt="Heatmap Grad-CAM" class="rounded-md max-h-64 object-contain mx-auto shadow-lg border border-gray-600">                                    @else
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
    <script>
    // Fungsi untuk menampilkan gambar seketika setelah dipilih
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            // Munculkan wadah pratinjau
            document.getElementById('previewContainer').classList.remove('hidden');
        }
        
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

            // Fungsi untuk mengubah status tombol saat diklik
            document.getElementById('uploadForm').addEventListener('submit', function() {
                // Sembunyikan teks asli
                document.getElementById('btnText').classList.add('hidden');
                
                // Munculkan spinner dan teks loading
                document.getElementById('btnLoading').classList.remove('hidden');
                
                // Buat tombol menjadi redup dan cegah klik ganda (pointer-events-none)
                const btn = document.getElementById('submitBtn');
                btn.classList.add('opacity-70', 'pointer-events-none');
            });
        </script>
</x-app-layout>