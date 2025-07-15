<?php

namespace App\Filament\Resources\ProfilSekolahResource\Pages;

use App\Filament\Resources\ProfilSekolahResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfilSekolah extends CreateRecord
{
    protected static string $resource = ProfilSekolahResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
