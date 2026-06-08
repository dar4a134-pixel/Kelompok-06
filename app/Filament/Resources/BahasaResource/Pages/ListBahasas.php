<?php

namespace App\Filament\Resources\BahasaResource\Pages;

use App\Filament\Resources\BahasaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBahasas extends ListRecords
{
    protected static string $resource = BahasaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
