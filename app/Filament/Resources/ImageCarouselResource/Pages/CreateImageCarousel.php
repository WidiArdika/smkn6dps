<?php

namespace App\Filament\Resources\ImageCarouselResource\Pages;

use App\Filament\Resources\ImageCarouselResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateImageCarousel extends CreateRecord
{
    protected static string $resource = ImageCarouselResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
