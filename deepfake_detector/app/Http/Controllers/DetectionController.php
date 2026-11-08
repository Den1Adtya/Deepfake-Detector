<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Client\ConnectionException;
use App\Models\Prediction;
use Throwable;

class DetectionController extends Controller
{
    /**
     * Menyimpan gambar Base64 dari Flask ke Laravel Storage.
     *
     * Digunakan untuk menyimpan:
     * - Cropped face image
     * - Grad-CAM heatmap
     */
    private function storeBase64Image(?string $base64, string $prefix): ?string
    {
        if (empty($base64)) {
            return null;
        }

        // Menghapus prefix data URI jika tersedia.
        if (str_contains($base64, ',')) {
            $base64 = explode(',', $base64, 2)[1];
        }

        // Decode Base64.
        $imageData = base64_decode($base64, true);

        if ($imageData === false) {
            Log::warning("Gagal decode Base64 untuk gambar: {$prefix}");
            return null;
        }

        // Validasi bahwa data benar-benar berupa gambar.
        $imageInfo = @getimagesizefromstring($imageData);

        if ($imageInfo === false) {
            Log::warning("Data gambar tidak valid: {$prefix}");
            return null;
        }

        // Tentukan ekstensi berdasarkan format gambar.
        $extension = match ($imageInfo['mime'] ?? '') {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
            default      => null,
        };

        if (!$extension) {
            Log::warning("Format gambar tidak didukung: {$prefix}");
            return null;
        }

        // Gunakan UUID agar tidak terjadi benturan nama file.
        $filename = $prefix . '_' . Str::uuid() . '.' . $extension;

        $stored = Storage::disk('public')->put(
            'uploads/' . $filename,
            $imageData
        );

        if (!$stored) {
            Log::error("Gagal menyimpan gambar: {$filename}");
            return null;
        }

        return $filename;
    }


    /**
     * Menghapus file hasil pemrosesan jika terjadi kegagalan.
     */
    private function cleanupFiles(array $filenames): void
    {
        foreach ($filenames as $filename) {
            if (!empty($filename)) {
                Storage::disk('public')->delete('uploads/' . $filename);
            }
        }
    }


    /**
     * DETECTION
     * Mengirim gambar ke Flask untuk proses Face Detection,
     * Face Cropping, EfficientNet-B2, dan Grad-CAM.
     */
    public function detect(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $file = $request->file('image');

        // Simpan gambar asli.
        $imagePath = $file->store('uploads', 'public');

        if (!$imagePath) {
            return back()->with(
                'error',
                'Gagal menyimpan gambar yang diunggah.'
            );
        }

        $filename = basename($imagePath);

        // =============================================
        // 1. KIRIM GAMBAR KE FLASK API
        // =============================================

        try {

            $response = Http::timeout(120)
                ->attach(
                    'image',
                    file_get_contents($file->getRealPath()),
                    $filename
                )
                ->post('http://127.0.0.1:5000/api/predict');

        } catch (ConnectionException $e) {

            // Hapus gambar asli jika Flask tidak dapat dihubungi.
            $this->cleanupFiles([$filename]);

            Log::error('Flask connection error: ' . $e->getMessage());

            return back()->with(
                'error',
                'Gagal terhubung ke server AI. Pastikan Flask sedang berjalan.'
            );
        }


        // =============================================
        // 2. PERIKSA RESPONSE FLASK
        // =============================================

        if (
            !$response->successful() ||
            $response->json('status') !== 'success'
        ) {

            $errorMessage = $response->json('message')
                ?? 'Terjadi kesalahan saat memproses gambar di server AI.';

            $this->cleanupFiles([$filename]);

            return back()
                ->withInput()
                ->with('error', $errorMessage);
        }

        $result = $response->json();


        // Pastikan hasil prediksi tersedia.
        if (
            empty($result['label']) ||
            !isset($result['confidence'])
        ) {

            $this->cleanupFiles([$filename]);

            return back()->with(
                'error',
                'Response server AI tidak memiliki hasil prediksi yang valid.'
            );
        }


        // =============================================
        // 3. SIMPAN HASIL CROP WAJAH
        // =============================================

        $croppedFilename = $this->storeBase64Image(
            $result['cropped_image'] ?? null,
            'cropped'
        );


        // =============================================
        // 4. SIMPAN GRAD-CAM HEATMAP
        // =============================================

        $heatmapFilename = $this->storeBase64Image(
            $result['heatmap_image'] ?? null,
            'heatmap'
        );


        // =============================================
        // 5. SIMPAN DATA PREDIKSI KE DATABASE
        // =============================================

        try {

            DB::transaction(function () use (
                $result,
                $filename,
                $croppedFilename,
                $heatmapFilename
            ) {

                Prediction::insert([

                    'user_id' => Auth::id(),

                    // Gambar asli.
                    'filename' => $filename,

                    // Gambar hasil crop wajah.
                    'cropped_file' => $croppedFilename,

                    // Grad-CAM.
                    'heatmap_file' => $heatmapFilename,

                    // Analisis regional wajah.
                    'analysis_details' => isset($result['regional_analysis'])
                        ? json_encode($result['regional_analysis'])
                        : null,

                    // Perceptual Hash.
                    'image_hash' => $result['image_hash'] ?? null,

                    // Hasil klasifikasi.
                    'label' => $result['label'],

                    'confidence' => $result['confidence'],

                    'created_at' => now(),

                    'updated_at' => now(),

                ]);

            });

        } catch (Throwable $e) {

            // Bersihkan seluruh file jika database gagal menyimpan.
            $this->cleanupFiles([
                $filename,
                $croppedFilename,
                $heatmapFilename,
            ]);

            Log::error('Prediction database error: ' . $e->getMessage());

            return back()->with(
                'error',
                'Gagal menyimpan hasil analisis ke database.'
            );
        }


        // =============================================
        // 6. KEMBALIKAN HASIL KE HALAMAN DETECT
        // =============================================

        return back()->with([

            'success' => true,

            'label' => $result['label'],

            'confidence' => $result['confidence'],

            'heatmap_image' => $heatmapFilename,

            'cropped_image' => $croppedFilename,

        ]);
    }


