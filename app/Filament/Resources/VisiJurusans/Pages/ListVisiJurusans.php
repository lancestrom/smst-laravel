<?php

namespace App\Filament\Resources\VisiJurusans\Pages;

use App\Filament\Resources\VisiJurusans\VisiJurusanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVisiJurusans extends ListRecords
{
    protected static string $resource = VisiJurusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
