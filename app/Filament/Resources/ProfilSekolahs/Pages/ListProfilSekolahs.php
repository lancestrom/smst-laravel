<?php

namespace App\Filament\Resources\ProfilSekolahs\Pages;

use App\Filament\Resources\ProfilSekolahs\ProfilSekolahResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProfilSekolahs extends ListRecords
{
    protected static string $resource = ProfilSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
