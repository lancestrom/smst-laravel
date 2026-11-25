<?php

namespace App\Filament\Resources\JurusanMisis;

use App\Filament\Resources\JurusanMisis\Pages\CreateJurusanMisi;
use App\Filament\Resources\JurusanMisis\Pages\EditJurusanMisi;
use App\Filament\Resources\JurusanMisis\Pages\ListJurusanMisis;
use App\Filament\Resources\JurusanMisis\Schemas\JurusanMisiForm;
use App\Filament\Resources\JurusanMisis\Tables\JurusanMisisTable;
use App\Models\JurusanMisi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JurusanMisiResource extends Resource
{
    protected static ?string $model = JurusanMisi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Jurusan Misi Sekolah';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Website Sekolah';

    protected static ?string $modelLabel = 'Jurusan Misi Sekolah';

    protected static ?string $pluralModelLabel = 'Jurusan Misi Sekolah';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return JurusanMisiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JurusanMisisTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJurusanMisis::route('/'),
            'create' => CreateJurusanMisi::route('/create'),
            'edit' => EditJurusanMisi::route('/{record}/edit'),
        ];
    }
}
