<?php

namespace App\Filament\Imports;

use App\Models\ProfilSekolah;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ProfilSekolahImporter extends Importer
{
    protected static ?string $model = ProfilSekolah::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nama_sekolah')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('npsn')
                ->rules(['max:20']),
            ImportColumn::make('alamat'),
            ImportColumn::make('telepon')
                ->rules(['max:20']),
            ImportColumn::make('email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('nama_kepala_sekolah')
                ->rules(['max:255']),
            ImportColumn::make('deskripsi'),
            ImportColumn::make('logo')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ProfilSekolah
    {
        return new ProfilSekolah();
    }

    public function getJobConnection(): ?string
    {
        return 'sync';
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your profil sekolah import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
