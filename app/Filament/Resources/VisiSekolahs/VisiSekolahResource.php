<?php

namespace App\Filament\Resources\VisiSekolahs;

use App\Filament\Resources\VisiSekolahs\Pages\CreateVisiSekolah;
use App\Filament\Resources\VisiSekolahs\Pages\EditVisiSekolah;
use App\Filament\Resources\VisiSekolahs\Pages\ListVisiSekolahs;
use App\Filament\Resources\VisiSekolahs\Schemas\VisiSekolahForm;
use App\Filament\Resources\VisiSekolahs\Tables\VisiSekolahsTable;
use App\Models\VisiSekolah;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class VisiSekolahResource extends Resource
{
    protected static ?string $model = VisiSekolah::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Visi Sekolah';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Website';

    protected static ?string $modelLabel = 'Visi Sekolah';

    protected static ?string $pluralModelLabel = 'Visi Sekolah';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return VisiSekolahForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VisiSekolahsTable::configure($table);
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
            'index' => ListVisiSekolahs::route('/'),
            'create' => CreateVisiSekolah::route('/create'),
            'edit' => EditVisiSekolah::route('/{record}/edit'),
        ];
    }
}
