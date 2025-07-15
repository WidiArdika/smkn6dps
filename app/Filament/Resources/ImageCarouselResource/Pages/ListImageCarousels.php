<?php

namespace App\Filament\Resources\ImageCarouselResource\Pages;

use App\Filament\Resources\ImageCarouselResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImageCarousels extends ListRecords
{
    protected static string $resource = ImageCarouselResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Image Carousel'),
        ];
    }
}
