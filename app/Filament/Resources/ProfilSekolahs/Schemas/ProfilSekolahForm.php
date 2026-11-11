<?php

namespace App\Filament\Resources\ProfilSekolahs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfilSekolahForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_sekolah')
                    ->label('Nama Sekolah')
                    ->required(),
                TextInput::make('npsn')
                    ->label('NPSN')
                    ->maxLength(20),
                Textarea::make('alamat')
                    ->label('Alamat'),
                TextInput::make('telepon')
                    ->label('Telepon')
                    ->maxLength(20),
                TextInput::make('email')
                    ->label('Email'),
                TextInput::make('nama_kepala_sekolah')
                    ->label('Nama Kepala Sekolah'),
                Textarea::make('deskripsi')
                    ->label('Deskripsi'),
                FileUpload::make('logo')
                    ->label('Logo Sekolah'),
            ]);
    }
}
