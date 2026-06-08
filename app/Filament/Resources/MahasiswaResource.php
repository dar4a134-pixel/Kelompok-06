<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // ==========================================
    // ATURAN HAK AKSES (ROLE PERMISSION)
    // ==========================================
    
    // Hanya Admin yang bisa pencet tombol "New / Create"
    public static function canCreate(): bool
    {
        return Auth::user()->hasRole('Admin');
    }

    // Hanya Admin yang bisa mengedit data
    public static function canEdit($record): bool
    {
        return Auth::user()->hasRole('Admin');
    }

    // Hanya Admin yang bisa menghapus data
    public static function canDelete($record): bool
    {
        return Auth::user()->hasRole('Admin');
    }

    // ==========================================

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nim')
                    ->label('NIM')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->required(),
                Forms\Components\TextInput::make('jurusan')
                    ->label('Jurusan')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nim')->label('NIM')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('jurusan')->label('Jurusan'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Filament otomatis menyembunyikan tombol Edit & Delete jika canEdit/canDelete bernilai false
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
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}