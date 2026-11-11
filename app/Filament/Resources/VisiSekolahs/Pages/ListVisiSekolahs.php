<?php

namespace App\Filament\Resources\VisiSekolahs\Pages;

use App\Filament\Resources\VisiSekolahs\VisiSekolahResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVisiSekolahs extends ListRecords
{
    protected static string $resource = VisiSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
