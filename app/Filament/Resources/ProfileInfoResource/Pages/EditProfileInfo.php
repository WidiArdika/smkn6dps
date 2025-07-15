<?php

namespace App\Filament\Resources\ProfileInfoResource\Pages;

use App\Filament\Resources\ProfileInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfileInfo extends EditRecord
{
    protected static string $resource = ProfileInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
