<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Notifications\Notification;

class KontakHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'icon'
    ];

    // Helper untuk mendapatkan component icon
    public function getIconComponentAttribute()
    {
        return 'heroicon-s-' . $this->icon;
    }

    // Scope untuk urutan berdasarkan terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Scope untuk urutan berdasarkan terlama  
    public function scopeOldest($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    public function canDelete(): bool
    {
        return \App\Models\KontakHeader::count() > 1;
    }

    protected static function booted(): void
    {
        static::creating(function ($kontakHeader) {
            if (self::count() >= 3) {
                throw new \Exception('Maksimal 3 konten icon diperbolehkan.');
            }
        });

        static::deleting(function ($kontakHeader) {
            if (self::count() <= 3) {
                Notification::make()
                    ->title('Tidak Bisa Menghapus')
                    ->body('Minimal harus ada 3 konten icon yang tersisa.')
                    ->danger()
                    ->persistent()
                    ->send();

                return false; // batalkan penghapusan
            }
        });
    }
}
