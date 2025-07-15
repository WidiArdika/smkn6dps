<?php

namespace App\Filament\Resources\ImageCarouselResource\Pages;

use App\Filament\Resources\ImageCarouselResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImageCarousel extends EditRecord
{
    protected static string $resource = ImageCarouselResource::class;

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
