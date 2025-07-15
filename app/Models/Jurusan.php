<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\DeletesFileOnModelDelete;

class Jurusan extends Model
{
    use HasFactory, DeletesFileOnModelDelete;

    protected $fillable = [
        'nama',
        'gambar',
        'deskripsi',
    ];
    // Kolom tempat nama file disimpan
    protected $fileColumn = 'gambar';

    // Accessor untuk mendapatkan URL gambar lengkap
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->gambar);
    }

    protected static function booted()
    {
        static::creating(function ($jurusan) {
            $jurusan->slug = Str::slug($jurusan->nama);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
