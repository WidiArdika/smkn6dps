<?php

namespace App\Filament\Resources\KontakHeaderResource\Pages;

use App\Filament\Resources\KontakHeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKontakHeaders extends ListRecords
{
    protected static string $resource = KontakHeaderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Kontak Header'),
        ];
    }
}
