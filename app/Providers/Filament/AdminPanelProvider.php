<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use App\Filament\Pages\Auth\CustomRegister;
use App\Filament\Pages\Auth\CustomLogin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            // ->brandName('Admin Panel SIXSKA DPS')
            ->brandLogo(asset('images/logo-light.png'))
            ->brandLogoHeight('1.8rem')
            ->favicon(asset('images/SMKN6.svg'))
            ->login(CustomLogin::class) // ⬅️ custom login
            ->registration(CustomRegister::class) // ⬅️ custom regis
            ->profile()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
            ])
            // ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->resources([
                \App\Filament\Resources\UserResource::class,
                \App\Filament\Resources\ImageCarouselResource::class,
                \App\Filament\Resources\IconContentResource::class,
                \App\Filament\Resources\ProfileInfoResource::class,
                \App\Filament\Resources\ProfilSekolahResource::class,
                \App\Filament\Resources\StafResource::class,
                \App\Filament\Resources\KepalaSekolahResource::class,
                \App\Filament\Resources\FasilitasResource::class,
                \App\Filament\Resources\JurusanResource::class,
                \App\Filament\Resources\OsisResource::class,
                \App\Filament\Resources\EkstrakurikulerResource::class,
                \App\Filament\Resources\PrestasiResource::class,
                \App\Filament\Resources\BeritaResource::class,
                \App\Filament\Resources\PengumumanResource::class,
                \App\Filament\Resources\KontakResource::class,
                \App\Filament\Resources\KontakHeaderResource::class,
            ])
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->spa()
            ->darkMode(false);
    }
}
