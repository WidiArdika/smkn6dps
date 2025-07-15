<?php

namespace App\Filament\Widgets;

use App\Models\Pengumuman;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;

class PengumumanTerbaru extends BaseWidget
{
    protected static ?string $heading = 'Pengumuman Terbaru';
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Pengumuman::latest()->limit(6)
            )
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->limit(30),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date()
                    ->badge()
                    ->color('info')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->badge()
                    ->color('info')
                    ->since(),
            ])
            ->emptyStateHeading('Tidak ada data Pengumuman');
    }
}
