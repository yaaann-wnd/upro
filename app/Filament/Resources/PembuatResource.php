<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembuatResource\Pages;
use App\Filament\Resources\PembuatResource\RelationManagers;
use App\Models\Pembuat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembuatResource extends Resource
{
    protected static ?string $model = Pembuat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pembuat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('produk_id')
                    ->relationship('produk', 'id')
                    ->required(),
                Forms\Components\TextInput::make('keuntungan_didapat')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('biaya_dikeluarkan')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('produk.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('keuntungan_didapat')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('biaya_dikeluarkan')
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
                    ->label('Tambah Pembuat'),
            ])
            ->emptyStateHeading('Belum ada pembuat')
            ->emptyStateDescription('Klik tombol di bawah untuk menambah pembuat');
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
            'index' => Pages\ListPembuats::route('/'),
            'create' => Pages\CreatePembuat::route('/create'),
            'edit' => Pages\EditPembuat::route('/{record}/edit'),
        ];
    }
}
