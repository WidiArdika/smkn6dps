<?php

namespace App\Filament\Resources\IconContentResource\Pages;

use App\Filament\Resources\IconContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIconContent extends EditRecord
{
    protected static string $resource = IconContentResource::class;

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
