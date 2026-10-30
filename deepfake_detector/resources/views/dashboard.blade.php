<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard Statistik') }}
        </h2>
    </x-slot>

    <div class="py-12 text-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                    <h3 class="text-gray-400 text-sm uppercase">Total Analisis</h3>
                    <p class="text-4xl font-bold mt-2 text-gray-400">{{ $total }}</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                    <h3 class="text-gray-400 text-sm uppercase">Terdeteksi FAKE</h3>
                    <p class="text-4xl font-bold mt-2 text-red-400">{{ $fake }}</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                    <h3 class="text-gray-400 text-sm uppercase">Terdeteksi REAL</h3>
                    <p class="text-4xl font-bold mt-2 text-green-400">{{ $real }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>