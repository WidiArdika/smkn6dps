<?php

namespace App\Filament\Resources\OsisResource\Pages;

use App\Filament\Resources\OsisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOses extends ListRecords
{
    protected static string $resource = OsisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Struktur OSIS'),
        ];
    }
}
