<?php

namespace App\Filament\Pmii\Resources\SuratResource\Pages;

use App\Filament\Pmii\Resources\SuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSurat extends ViewRecord
{
    protected static string $resource = SuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('generatePdf')
                ->label('Generate PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->url(fn (): string => route('surat.pdf', $this->record))
                ->openUrlInNewTab(),
        ];
    }
}
