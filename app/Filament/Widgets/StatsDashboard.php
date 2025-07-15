<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends BaseWidget
{
    protected ?string $heading = 'Ringkasan Aktivitas Sekolah';
    protected ?string $description = 'Monitoring real-time untuk berita terbaru, pengumuman sekolah, dan pencapaian prestasi siswa.';
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $countBerita = Berita::count();
        $countPengumuman = Pengumuman::count();
        $countPrestasi = Prestasi::count();
        return [
            Stat::make('Jumlah Berita','Total ' . $countBerita)
                ->description('Jumlah Berita yang dibuat')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('info'),
            Stat::make('Jumlah Pengumuman','Total ' . $countPengumuman)
                ->description('Jumlah Pengumuman yang dibuat')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('info'),
            Stat::make('Jumlah Prestasi','Total ' . $countPrestasi)
                ->description('Jumlah Prestasi yang dicapai')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('success'),
        ];
    }
}
