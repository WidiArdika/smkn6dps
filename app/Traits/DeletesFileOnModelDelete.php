<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait DeletesFileOnModelDelete
{
    public static function bootDeletesFileOnModelDelete(): void
    {
        static::deleting(function ($model) {
            // Ambil nama kolom yang menyimpan nama file
            $fileColumn = $model->fileColumn ?? 'foto';

            // Ambil isi dari kolom itu (misal 'staf-foto/abc.jpg')
            $path = $model->{$fileColumn};

            // Hapus file jika ada
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        });
    }
}
