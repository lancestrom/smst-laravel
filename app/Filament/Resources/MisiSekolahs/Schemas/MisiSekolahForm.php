<?php

namespace App\Filament\Resources\MisiSekolahs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MisiSekolahForm
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
