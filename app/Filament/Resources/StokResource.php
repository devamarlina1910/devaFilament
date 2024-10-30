<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StokResource\Pages;
use App\Models\Stok;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StokResource extends Resource
{
    protected static ?string $model = Stok::class;

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
                Forms\Components\Select::make('pelanggan')
                    ->options([
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
                Tables\Columns\TextColumn::make('nama_barang')->searchable(),
                Tables\Columns\TextColumn::make('stok')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('pelanggan'),
                Tables\Columns\IconColumn::make('tersedia')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Menambahkan aksi delete
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(), // Aksi bulk delete
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStoks::route('/'),
            'create' => Pages\CreateStok::route('/create'),
            'edit' => Pages\EditStok::route('/{record}/edit'),
        ];
    }
}