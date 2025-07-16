<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait SyncsUploadedFileToPublic
{
    public static function syncToPublicStorage(string $folder, string $filename): void
    {
        $source = storage_path("app/public/{$folder}/{$filename}");
        $target = public_path("storage/{$folder}/{$filename}");

        if (file_exists($source)) {
            File::ensureDirectoryExists(dirname($target));
            copy($source, $target);
        }
    }
}
