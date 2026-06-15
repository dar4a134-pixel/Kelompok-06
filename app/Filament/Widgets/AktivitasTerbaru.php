<?php
namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AktivitasTerbaru extends Widget
{
    protected static string $view = 'filament.widgets.aktivitas-terbaru';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;
}