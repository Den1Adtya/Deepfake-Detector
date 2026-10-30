<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Prediction;

class DetectionController extends Controller
{
    public function detect(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/uploads', $filename);

        // Kirim ke API Flask
        $response = Http::attach(
            'image', file_get_contents($file->getPathname()), $filename
        )->post('http://127.0.0.1:5000/api/predict');

        if ($response->successful()) {
            $result = $response->json();

            // 1. Decode Base64 dari Flask menjadi file gambar asli
            $heatmapData = base64_decode($result['heatmap_image']);
            $heatmapFilename = 'heatmap_' . time() . '.jpg';
            
            // 2. Simpan file fisik di folder storage/app/public/uploads
            Storage::put('public/uploads/' . $heatmapFilename, $heatmapData);

            Prediction::insert([
                'filename' => $filename,
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
    public function history()
    {
        // Mengambil semua data prediksi dari terbaru ke terlama
        $predictions = Prediction::orderBy('created_at', 'desc')->get();
        
        return view('history', compact('predictions'));
    }
}