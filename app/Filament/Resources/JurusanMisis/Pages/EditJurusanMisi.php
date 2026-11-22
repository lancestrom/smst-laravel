<?php

namespace App\Filament\Resources\JurusanMisis\Pages;

use App\Filament\Resources\JurusanMisis\JurusanMisiResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditJurusanMisi extends EditRecord
{
    protected static string $resource = JurusanMisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
