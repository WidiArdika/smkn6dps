<?php

namespace App\Filament\Resources\KontakHeaderResource\Pages;

use App\Filament\Resources\KontakHeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKontakHeader extends CreateRecord
{
    protected static string $resource = KontakHeaderResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
