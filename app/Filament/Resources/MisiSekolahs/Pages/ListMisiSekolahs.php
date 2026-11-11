<?php

namespace App\Filament\Resources\MisiSekolahs\Pages;

use App\Filament\Resources\MisiSekolahs\MisiSekolahResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMisiSekolahs extends ListRecords
{
    protected static string $resource = MisiSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
