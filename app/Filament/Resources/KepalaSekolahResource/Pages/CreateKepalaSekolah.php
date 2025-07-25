<?php

namespace App\Filament\Resources\KepalaSekolahResource\Pages;

use App\Filament\Resources\KepalaSekolahResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKepalaSekolah extends CreateRecord
{
    protected static string $resource = KepalaSekolahResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
