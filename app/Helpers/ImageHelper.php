<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Menghapus gambar dari field gambar utama dan rich editor.
     *
     * @param  mixed  $record  Instance model (Berita, Pengumuman, dst)
     * @param  string  $imageField  Nama kolom untuk gambar utama
     * @param  string|null  $richTextField  Nama kolom rich text (jika ada gambar di dalamnya)
     */
    public static function deleteImagesFromRecord($record, string $imageField = 'gambar', string $richTextField = null, string $subFolder = '')
    {
        // Hapus gambar utama
        if ($record->$imageField && Storage::disk('public')->exists($record->$imageField)) {
            Storage::disk('public')->delete($record->$imageField);
        }

        // Hapus gambar dari rich editor jika ada
        if ($richTextField && $record->$richTextField) {
            $pattern = '/<img[^>]+src="[^"]*\/storage\/' . preg_quote($subFolder, '/') . '\/([^"]+)"/';
            if (preg_match_all($pattern, $record->$richTextField, $matches)) {
                foreach ($matches[1] as $fileName) {
                    $fullPath = $subFolder . '/' . $fileName;
                    if (Storage::disk('public')->exists($fullPath)) {
                        Storage::disk('public')->delete($fullPath);
                    }
                }
            }
        }
    }

    public static function deleteLivewireTmpFiles()
    {
        $files = Storage::disk('public')->files('livewire-tmp');

        foreach ($files as $file) {
            if (Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }
    }

}
