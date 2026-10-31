<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('predictions', function (Blueprint $table) {
            // Menambahkan kolom JSON untuk menyimpan persentase anatomi wajah
            $table->json('analysis_details')->nullable()->after('heatmap_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('predictions', function (Blueprint $table) {
            // Menghapus kolom jika migrasi di-rollback
            $table->dropColumn('analysis_details');
        });
    }
};