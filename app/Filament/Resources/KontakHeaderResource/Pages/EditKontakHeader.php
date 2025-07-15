<?php

namespace App\Filament\Resources\KontakHeaderResource\Pages;

use App\Filament\Resources\KontakHeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKontakHeader extends EditRecord
{
    protected static string $resource = KontakHeaderResource::class;

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
