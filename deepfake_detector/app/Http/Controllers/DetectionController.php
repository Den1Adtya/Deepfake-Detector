<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Prediction;

class DetectionController extends Controller
{
    public function detect(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $file = $request->file('image');
        $imagePath = $request->file('image')->store('uploads', 'public');
        $filename = basename($imagePath);

        // Kirim ke API Flask
        $response = Http::attach(
            'image', file_get_contents($file->getPathname()), $filename
        )->post('http://127.0.0.1:5000/api/predict');

        if ($response->successful()) {
            $result = $response->json();

            // 1. Decode Base64 dari Flask menjadi file gambar asli
            $heatmapData = base64_decode($result['heatmap_image']);
            $heatmapFilename = 'heatmap_' . time() . '.jpg';
            $heatmapData = base64_decode($result['heatmap_image']);
            Storage::disk('public')->put('uploads/' . $heatmapFilename, $heatmapData);
            

            Prediction::insert([
                'filename' => $filename,
                'heatmap_file' => $heatmapFilename,
                'image_hash' => $result['image_hash'] ?? null,
                'label' => $result['label'],
                'confidence' => $result['confidence'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. Kembalikan nama file-nya saja ke session, BUKAN teks Base64
            return back()->with([
                'success' => true,
                'label' => $result['label'],
                'confidence' => $result['confidence'],
                'heatmap_image' => $heatmapFilename, 
            ]);
        }
        return back()->with('error', 'Gagal terhubung ke server AI. Pastikan Flask menyala.');
    }

    public function history(Request $request)
    {
        $search = $request->input('search');
        
        // Mulai query mengambil data dari terbaru
        $query = Prediction::orderBy('created_at', 'desc');
        
        // Jika ada input pencarian, saring berdasarkan nama file
        if ($search) {
            $query->where('filename', 'like', '%' . $search . '%');
        }
        
        $predictions = $query->get();
        
        return view('history', compact('predictions', 'search'));
    }

    public function show($id)
    {
        // Mencari data prediksi berdasarkan ID
        $prediction = Prediction::findOrFail($id);
        
        return view('show', compact('prediction'));
    }

    public function trending()
    {
        // Mengelompokkan gambar berdasarkan struktur visual yang sama (pHash)
        $trendings = Prediction::selectRaw('image_hash, COUNT(*) as total_count, MAX(filename) as sample_file, MAX(label) as label')
            ->whereNotNull('image_hash')
            ->groupBy('image_hash')
            ->orderByDesc('total_count')
            ->limit(9)
            ->get();
            
        return view('trending', compact('trendings'));
    }
}