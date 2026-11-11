<?php

namespace App\Filament\Resources\MisiSekolahs;

use App\Filament\Resources\MisiSekolahs\Pages\CreateMisiSekolah;
use App\Filament\Resources\MisiSekolahs\Pages\EditMisiSekolah;
use App\Filament\Resources\MisiSekolahs\Pages\ListMisiSekolahs;
use App\Filament\Resources\MisiSekolahs\Schemas\MisiSekolahForm;
use App\Filament\Resources\MisiSekolahs\Tables\MisiSekolahsTable;
use App\Models\MisiSekolah;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MisiSekolahResource extends Resource
{
    protected static ?string $model = MisiSekolah::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Misi Sekolah';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Website';

    protected static ?string $modelLabel = 'Misi Sekolah';

    protected static ?string $pluralModelLabel = 'Misi Sekolah';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return MisiSekolahForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MisiSekolahsTable::configure($table);
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
            'index' => ListMisiSekolahs::route('/'),
            'create' => CreateMisiSekolah::route('/create'),
            'edit' => EditMisiSekolah::route('/{record}/edit'),
        ];
    }
}
