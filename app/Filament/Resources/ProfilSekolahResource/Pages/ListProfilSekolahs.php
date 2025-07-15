<?php

namespace App\Filament\Resources\ProfilSekolahResource\Pages;

use App\Filament\Resources\ProfilSekolahResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use App\Models\ProfilSekolah;

class ListProfilSekolahs extends ListRecords
{
    protected static string $resource = ProfilSekolahResource::class;

    protected function getHeaderActions(): array
    {
        $latestRecord = ProfilSekolah::latest()->first();

        // Kalau belum ada data, tampilkan tombol create saja
        if (! $latestRecord) {
            return [
                Action::make('create')
                    ->label('Buat Profil')
                    ->url(ProfilSekolahResource::getUrl('create'))
                    ->color('primary'),
            ];
        }

        return [
            Action::make('edit')
                ->label('Edit Profil Sekolah')
                ->url(
                    fn () => ProfilSekolahResource::getUrl('edit', ['record' => $latestRecord])
                )
                ->color('primary'),
        ];
    }
}
