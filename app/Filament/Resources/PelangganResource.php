<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelangganResource\Pages; // Mengubah import ke PelangganResource
use App\Models\Pelanggan; // Mengubah model dari Penjualan menjadi Pelanggan
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PelangganResource extends Resource // Mengubah nama kelas dari PenjualanResource menjadi PelangganResource
{
    protected static ?string $model = Pelanggan::class; // Mengubah model yang digunakan

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('stok_id') // Mengubah dari barang_id menjadi stok_id
                    ->relationship('stok', 'nama_barang') // Mengubah relasi dari barang menjadi stok
                    ->required(),
                Forms\Components\TextInput::make('jumlah_penjualan') // Tetap sama
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('tanggal_penjualan') // Tetap sama
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('stok.nama_barang') // Mengubah relasi dari barang menjadi stok
                    ->label('Nama Barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_penjualan') // Tetap sama
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_penjualan') // Tetap sama
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelanggans::route('/'), // Mengubah rute ke ListPelanggans
            'create' => Pages\CreatePelanggan::route('/create'), // Mengubah rute ke CreatePelanggan
            'edit' => Pages\EditPelanggan::route('/{record}/edit'), // Mengubah rute ke EditPelanggan
        ];
    }
}