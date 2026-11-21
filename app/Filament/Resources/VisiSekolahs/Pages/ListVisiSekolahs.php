<?php

namespace App\Filament\Resources\VisiSekolahs\Pages;

use App\Exports\VisiSekolahTemplateExport;
use App\Filament\Resources\VisiSekolahs\VisiSekolahResource;
use App\Imports\VisiSekolahImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListVisiSekolahs extends ListRecords
{
    protected static string $resource = VisiSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-document-arrow-down')
                ->color('info')
                ->action(function () {
                    return Excel::download(
                        new VisiSekolahTemplateExport,
                        'template_visi_sekolah.xlsx',
                    );
                }),
            Action::make('importExcel')
                ->label('Import Excel')
                ->icon('heroicon-o-document-arrow-up')
                ->color('success')
                ->schema([
                    FileUpload::make('file')
                        ->label('Upload File Excel')
                        ->disk('local')
                        ->directory('imports')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                            'text/csv',
                        ])
                        ->required()
                        ->helperText('Gunakan template Excel yang telah disediakan.'),
                ])
                ->action(function (array $data) {
                    $path = $data['file'];

                    try {
                        Excel::import(
                            new VisiSekolahImport,
                            Storage::disk('local')->path($path),
                        );

                        Notification::make()
                            ->title('Import Berhasil')
                            ->body('Data visi sekolah berhasil diimport.')
                            ->success()
                            ->send();
                    } catch (\Throwable $e) {
                        report($e);

                        Notification::make()
                            ->title('Import Gagal')
                            ->body('Periksa kembali format dan isi Excel.')
                            ->danger()
                            ->send();
                    } finally {
                        Storage::disk('local')->delete($path);
                    }
                }),
            CreateAction::make(),
        ];
    }
}
