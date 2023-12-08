<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('nama_produk')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('deskripsi_produk')
                            ->required()
                            ->columnSpanFull()
                            ->autosize()
                            ->rows(5),
                        Forms\Components\FileUpload::make('gambar_produk')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('status_produk')
                            ->required()
                            ->hidden()
                            ->default('belum_terjual'),
                        Forms\Components\TextInput::make('harga_jual')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('biaya_pembuatan')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('keuntungan')
                            ->numeric()
                            ->hidden(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_produk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_produk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('harga_jual')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('biaya_pembuatan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('keuntungan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Produk'),
            ])
            ->emptyStateHeading('Belum ada produk')
            ->emptyStateDescription('Klik tombol di bawah untuk menambah produk');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
