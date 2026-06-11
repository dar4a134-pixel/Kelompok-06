<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbsensiResource\Pages;
use App\Models\Absensi;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_absen')->required()->label('ID Absen'),
                
                Select::make('status_hadir')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Sakit' => 'Sakit',
                        'Izin' => 'Izin',
                        'Alfa' => 'Alfa',
                    ])->required()->label('Status Kehadiran'),
                
                DatePicker::make('tgl_pertemuan')->required()->label('Tanggal Pertemuan'),
                
                Select::make('nim')
                    ->relationship('mahasiswa', 'nama') // Mengambil relasi nama dari model
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('NIM Mahasiswa'),

                Select::make('id_jadwal')
                    ->relationship('jadwalKursus', 'hari')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->hari} - {$record->jam}")
                    ->preload()
                    ->required()
                    ->label('ID Jadwal'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_absen')->sortable()->label('ID Absen'),
                TextColumn::make('status_hadir')->badge(),
                TextColumn::make('tgl_pertemuan')->date()->label('Tanggal'),
                
                // Mengubah tampilan tabel agar memunculkan Nama dan Jadwal asli, bukan kode angka
                TextColumn::make('mahasiswa.nama')->label('Nama Mahasiswa')->searchable(),
                TextColumn::make('jadwalKursus.hari')->label('Jadwal Kursus'),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbsensis::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
        ];
    }
}