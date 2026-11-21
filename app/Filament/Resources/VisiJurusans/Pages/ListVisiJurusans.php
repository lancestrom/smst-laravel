<?php

namespace App\Filament\Resources\VisiJurusans\Pages;

use App\Exports\VisiJurusanTemplateExport;
use App\Filament\Resources\VisiJurusans\VisiJurusanResource;
use App\Imports\VisiJurusanImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ListVisiJurusans extends ListRecords
{
    protected static string $resource = VisiJurusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-document-arrow-down')
                ->color('info')
                ->action(function () {
                    return Excel::download(
                        new VisiJurusanTemplateExport,
                        'template_visi_jurusan.xlsx',
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
                            new VisiJurusanImport,
                            Storage::disk('local')->path($path),
                        );

                        FilamentNotification::make()
                            ->title('Import Berhasil')
                            ->body('Data visi jurusan berhasil diimport.')
                            ->success()
                            ->send();
                    } catch (Throwable $e) {
                        report($e);

                        FilamentNotification::make()
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
