<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileInfo extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'youtube_url',
    ];

    protected static function booted(): void
    {
        static::deleting(function ($profile) {
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

    public function isYoutubeValid(): bool
    {
        return $this->youtube_url && str_contains($this->youtube_url, 'youtube.com/embed/');
    }
}