    /**
     * HISTORY
     * Menampilkan riwayat deteksi milik pengguna.
     */
    public function history(Request $request)
    {
        $search = $request->input('search');

        $query = Prediction::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(
                'filename',
                'like',
                '%' . $search . '%'
            );
        }

        $predictions = $query->get();

        return view('history', compact(
            'predictions',
            'search'
        ));
    }


    /**
     * SHOW
     * Menampilkan detail hasil identifikasi.
     */
    public function show($id)
    {
        $prediction = Prediction::findOrFail($id);

        return view('show', compact('prediction'));
    }


    /**
     * TRENDING
     * Mengelompokkan gambar berdasarkan perceptual hash.
     * Prioritaskan gambar crop untuk preview.
     */
    public function trending()
    {
        // Ambil kelompok gambar berdasarkan image_hash.
        $trendGroups = Prediction::selectRaw('
                image_hash,
                COUNT(*) as total_count
            ')
            ->whereNotNull('image_hash')
            ->groupBy('image_hash')
            ->having('total_count', '>=', 3)
            ->orderByDesc('total_count')
            ->limit(9)
            ->get();


        // Jika belum ada data trending.
        if ($trendGroups->isEmpty()) {

            return view('trending', [
                'trendings' => collect(),
            ]);

        }


        // Ambil seluruh record dari kelompok hash tersebut.
        $hashes = $trendGroups->pluck('image_hash');

        $records = Prediction::whereIn('image_hash', $hashes)
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('image_hash');


        // Tentukan gambar yang digunakan sebagai preview.
        $trendings = $trendGroups->map(function ($group) use ($records) {

            $groupRecords = $records->get(
                $group->image_hash,
                collect()
            );

            // Prioritaskan record yang memiliki hasil crop.
            $sample = $groupRecords->first(function ($record) {

                return !empty($record->cropped_file);

            });

            // Fallback ke gambar asli jika belum ada crop.
            if (!$sample) {
                $sample = $groupRecords->first();
            }

            return (object) [

                'image_hash' => $group->image_hash,

                'total_count' => $group->total_count,

                'sample_file' => $sample?->filename,

                'sample_crop_file' => $sample?->cropped_file,

                'label' => $sample?->label,

            ];

        });

        return view('trending', compact('trendings'));
    }
}