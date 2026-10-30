<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Riwayat Analisis') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Log Deteksi Deepfake</h3>
                    
                    <!-- Form Pencarian -->
                    <form action="{{ route('detect.history') }}" method="GET" class="flex items-center">
                        <div class="relative">
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama berkas..." class="bg-gray-700 border border-gray-600 text-gray-200 text-sm rounded-l-md focus:ring-blue-500 focus:border-blue-500 block w-64 p-2">
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 text-sm border border-blue-600 rounded-r-md transition">
                            Cari
                        </button>
                        
                        @if(!empty($search))
                            <a href="{{ route('detect.history') }}" class="ml-3 text-sm text-gray-400 hover:text-red-400 transition">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-400">
                        <thead class="text-xs text-gray-300 uppercase bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">Waktu</th>
                                <th scope="col" class="px-6 py-3">Nama Berkas</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Confidence</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($predictions as $item)
                                <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-700">
                                    <td class="px-6 py-4">{{ $item->created_at->format('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4 truncate max-w-xs">{{ $item->filename }}</td>
                                    <td class="px-6 py-4 font-bold {{ $item->label == 'FAKE' ? 'text-red-500' : 'text-green-500' }}">
                                        {{ $item->label }}
                                    </td>
                                    <td class="px-6 py-4">{{ $item->confidence }}%</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('detect.show', $item->id) }}" class="text-blue-400 hover:text-blue-300 underline text-sm">
                                            Lihat Detail
                                        </a>
                                    </td>
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