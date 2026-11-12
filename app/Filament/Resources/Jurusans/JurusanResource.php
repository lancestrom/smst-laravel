<?php

namespace App\Filament\Resources\Jurusans;

use App\Filament\Resources\Jurusans\Pages\CreateJurusan;
use App\Filament\Resources\Jurusans\Pages\EditJurusan;
use App\Filament\Resources\Jurusans\Pages\ListJurusans;
use App\Filament\Resources\Jurusans\Schemas\JurusanForm;
use App\Filament\Resources\Jurusans\Tables\JurusansTable;
use App\Models\Jurusan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JurusanResource extends Resource
{
    protected static ?string $model = Jurusan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Jurusan Sekolah';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Website';

    protected static ?string $modelLabel = 'Jurusan Sekolah';

    protected static ?string $pluralModelLabel = 'Jurusan Sekolah';

    protected static ?int $navigationSort = 4;


    public static function form(Schema $schema): Schema
    {
        return JurusanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JurusansTable::configure($table);
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
            'index' => ListJurusans::route('/'),
            'create' => CreateJurusan::route('/create'),
            'edit' => EditJurusan::route('/{record}/edit'),
        ];
    }
}
