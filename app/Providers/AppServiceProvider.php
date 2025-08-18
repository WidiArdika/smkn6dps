<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\KontakHeader;
use App\Models\Kontak;
use App\Models\Jurusan;
use App\Models\ProfileInfo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.header', function ($view) {
            $view->with('kontak_headers', KontakHeader::all());
        });
        
        View::composer('components.footer', function ($view) {
            $view->with('profile_info', ProfileInfo::first());
        });

        View::composer('components.footer', function ($view) {
            $view->with('kontak', Kontak::first());
        });
        
        // Set locale Indonesia
        Carbon::setLocale('id');

        View::composer('components.header', function ($view) {
            $view->with('jurusans', Jurusan::orderBy('id', 'asc')->get());
        });

        // Share tanggal dengan timezone Bali (WITA)
        $waktu_bali = Carbon::now('Asia/Makassar'); // Timezone Bali/WITA
        View::share('tanggal_header', $waktu_bali->translatedFormat('l, d F Y'));
        View::share('tahun_copyright', $waktu_bali->translatedFormat('Y'));
        View::share('waktu_header', $waktu_bali->format('H:i') . ' WITA');
    }
}
