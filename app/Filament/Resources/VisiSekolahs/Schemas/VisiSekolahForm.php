<?php

namespace App\Filament\Resources\VisiSekolahs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class VisiSekolahForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('isi')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
