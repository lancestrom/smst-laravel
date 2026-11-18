<?php

namespace App\Filament\Resources\VisiJurusans\Pages;

use App\Filament\Resources\VisiJurusans\VisiJurusanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditVisiJurusan extends EditRecord
{
    protected static string $resource = VisiJurusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
