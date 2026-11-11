<?php

namespace App\Filament\Resources\VisiSekolahs\Pages;

use App\Filament\Resources\VisiSekolahs\VisiSekolahResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVisiSekolah extends EditRecord
{
    protected static string $resource = VisiSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
