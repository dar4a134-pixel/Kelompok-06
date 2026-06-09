<?php

namespace App\Filament\Resources\JadwalKursusResource\Pages;

use App\Filament\Resources\JadwalKursusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJadwalKursus extends EditRecord
{
    protected static string $resource = JadwalKursusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
