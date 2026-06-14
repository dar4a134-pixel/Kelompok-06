<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Mahasiswa;
use App\Models\Instruktur;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Mahasiswa', Mahasiswa::count())
                ->description('Peserta kursus aktif')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('warning'),
            Stat::make('Total Instruktur', Instruktur::count())
                ->description('Instruktur aktif')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('warning'),
            Stat::make('Bahasa Tersedia', '8')
                ->description('Program kursus bahasa')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('warning'),
        ];
    }
}
