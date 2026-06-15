<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NilaiAkhirResource\Pages;
use App\Models\NilaiAkhir;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class NilaiAkhirResource extends Resource
{
    protected static ?string $model = NilaiAkhir::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $navigationLabel = 'Nilai Akhir';
    protected static ?string $pluralModelLabel = 'Nilai Akhir';
    protected static ?string $modelLabel = 'Nilai Akhir';

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
        return Auth::user()->hasAnyRole(['Admin', 'Instruktur']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_nilai')->required()->label('ID Nilai'),
                TextInput::make('id_daftar')->required()->label('ID Pendaftaran'),
                TextInput::make('nilai_angka')->numeric()->required()->label('Nilai Angka'),
                TextInput::make('nilai_huruf')->required()->label('Nilai Huruf'),
                Select::make('status_lulus')
                    ->options([
                        'Lulus' => 'Lulus',
                        'Tidak Lulus' => 'Tidak Lulus',
                    ])->required()->label('Status Kelulusan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_nilai')->sortable()->label('ID Nilai'),
                TextColumn::make('id_daftar')->label('ID Daftar'),
                TextColumn::make('nilai_angka')->label('Angka'),
                TextColumn::make('nilai_huruf')->label('Huruf'),
                TextColumn::make('status_lulus')->badge(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => Auth::user()->hasAnyRole(['Admin', 'Instruktur'])),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => Auth::user()->hasAnyRole(['Admin', 'Instruktur'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => Auth::user()->hasAnyRole(['Admin', 'Instruktur'])),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListNilaiAkhirs::route('/'),
            'create' => Pages\CreateNilaiAkhir::route('/create'),
            'edit'   => Pages\EditNilaiAkhir::route('/{record}/edit'),
        ];
    }
}