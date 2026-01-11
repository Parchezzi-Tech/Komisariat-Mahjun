<?php

namespace App\Filament\Pmii\Resources\SuratResource\Pages;

use App\Filament\Pmii\Resources\SuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSurats extends ListRecords
{
    protected static string $resource = SuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat Surat Baru')
                ->icon('heroicon-o-plus'),
        ];
    }
}
