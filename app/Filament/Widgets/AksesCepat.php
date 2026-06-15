<?php
namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AksesCepat extends Widget
{
    protected static string $view = 'filament.widgets.akses-cepat';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 1;
}