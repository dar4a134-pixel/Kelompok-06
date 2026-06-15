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
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Illuminate\Support\Facades\Auth;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Absen';
    protected static ?string $pluralModelLabel = 'Absen';
    protected static ?string $modelLabel = 'Absen';

    public static function canViewAny(): bool
    {
        return Auth::user()->hasAnyRole(['Admin', 'Instruktur', 'Mahasiswa']);
    }

    public static function canCreate(): bool
    {
        return Auth::user()->hasAnyRole(['Admin', 'Instruktur']);
    }

    public static function canEdit($record): bool
    {
        return Auth::user()->hasAnyRole(['Admin', 'Instruktur']);
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->hasRole('Admin');
    }

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
                    ->relationship('mahasiswa', 'nama')
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detail Absen')
                    ->schema([
                        TextEntry::make('id_absen')->label('ID Absen'),
                        TextEntry::make('status_hadir')->label('Status Kehadiran')->badge(),
                        TextEntry::make('tgl_pertemuan')->label('Tanggal Pertemuan')->date(),
                        TextEntry::make('mahasiswa.nama')->label('Nama Mahasiswa'),
                        TextEntry::make('jadwalKursus.hari')->label('Jadwal Kursus'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_absen')->sortable()->label('ID Absen'),
                TextColumn::make('status_hadir')->badge(),
                TextColumn::make('tgl_pertemuan')->date()->label('Tanggal'),
                TextColumn::make('mahasiswa.nama')->label('Nama Mahasiswa')->searchable(),
                TextColumn::make('jadwalKursus.hari')->label('Jadwal Kursus'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => Auth::user()->hasAnyRole(['Admin', 'Instruktur'])),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => Auth::user()->hasRole('Admin')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => Auth::user()->hasRole('Admin')),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbsensis::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
            'view' => Pages\ViewAbsensi::route('/{record}'),
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
        ];
    }
}