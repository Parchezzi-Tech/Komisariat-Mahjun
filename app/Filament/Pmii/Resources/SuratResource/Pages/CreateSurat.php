<?php

namespace App\Filament\Pmii\Resources\SuratResource\Pages;

use App\Filament\Pmii\Resources\SuratResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateSurat extends CreateRecord
{
    protected static string $resource = SuratResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Auth::id();
        
        // Generate nomor surat
        $surat = new \App\Models\Surat();
        $surat->jenis_surat = $data['jenis_surat'];
        $data['nomor_surat'] = $surat->generateNomorSurat();
        
        return $data;
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
