<?php

namespace App\Filament\Resources\ProfileInfoResource\Pages;

use App\Filament\Resources\ProfileInfoResource;
use Filament\Actions;
use App\Models\ProfileInfo;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListProfileInfos extends ListRecords
{
    protected static string $resource = ProfileInfoResource::class;

    protected function getHeaderActions(): array
    {
        $latestRecord = ProfileInfo::latest()->first();
        // Kalau belum ada data, tampilkan tombol create saja
        if (! $latestRecord) {
            return [
                Action::make('create')
                    ->label('Buat Profil')
                    ->url(ProfileInfoResource::getUrl('create'))
                    ->color('primary'),
            ];
        }

        return [
            Action::make('edit')
                ->label('Edit Informasi Profil')
                ->url(
                    fn () => ProfileInfoResource::getUrl('edit', ['record' => $latestRecord])
                )
                ->color('primary'),
        ];
    }
}
