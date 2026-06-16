<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalKursusResource\Pages;
use App\Models\JadwalKursus;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class JadwalKursusResource extends Resource
{
    protected static ?string $model = JadwalKursus::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Manajemen Kursus';

    // Mengubah property static menjadi fungsi dinamis untuk multibahasa
    public static function getNavigationLabel(): string
    {
        return __('Jadwal Kursus');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Jadwal Kursus');
    }

    public static function getModelLabel(): string
    {
        return __('Jadwal Kursus');
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
                TextInput::make('id_jadwal')->required()->label('ID Jadwal'),
                TextInput::make('hari')->required(),
                TextInput::make('jam')->required()->placeholder('Contoh: 14:00 - 16:00'),
                TextInput::make('id_bahasa')->required()->label('ID Bahasa'),
                TextInput::make('id_instruktur')->required()->label('ID Instruktur'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_jadwal')->sortable()->label('ID Jadwal'),
                TextColumn::make('hari')->label('Hari'),
                TextColumn::make('jam')->label('Jam'),
                TextColumn::make('id_bahasa')->label('ID Bahasa'),
                TextColumn::make('id_instruktur')->label('ID Instruktur'),
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
            'index'  => Pages\ListJadwalKursuses::route('/'),
            'create' => Pages\CreateJadwalKursus::route('/create'),
            'edit'   => Pages\EditJadwalKursus::route('/{record}/edit'),
        ];
    }
}