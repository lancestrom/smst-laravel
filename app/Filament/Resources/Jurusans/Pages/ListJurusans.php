<?php

namespace App\Filament\Resources\Jurusans\Pages;

use App\Exports\JurusanTemplateExport;
use App\Filament\Resources\Jurusans\JurusanResource;
use App\Imports\JurusanImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Notification;
class ListJurusans extends ListRecords
{
    protected static string $resource = JurusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-document-arrow-down')
                ->color('info')
                ->action(function () {
                    return Excel::download(
                        new JurusanTemplateExport,
                        'template_jurusan.xlsx',
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
                            new JurusanImport,
                            Storage::disk('local')->path($path),
                        );

                        \Filament\Notifications\Notification::make()
                            ->title('Import Berhasil')
                            ->body('Data jurusan berhasil diimport.')
                            ->success()
                            ->send();
                    } catch (\Throwable $e) {
                        report($e);

                        \Filament\Notifications\Notification::make()
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
