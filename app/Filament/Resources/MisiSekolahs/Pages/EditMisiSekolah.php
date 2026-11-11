<?php

namespace App\Filament\Resources\MisiSekolahs\Pages;

use App\Filament\Resources\MisiSekolahs\MisiSekolahResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMisiSekolah extends EditRecord
{
    protected static string $resource = MisiSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
