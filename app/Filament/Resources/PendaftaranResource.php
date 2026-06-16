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
use Illuminate\Support\Facades\Auth;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Manajemen Kursus';

    // Mengubah property static menjadi fungsi dinamis untuk multibahasa
    public static function getNavigationLabel(): string
    {
        return __('Pendaftaran');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Pendaftaran');
    }

    public static function getModelLabel(): string
    {
        return __('Pendaftaran');
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->hasAnyRole(['Admin', 'Instruktur', 'Mahasiswa']);
    }

    public static function canCreate(): bool
    {
        return Auth::user()->hasRole('Admin');
    }

    public static function canEdit($record): bool
    {
        return Auth::user()->hasRole('Admin');
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->hasRole('Admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_daftar')->required()->label('ID Pendaftaran'),

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
                TextColumn::make('mahasiswa.nama')->label('Nama Mahasiswa')->searchable(),
                TextColumn::make('jadwalKursus.hari')->label('Jadwal'),
                TextColumn::make('tgl_daftar')->date()->label('Tgl Daftar'),
                TextColumn::make('status_bayar')->badge(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => Auth::user()->hasRole('Admin')),
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
            'index'  => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'edit'   => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}