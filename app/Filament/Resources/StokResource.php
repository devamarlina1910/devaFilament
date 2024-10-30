<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StokResource\Pages; // Mengubah import ke StokResource
use App\Models\Stok; // Mengubah model dari Barang menjadi Stok
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StokResource extends Resource // Mengubah nama kelas dari BarangResource menjadi StokResource
{
    protected static ?string $model = Stok::class; // Mengubah model yang digunakan

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_barang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('stok')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('pelanggan') // Mengganti kategori menjadi pelanggan
                    ->options([ // Memperbarui opsi sesuai dengan pelanggan
                        'makanan' => 'Makanan',
                        'minuman' => 'Minuman',
                        'kebutuhan_rumah_tangga' => 'Kebutuhan Rumah Tangga',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_masuk')
                    ->required(),
                Forms\Components\Toggle::make('tersedia')
                    ->label('Tersedia')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stok')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pelanggan'), // Mengubah kategori menjadi pelanggan
                Tables\Columns\IconColumn::make('tersedia')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
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
            'index' => Pages\ListStoks::route('/'), // Mengubah rute ke ListStoks
            'create' => Pages\CreateStok::route('/create'), // Mengubah rute ke CreateStok
            'edit' => Pages\EditStok::route('/{record}/edit'), // Mengubah rute ke EditStok
        ];
    }
}