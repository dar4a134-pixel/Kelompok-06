<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranResource\Pages;
use App\Models\Pendaftaran;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_daftar')->required()->label('ID Pendaftaran'),
                TextInput::make('nim')->required()->label('NIM Mahasiswa'),
                TextInput::make('id_jadwal')->required()->label('ID Jadwal'),
                DatePicker::make('tgl_daftar')->required()->label('Tanggal Daftar'),
                Select::make('status_bayar')
                    ->options([
                        'Lunas' => 'Lunas',
                        'Belum Lunas' => 'Belum Lunas',
                    ])->required()->label('Status Bayar'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_daftar')->sortable()->searchable()->label('ID Daftar'),
                TextColumn::make('nim')->label('NIM'),
                TextColumn::make('id_jadwal')->label('ID Jadwal'),
                TextColumn::make('tgl_daftar')->date()->label('Tgl Daftar'),
                TextColumn::make('status_bayar')->badge(),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}