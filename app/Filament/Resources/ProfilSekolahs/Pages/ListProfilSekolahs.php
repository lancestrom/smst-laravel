<?php

namespace App\Filament\Resources\ProfilSekolahs\Pages;

use App\Exports\ProfilSekolahTemplateExport;
use App\Filament\Resources\ProfilSekolahs\ProfilSekolahResource;
use App\Imports\ProfilSekolahImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Notification;
class ListProfilSekolahs extends ListRecords
{
    protected static string $resource = ProfilSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-document-arrow-down')
                ->color('info')
                ->action(function () {
                    return Excel::download(
                        new ProfilSekolahTemplateExport,
                        'template_profil_sekolah.xlsx',
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
                            new ProfilSekolahImport,
                            Storage::disk('local')->path($path),
                        );

                        \Filament\Notifications\Notification::make()
                            ->title('Import Berhasil')
                            ->body('Data profil sekolah berhasil diimport.')
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
