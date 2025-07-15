<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DeletesFileOnModelDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageCarousel extends Model
{
    use HasFactory, DeletesFileOnModelDelete;

    protected $fillable = [
        'title',
        'image_path',
    ];
    // Kolom tempat nama file disimpan
    protected $fileColumn = 'image_path';

    // Accessor untuk mendapatkan URL gambar lengkap
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}
