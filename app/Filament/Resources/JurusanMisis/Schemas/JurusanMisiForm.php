<?php

namespace App\Filament\Resources\JurusanMisis\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JurusanMisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('jurusan_id')
                    ->label('Jurusan')
                    ->relationship('jurusan', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Textarea::make('misi')
                    ->label('Misi Jurusan')
                    ->required()
                    ->rows(6)
                    ->columnSpanFull(),
            ]);
    }
}
