<?php

namespace App\Filament\Resources\ProfileInfoResource\Pages;

use App\Filament\Resources\ProfileInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfileInfo extends CreateRecord
{
    protected static string $resource = ProfileInfoResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
