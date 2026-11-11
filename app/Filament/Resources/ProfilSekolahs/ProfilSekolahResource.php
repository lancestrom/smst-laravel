<?php

namespace App\Filament\Resources\ProfilSekolahs;

use App\Filament\Resources\ProfilSekolahs\Pages\CreateProfilSekolah;
use App\Filament\Resources\ProfilSekolahs\Pages\EditProfilSekolah;
use App\Filament\Resources\ProfilSekolahs\Pages\ListProfilSekolahs;
use App\Filament\Resources\ProfilSekolahs\Schemas\ProfilSekolahForm;
use App\Filament\Resources\ProfilSekolahs\Tables\ProfilSekolahsTable;
use App\Models\ProfilSekolah;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProfilSekolahResource extends Resource
{
    protected static ?string $model = ProfilSekolah::class;

    protected static ?string $navigationLabel = 'Profil Sekolah';

    protected static ?string $modelLabel = 'Profil Sekolah';

    protected static ?string $pluralModelLabel = 'Profil Sekolah';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Website';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ProfilSekolahForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfilSekolahsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProfilSekolahs::route('/'),
            'create' => CreateProfilSekolah::route('/create'),
            'edit' => EditProfilSekolah::route('/{record}/edit'),
        ];
    }
}
