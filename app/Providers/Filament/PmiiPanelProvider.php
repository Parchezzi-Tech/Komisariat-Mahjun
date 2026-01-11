<?php

namespace App\Providers\Filament;

use App\Http\Middleware\FilamentAuthenticateToAppLogin;
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

class PmiiPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('pmii')
            ->path('pmii')
            ->login()
            ->brandName('Portal PMII')
            ->favicon(asset('images/logo_mahbub.jpg'))
            ->brandLogo(asset('images/logo_mahbub.jpg'))
            ->brandLogoHeight('3rem')
            ->colors([
                'primary' => Color::Indigo,
                'danger' => Color::Rose,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->font('Inter')
            ->darkMode(false)
            ->sidebarCollapsibleOnDesktop()
            ->navigationGroups([
                'Portal PMII',
                'Administrasi',
                'Laporan',
            ])
            ->discoverResources(in: app_path('Filament/Pmii/Resources'), for: 'App\\Filament\\Pmii\\Resources')
            ->discoverPages(in: app_path('Filament/Pmii/Pages'), for: 'App\\Filament\\Pmii\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Pmii/Widgets'), for: 'App\\Filament\\Pmii\\Widgets')
            ->widgets([])
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
                FilamentAuthenticateToAppLogin::class,
            ]);
    }
}
