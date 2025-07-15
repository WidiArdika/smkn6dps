<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    protected $fillable = [
        'video_url',
        'visi_misi',
        'profil',
    ];

    protected static function booted(): void
    {
        static::deleting(function ($data) {
            if (self::count() <= 1) {
                \Filament\Notifications\Notification::make()
                    ->title('Gagal Menghapus')
                    ->body('Minimal harus ada satu data profil.')
                    ->danger()
                    ->persistent()
                    ->send();

                return false;
            }
        });
    }
}
