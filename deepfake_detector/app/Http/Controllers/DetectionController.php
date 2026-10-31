<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Prediction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        if (!$response->successful() || $response->json('status') === 'error') {
            $errorMessage = $response->json('message') ?? 'Terjadi kesalahan saat memproses gambar di server AI.';
            
            // Hapus gambar yang tadi terlanjur diupload pengguna agar tidak menumpuk
            Storage::disk('public')->delete('uploads/' . $filename); 
            
            // Kembalikan ke halaman upload dengan pesan error
            return back()->with('error', $errorMessage);
        }
        
        if ($response->successful()) {
            $result = $response->json();
            
            // 1. Decode Base64 dari Flask menjadi file gambar asli
            $heatmapData = base64_decode($result['heatmap_image']);
            $heatmapFilename = 'heatmap_' . time() . '.jpg';
            $heatmapData = base64_decode($result['heatmap_image']);
            Storage::disk('public')->put('uploads/' . $heatmapFilename, $heatmapData);
            

            Prediction::insert([
                'user_id' => Auth::id(),
                'filename' => $filename,
                'heatmap_file' => $heatmapFilename,
                'analysis_details' => isset($result['regional_analysis']) ? json_encode($result['regional_analysis']) : null,
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
        
        // Mulai query dengan memfilter HANYA data milik user yang sedang login
        $query = Prediction::where('user_id', Auth::id())
                           ->orderBy('created_at', 'desc');
        
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
            ->having('total_count', '>=', 3)
            ->orderByDesc('total_count')
            ->limit(9)
            ->get();
            
        return view('trending', compact('trendings'));
    }
}