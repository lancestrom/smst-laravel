<?php

namespace App\Filament\Resources\JurusanMisis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class JurusanMisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('UUID')
                    ->sortable(),
                TextColumn::make('jurusan.nama')
                    ->label('Nama Jurusan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('misi')
                    ->label('Misi Jurusan')
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
