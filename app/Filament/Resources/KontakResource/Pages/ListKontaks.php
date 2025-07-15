<?php

namespace App\Filament\Resources\KontakResource\Pages;

use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\KontakResource;
use App\Models\Kontak;
use Filament\Actions\Action;

class ListKontaks extends ListRecords
{
    protected static string $resource = KontakResource::class;

    protected function getHeaderActions(): array
    {
        $latestRecord = Kontak::latest()->first();

        // Kalau belum ada data, tampilkan tombol create saja
        if (! $latestRecord) {
            return [
                Action::make('create')
                    ->label('Buat Informasi Kontak')
                    ->url(KontakResource::getUrl('create'))
                    ->color('primary'),
            ];
        }

        return [
            Action::make('edit')
                ->label('Edit Informasi Kontak')
                ->url(
                    fn () => KontakResource::getUrl('edit', ['record' => $latestRecord])
                )
                ->color('primary'),
        ];
    }
}
