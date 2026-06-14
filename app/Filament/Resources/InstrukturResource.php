<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstrukturResource\Pages;
use App\Models\Instruktur;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;

class InstrukturResource extends Resource
{
    protected static ?string $model = Instruktur::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?string $navigationLabel = 'Instruktur';
    protected static ?string $pluralModelLabel = 'Instruktur';
    protected static ?string $modelLabel = 'Instruktur';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_instruktur')->required()->label('ID Instruktur'),
                TextInput::make('nama_instruktur')->required()->label('Nama Instruktur'),
                TextInput::make('keahlian')->required()->label('Keahlian / Spesialisasi'),
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
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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