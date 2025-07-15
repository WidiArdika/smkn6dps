<?php

namespace App\Filament\Widgets;

use App\Models\Prestasi;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;

class PrestasiTerbaru extends BaseWidget
{
    protected static ?string $heading = 'Prestasi Terbaru';
    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Prestasi::latest()->limit(6)
            )
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->limit(35),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date()
                    ->badge()
                    ->color('success')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->badge()
                    ->color('success')
                    ->since(),
            ])
            ->emptyStateHeading('Tidak ada data Prestasi');
    }
}
