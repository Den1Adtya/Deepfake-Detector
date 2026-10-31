<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard Analisis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Kartu Metrik Ringkas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Analisis -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 shadow-lg text-center">
                    <h3 class="text-sm font-medium text-gray-400 uppercase tracking-widest">Total Gambar Dianalisis</h3>
                    <p class="text-4xl font-bold text-white mt-2">{{ $totalScans }}</p>
                </div>
                <!-- Total Deepfake -->
                <div class="bg-gray-800 border border-red-900/50 rounded-lg p-6 shadow-lg text-center">
                    <h3 class="text-sm font-medium text-red-400 uppercase tracking-widest">Terdeteksi FAKE</h3>
                    <p class="text-4xl font-bold text-red-500 mt-2">{{ $totalFake }}</p>
                </div>
                <!-- Total Wajah Asli -->
                <div class="bg-gray-800 border border-green-900/50 rounded-lg p-6 shadow-lg text-center">
                    <h3 class="text-sm font-medium text-green-400 uppercase tracking-widest">Terdeteksi REAL</h3>
                    <p class="text-4xl font-bold text-green-500 mt-2">{{ $totalReal }}</p>
                </div>
            </div>

            <!-- Wadah Grafik Chart.js -->
            <div class="bg-gray-800 border border-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100 flex flex-col md:flex-row items-center justify-between">
                    
                    <!-- Grafik Donut -->
                    <div class="w-full md:w-1/3 flex justify-center mb-6 md:mb-0 relative h-64">
                        @if($totalScans > 0)
                            <canvas id="statsChart"></canvas>
                        @else
                            <div class="flex items-center justify-center h-full w-full text-gray-500 border-2 border-dashed border-gray-600 rounded-full aspect-square">
                                Belum ada data
                            </div>
                        @endif
                    </div>

                    <!-- CTA Analisis Baru -->
                    <div class="w-full md:w-2/3 md:pl-12 text-center md:text-left">
                        <h3 class="text-2xl font-bold mb-4">Mulai Forensik Wajah</h3>
                        <p class="text-gray-400 mb-6">Unggah gambar baru untuk mendeteksi manipulasi visual menggunakan AI (EfficientNet-B2). Riwayat dan distribusi deteksi Anda akan terekam secara otomatis.</p>
                        <a href="{{ url('/detect') }}" class="inline-block bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-md transition duration-150 shadow-lg">
                            + Unggah Gambar Sekarang
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Pemuatan Chart.js CDN dan Skrip Inisialisasi Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const totalScans = {{ $totalScans }};
            if(totalScans > 0) {
                const ctx = document.getElementById('statsChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['FAKE (Dimanipulasi)', 'REAL (Wajah Asli)'],
                        datasets: [{
                            data: [{{ $totalFake }}, {{ $totalReal }}],
                            backgroundColor: [
                                '#ef4444', // Red-500 for Fake
                                '#22c55e'  // Green-500 for Real
                            ],
                            borderColor: '#1f2937', // border color matches bg-gray-800
                            borderWidth: 2,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { color: '#e5e7eb', padding: 20 }
                            }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>