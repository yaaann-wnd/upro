<?php

namespace App\Filament\Resources\PembuatResource\Pages;

use App\Filament\Resources\PembuatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPembuats extends ListRecords
{
    protected static string $resource = PembuatResource::class;
    protected static ?string $title = 'Daftar Pembuat';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Pembuat'),
        ];
    }
}
