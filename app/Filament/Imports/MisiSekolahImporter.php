<?php

namespace App\Filament\Imports;

use App\Models\MisiSekolah;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class MisiSekolahImporter extends Importer
{
    protected static ?string $model = MisiSekolah::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('isi')
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): MisiSekolah
    {
        return MisiSekolah::firstOrNew([
            'slug_misi_sekolah' => $this->data['slug_misi_sekolah'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your misi sekolah import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
