<?php

namespace App\Filament\Widgets;

use App\Models\Staf;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;

class StafTerbaru extends BaseWidget
{
    protected static ?string $heading = 'Staf & Guru';
    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Staf::latest()->limit(6)
            )
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->limit(30),

                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->sortable(),

                Tables\Columns\TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->badge()
                    ->color('primary'),
            ])
            ->emptyStateHeading('Tidak ada data Staf & Guru');
    }
}
