<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Firefly\FilamentBlog\Blog;
use Filament\View\PanelsRenderHook;
use App\Http\Middleware\RestrictBlogAccess;
use Illuminate\Support\Facades\Blade;
use Filament\Navigation\NavigationGroup;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                Blog::make()
            ])
            ->brandLogo(new \Illuminate\Support\HtmlString('
                <div class="flex items-center gap-2 max-h-10 overflow-visible">
                    <div class="flex items-center justify-center w-7 h-7 rounded-lg bg-gradient-to-br from-amber-500 to-amber-600 shadow-md shadow-amber-500/10">
                        <svg class="w-4 h-4 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 21l5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 016-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 01-3.827-5.802" />
                        </svg>
                    </div>
                    <span class="text-base font-black tracking-widest bg-gradient-to-r from-amber-500 to-yellow-400 bg-clip-text text-transparent drop-shadow-sm">SIMKM</span>
                </div>
            '))
            ->renderHook(
                PanelsRenderHook::TOPBAR_END,
                fn (): string => Blade::render('
                    <div class="hidden lg:flex items-center gap-4 mr-4">
                        <div class="flex items-center gap-1.5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-700/60 p-1 rounded-xl">
                            <a href="{{ route(\'lang.switch\', \'id\') }}" class="flex items-center justify-center w-6 h-6 rounded-lg text-sm transition-all {{ app()->getLocale() == \'id\' ? \'bg-white dark:bg-slate-700 shadow-sm opacity-100 scale-105\' : \'opacity-40 hover:opacity-100 hover:scale-105\' }}" title="Indonesia">🇮🇩</a>
                            <a href="{{ route(\'lang.switch\', \'en\') }}" class="flex items-center justify-center w-6 h-6 rounded-lg text-sm transition-all {{ app()->getLocale() == \'en\' ? \'bg-white dark:bg-slate-700 shadow-sm opacity-100 scale-105\' : \'opacity-40 hover:opacity-100 hover:scale-105\' }}" title="English">🇬🇧</a>
                            <a href="{{ route(\'lang.switch\', \'ja\') }}" class="flex items-center justify-center w-6 h-6 rounded-lg text-sm transition-all {{ app()->getLocale() == \'ja\' ? \'bg-white dark:bg-slate-700 shadow-sm opacity-100 scale-105\' : \'opacity-40 hover:opacity-100 hover:scale-105\' }}" title="Japanese">🇯🇵</a>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200/50 dark:border-slate-700/50 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-xs font-semibold text-slate-600 dark:text-slate-300">
                                {{ app()->getLocale() == \'id\' ? \'Selamat Datang\' : (app()->getLocale() == \'ja\' ? \'ようこそ\' : \'Welcome\') }}, 
                                <span class="text-amber-600 dark:text-amber-400 font-bold">{{ auth()->user()->name }}</span>
                            </span>
                        </div>
                    </div>
                ')
            )
            ->sidebarCollapsibleOnDesktop()
            ->colors([
                'primary' => Color::Amber,
                'gray' => Color::Slate,
            ])
            ->font('Inter')
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => '<link rel="stylesheet" href="/css/filament-custom.css">'
            )
            ->navigationGroups([
                NavigationGroup::make()->label(fn (): string => __('Data Master')),
                NavigationGroup::make()->label(fn (): string => __('Manajemen Kursus')),
                NavigationGroup::make()->label(fn (): string => __('Akademik')),
                NavigationGroup::make()->label(fn (): string => __('Keuangan')),
                NavigationGroup::make()->label(fn (): string => __('Blog')),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\PendaftaranChart::class,
                \App\Filament\Widgets\AktivitasTerbaru::class,
                \App\Filament\Widgets\AksesCepat::class,
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
                RestrictBlogAccess::class,
                \App\Http\Middleware\LocalizationMiddleware::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}