<?php

namespace App\Filament\Resources\ProfilSekolahs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ImportAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Imports\ProfilSekolahImporter;

class ProfilSekolahsTable
{
    public static function configure(Table $table): Table
    {

        return $table

            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo Sekolah')
                    ->rounded()
                    ->square()
                    ->size(50),
                TextColumn::make('id')
                    ->label('UUID')
                    ->sortable(),
                TextColumn::make('nama_sekolah')
                    ->label('Nama Sekolah')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('npsn')
                    ->label('NPSN')
                    ->searchable(),

                TextColumn::make('nama_kepala_sekolah')
                    ->label('Kepala Sekolah')
                    ->searchable(),
            ])
            ->filters([
                //
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
