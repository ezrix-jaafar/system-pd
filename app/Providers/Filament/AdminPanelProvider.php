<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Chiiya\FilamentAccessControl\FilamentAccessControlPlugin;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('')
            ->plugin(FilamentAccessControlPlugin::make())
            ->colors([
                'primary' => Color::Blue,
            ])
            ->brandName('System PD')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->sidebarFullyCollapsibleOnDesktop()
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Assets Management')
                    ->icon('heroicon-o-computer-desktop')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Bills Management')
                    ->icon('heroicon-o-document-text')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Clients')
                    ->icon('heroicon-o-user')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Products')
                    ->icon('heroicon-o-shopping-cart')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Administration')
                    ->icon('heroicon-o-cog')
                    ->collapsed(),
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
            ->login()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->profile()
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

}
