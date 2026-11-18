<?php

namespace App\Filament\Resources\VisiJurusans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VisiJurusansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jurusan.nama')
                    ->label('Nama Jurusan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('visi')
                    ->label('Visi Jurusan')
                    ->limit(90)
                    ->wrap(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
