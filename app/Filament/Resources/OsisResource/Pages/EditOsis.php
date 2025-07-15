<?php

namespace App\Filament\Resources\OsisResource\Pages;

use App\Filament\Resources\OsisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOsis extends EditRecord
{
    protected static string $resource = OsisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
