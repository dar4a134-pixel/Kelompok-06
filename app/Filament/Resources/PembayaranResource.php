<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $pluralModelLabel = 'Pembayaran';
    protected static ?string $modelLabel = 'Pembayaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_bayar')->required()->label('ID Pembayaran'),
                TextInput::make('id_daftar')->required()->label('ID Pendaftaran'),
                DatePicker::make('tgl_bayar')->required()->label('Tanggal Bayar'),
                TextInput::make('jumlah_bayar')->numeric()->required()->label('Jumlah Bayar'),
                Select::make('metode_bayar')
                    ->options([
                        'Transfer' => 'Transfer',
                        'Kasir' => 'Kasir',
                    ])->required()->label('Metode Bayar'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_bayar')->sortable()->label('ID Bayar'),
                TextColumn::make('id_daftar')->label('ID Daftar'),
                TextColumn::make('tgl_bayar')->date()->label('Tgl Bayar'),
                TextColumn::make('jumlah_bayar')->money('IDR')->label('Jumlah'),
                TextColumn::make('metode_bayar')->label('Metode'),
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
            'index'  => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit'   => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}