<?php

namespace App\Filament\Resources\VisiJurusans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class VisiJurusanForm
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
                    ->required()
                    ->unique(
                        table: 'jurusan_visis',
                        column: 'jurusan_id',
                        ignoreRecord: true
                    ),
                Textarea::make('visi')
                    ->label('Visi Jurusan')
                    ->required()
                    ->rows(6)
                    ->columnSpanFull(),
            ]);
    }
}
