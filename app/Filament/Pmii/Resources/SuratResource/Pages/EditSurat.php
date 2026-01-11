<?php

namespace App\Filament\Pmii\Resources\SuratResource\Pages;

use App\Filament\Pmii\Resources\SuratResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSurat extends EditRecord
{
    protected static string $resource = SuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\Action::make('generatePdf')
                ->label('Generate PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->url(fn (): string => route('surat.pdf', $this->record))
                ->openUrlInNewTab(),
        ];
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
