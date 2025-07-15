<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Osis extends Model
{
    use HasFactory;

    protected $table = 'osis'; // Nama tabel di database

    protected $fillable = [
        'periode',
        'anggota',
    ];

    /**
     * Casting kolom JSON agar bisa digunakan sebagai array.
     */
    protected $casts = [
        'anggota' => 'array',
    ];
}
