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
    
    // --- DI SINI YANG DIGANTI ---
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Manajemen Kursus';
    protected static ?string $navigationLabel = 'Pendaftaran';
    protected static ?string $pluralModelLabel = 'Pendaftaran';
    protected static ?string $modelLabel = 'Pendaftaran';
    // ----------------------------

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_daftar')->required()->label('ID Pendaftaran'),
                
                // 1. NIM DIGANTI JADI DROPDOWN MAHASISWA
                Select::make('nim')
                    ->relationship('mahasiswa', 'nama') // Menampilkan NAMA, tapi yang disimpan tetap NIM
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('NIM Mahasiswa'),
                
                // 2. ID JADWAL DIGANTI JADI DROPDOWN HARI & JAM
                Select::make('id_jadwal')
                    ->relationship('jadwalKursus', 'hari') // Menampilkan HARI kursus
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->hari} - {$record->jam}") // Biar muncul contoh: "Senin - 14.00-16.00"
                    ->preload()
                    ->required()
                    ->label('Jadwal Kursus'),

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
                TextColumn::make('mahasiswa.nama')->label('Nama Mahasiswa')->searchable(), // Biar di tabel keliatan namanya, bukan angka NIM doang
                TextColumn::make('jadwalKursus.hari')->label('Jadwal'),
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