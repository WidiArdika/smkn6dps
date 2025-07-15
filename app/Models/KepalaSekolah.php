<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DeletesFileOnModelDelete;

class KepalaSekolah extends Model
{
    use HasFactory, DeletesFileOnModelDelete;

    protected $table = 'kepala_sekolahs';

    protected $fillable = [
        'nama',
        'nip',
        'foto'
    ];

    // Kolom tempat nama file disimpan
    protected $fileColumn = 'foto';

    public function getFotoUrlAttribute()
    {
        return asset('storage/' . $this->foto);
    }

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
