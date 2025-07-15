<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $fillable = [
        'alamat',
        'telepon',
        'email',
        'hari_kerja',
        'jam_kerja',
        'instagram',
        'facebook',
        'tiktok',
        'youtube',
        'google_maps_embed',
    ];
}
