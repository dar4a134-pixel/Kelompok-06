<?php

namespace App\Providers\Filament;
namespace App\Filament\Resources;

use App\Filament\Resources\BahasaResource\Pages;
use App\Models\Bahasa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class BahasaResource extends Resource
{
    protected static ?string $model = Bahasa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // ==========================================
    // ATURAN HAK AKSES (ROLE PERMISSION)
    // ==========================================
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
    // ==========================================

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_bahasa')
                    ->label('ID Bahasa')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('nama_bahasa')
                    ->label('Nama Bahasa')
                    ->required(),
                Forms\Components\Select::make('tingkat')
                    ->label('Tingkat')
                    ->options([
                        'Basic' => 'Basic',
                        'Intermediate' => 'Intermediate',
                        'Advanced' => 'Advanced',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_bahasa')->label('ID Bahasa')->sortable(),
                Tables\Columns\TextColumn::make('nama_bahasa')->label('Nama Bahasa')->searchable(),
                Tables\Columns\TextColumn::make('tingkat')->label('Tingkat'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBahasas::route('/'),
            'create' => Pages\CreateBahasa::route('/create'),
            'edit' => Pages\EditBahasa::route('/{record}/edit'),
        ];
    }
}