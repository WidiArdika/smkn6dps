<?php

namespace App\Filament\Widgets;

use App\Models\Ekstrakurikuler;
use App\Models\Jurusan;
use App\Models\Staf;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard2 extends BaseWidget
{
    protected ?string $heading = 'Ringkasan Data Sekolah';
    protected ?string $description = 'Informasi lengkap mengenai jumlah jurusan, kegiatan ekstrakurikuler, dan tenaga pendidik di sekolah.';
    protected static ?int $sort = 2;
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Jurusan','Total ' . Jurusan::count())
                ->description('Jumlah Jurusan yang dimiliki')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('primary'),
            Stat::make('Jumlah Ekstrakurikuler','Total ' . Ekstrakurikuler::count())
                ->description('Jumlah Ekstrakurikuler yang dimiliki')
                ->descriptionIcon('heroicon-m-puzzle-piece')
                ->color('primary'),
            Stat::make('Jumlah Staf & Guru','Total ' . Staf::count())
                ->description('Jumlah Staf & Guru yang dimiliki')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}
