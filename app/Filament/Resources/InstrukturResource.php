<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstrukturResource\Pages;
use App\Models\Instruktur;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Illuminate\Support\Facades\Auth;

class InstrukturResource extends Resource
{
    protected static ?string $model = Instruktur::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Data Master';

    // Mengubah property static menjadi fungsi dinamis untuk multibahasa
    public static function getNavigationLabel(): string
    {
        return __('Instruktur');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Instruktur');
    }

    public static function getModelLabel(): string
    {
        return __('Instruktur');
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
                TextInput::make('id_instruktur')->required()->label('ID Instruktur'),
                TextInput::make('nama_instruktur')->required()->label('Nama Instruktur'),
                TextInput::make('keahlian')->required()->label('Keahlian / Spesialisasi'),
                FileUpload::make('foto')
                    ->label('Foto Instruktur')
                    ->image()
                    ->directory('instruktur')
                    ->disk('public')
                    ->nullable(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detail Instruktur')
                    ->schema([
                        TextEntry::make('id_instruktur')->label('ID Instruktur'),
                        TextEntry::make('nama_instruktur')->label('Nama Instruktur'),
                        TextEntry::make('keahlian')->label('Keahlian / Spesialisasi'),
                        ImageEntry::make('foto')->label('Foto')->disk('public'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_instruktur')->sortable()->searchable()->label('ID Instruktur'),
                TextColumn::make('nama_instruktur')->searchable()->label('Nama Instruktur'),
                TextColumn::make('keahlian')->label('Keahlian'),
                ImageColumn::make('foto')->label('Foto')->disk('public'),
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
            'index' => Pages\ListInstrukturs::route('/'),
            'create' => Pages\CreateInstruktur::route('/create'),
            'view' => Pages\ViewInstruktur::route('/{record}'),
            'edit' => Pages\EditInstruktur::route('/{record}/edit'),
        ];
    }
}