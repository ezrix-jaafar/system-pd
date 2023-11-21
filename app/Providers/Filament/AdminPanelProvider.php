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

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('')
            ->colors([
                'primary' => Color::Blue,
                'yellow' => Color::Yellow,
                'green' => Color::Green,
                'red' => Color::Red,
                'blue' => Color::Blue,
                'indigo' => Color::Indigo,
                'purple' => Color::Purple,
                'pink' => Color::Pink,
                'orange' => Color::Orange,
                'amber' => Color::Amber,
                'emerald' => Color::Emerald,
                'teal' => Color::Teal
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
                    ->label('Projects Management')
                    ->icon('heroicon-o-briefcase')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Hosting & Domain')
                    ->icon('heroicon-o-server-stack')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Clients Management')
                    ->icon('heroicon-o-user')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Staff Management')
                    ->icon('heroicon-o-users')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Products Management')
                    ->icon('heroicon-o-shopping-cart')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Marketing')
                    ->icon('heroicon-o-presentation-chart-line')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Training Management')
                    ->icon('heroicon-o-clipboard-document-list')
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
