<?php

namespace App\Filament\Resources\PembuatResource\Pages;

use App\Filament\Resources\PembuatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPembuat extends EditRecord
{
    protected static string $resource = PembuatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
