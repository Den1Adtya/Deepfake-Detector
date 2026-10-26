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
    Schema::create('predictions', function (Blueprint $table) {
        $table->id();
        $table->string('filename'); // Menyimpan nama gambar
        $table->string('label'); // Menyimpan hasil REAL atau FAKE
        $table->decimal('confidence', 5, 2); // Menyimpan persentase (misal 98.50)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
