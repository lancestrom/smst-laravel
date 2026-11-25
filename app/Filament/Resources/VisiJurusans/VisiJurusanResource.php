<?php

namespace App\Filament\Resources\VisiJurusans;

use App\Filament\Resources\VisiJurusans\Pages\CreateVisiJurusan;
use App\Filament\Resources\VisiJurusans\Pages\EditVisiJurusan;
use App\Filament\Resources\VisiJurusans\Pages\ListVisiJurusans;
use App\Filament\Resources\VisiJurusans\Schemas\VisiJurusanForm;
use App\Filament\Resources\VisiJurusans\Tables\VisiJurusansTable;
use App\Models\JurusanVisi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class VisiJurusanResource extends Resource
{
    protected static ?string $model = JurusanVisi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Jurusan Visi Sekolah';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Website Sekolah';

    protected static ?string $modelLabel = 'Jurusan Visi Sekolah';

    protected static ?string $pluralModelLabel = 'Jurusan Visi Sekolah';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return VisiJurusanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VisiJurusansTable::configure($table);
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
            'index' => ListVisiJurusans::route('/'),
            'create' => CreateVisiJurusan::route('/create'),
            'edit' => EditVisiJurusan::route('/{record}/edit'),
        ];
    }
}
