<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Top Trending (Sering Diuji)') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @forelse ($trendings as $item)
                    <div class="bg-gray-800 rounded-lg shadow-md border border-gray-700 overflow-hidden">
                        <div class="h-48 w-full bg-gray-900 flex justify-center items-center overflow-hidden">
                            <img src="{{ asset('storage/uploads/' . $item->sample_file) }}" alt="Trending" class="h-full object-cover">
                        </div>
                        <div class="p-5">
                            <div class="flex justify-between items-center mb-2">
                                <span class="bg-blue-900 text-blue-300 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    Diuji {{ $item->total_count }} Kali
                                </span>
                                <span class="font-bold {{ $item->label == 'FAKE' ? 'text-red-500' : 'text-green-500' }}">
                                    {{ $item->label }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 truncate mt-3">Hash: {{ $item->image_hash }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 text-gray-500">
                        Belum ada data gambar yang memiliki kesamaan (Trending). 
                        Silakan unggah gambar yang sama berulang kali untuk menguji fitur ini.
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>