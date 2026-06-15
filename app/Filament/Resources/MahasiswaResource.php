<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Auth;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?string $navigationLabel = 'Mahasiswa';
    protected static ?string $pluralModelLabel = 'Mahasiswa';
    protected static ?string $modelLabel = 'Mahasiswa';

    public static function canViewAny(): bool
    {
        return Auth::user()->hasAnyRole(['Admin', 'Mahasiswa']);
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
                FileUpload::make('foto')
                    ->label('Foto Mahasiswa')
                    ->image()
                    ->directory('mahasiswa')
                    ->disk('public')
                    ->nullable(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Data Mahasiswa')
                    ->schema([
                        TextEntry::make('nim')->label('NIM'),
                        TextEntry::make('nama')->label('Nama Lengkap'),
                        TextEntry::make('jurusan')->label('Jurusan'),
                        TextEntry::make('email')->label('Email'),
                        ImageEntry::make('foto')->label('Foto')->disk('public'),
                    ])->columns(2),

                Section::make('QR Code Mahasiswa')
                    ->schema([
                        TextEntry::make('nim')
                            ->label('')
                            ->formatStateUsing(function ($state, $record) {
                                $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                                    ->size(250)
                                    ->errorCorrection('H')
                                    ->generate("NIM: {$record->nim} | Nama: {$record->nama} | Jurusan: {$record->jurusan} | Email: {$record->email}");

                                $base64Svg = base64_encode($qr);

                                return new \Illuminate\Support\HtmlString('
                                    <div style="text-align:center; padding: 1.5rem;">
                                        <div style="background:white; padding:20px; display:inline-block; border-radius:16px; border:2px solid #f59e0b; margin-bottom:16px;">
                                            <img src="data:image/svg+xml;base64,' . $base64Svg . '"
                                                    width="250"
                                                    height="250"
                                                    style="display:block;"
                                                    alt="QR Code ' . $record->nama . '">
                                        </div>
                                        <br>
                                        <p style="font-size:13px; color:#9ca3af; margin-bottom:16px;">
                                            Scan QR untuk melihat data <strong style="color:#f59e0b;">' . $record->nama . '</strong>
                                        </p>
                                        <a href="data:image/svg+xml;base64,' . $base64Svg . '"
                                            download="QR-' . $record->nim . '.svg"
                                            style="
                                                display: inline-flex;
                                                align-items: center;
                                                gap: 8px;
                                                background: #f59e0b;
                                                color: white;
                                                padding: 12px 24px;
                                                border-radius: 8px;
                                                text-decoration: none;
                                                font-weight: 700;
                                                font-size: 15px;
                                                cursor: pointer;
                                            ">
                                                ⬇ Download QR Code
                                        </a>
                                    </div>
                                ');
                            })
                            ->html(),
                    ]),
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
                ImageColumn::make('foto')->label('Foto')->disk('public'),
            ])
            ->filters([])
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'view' => Pages\ViewMahasiswa::route('/{record}'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}