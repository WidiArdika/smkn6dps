<?php

namespace App\Filament\Resources\IconContentResource\Pages;

use App\Filament\Resources\IconContentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIconContent extends CreateRecord
{
    protected static string $resource = IconContentResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
