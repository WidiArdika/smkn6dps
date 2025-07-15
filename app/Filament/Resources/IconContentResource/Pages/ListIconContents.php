<?php

namespace App\Filament\Resources\IconContentResource\Pages;

use App\Filament\Resources\IconContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIconContents extends ListRecords
{
    protected static string $resource = IconContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Konten Cards'),
        ];
    }
}
