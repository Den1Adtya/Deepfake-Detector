<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional, tapi bagus untuk kepastian)
    protected $table = 'predictions';

    // Kolom yang diizinkan untuk diisi secara otomatis
    protected $fillable = [
        'filename',
        'label',
        'confidence',
    ];
}