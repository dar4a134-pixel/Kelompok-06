<?php
namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class PendaftaranChart extends ChartWidget
{
    protected static ?string $heading = 'Pendaftaran per Bulan';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Pendaftaran',
                    'data' => [10, 25, 18, 40, 30, 55, 45, 60, 35, 70, 50, 82],
                    'backgroundColor' => '#f59e0b',
                    'borderColor' => '#f59e0b',
                    'borderRadius' => 6,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 
                         'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}