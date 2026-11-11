<?php

namespace App\Filament\Resources\ProfilSekolahs\Pages;

use App\Filament\Resources\ProfilSekolahs\ProfilSekolahResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfilSekolah extends EditRecord
{
    protected static string $resource = ProfilSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
