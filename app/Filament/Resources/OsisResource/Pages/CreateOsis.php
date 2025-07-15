<?php

namespace App\Filament\Resources\OsisResource\Pages;

use App\Filament\Resources\OsisResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOsis extends CreateRecord
{
    protected static string $resource = OsisResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
