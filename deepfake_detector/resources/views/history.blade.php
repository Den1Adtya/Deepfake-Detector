<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Riwayat Analisis') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700 p-6">
                <h3 class="text-lg font-medium mb-4 ">Log Deteksi Deepfake</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-400">
                        <thead class="text-xs text-gray-300 uppercase bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">Waktu</th>
                                <th scope="col" class="px-6 py-3">Nama Berkas</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Confidence</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($predictions as $item)
                                <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-700">
                                    <td class="px-6 py-4">{{ $item->created_at->format('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4">{{ $item->filename }}</td>
                                    <td class="px-6 py-4 font-bold {{ $item->label == 'FAKE' ? 'text-red-500' : 'text-green-500' }}">
                                        {{ $item->label }}
                                    </td>
                                    <td class="px-6 py-4">{{ $item->confidence }}%</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat deteksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>