<?php

namespace App\Filament\Pmii\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $view = 'filament.pmii.pages.dashboard';
    
    public function getWidgets(): array
    {
        return [
            \App\Filament\Pmii\Widgets\SuratStatsWidget::class,
            \App\Filament\Pmii\Widgets\AnggotaStatsWidget::class,
        ];
    }
    
    public function getTitle(): string
    {
        return 'Portal PMII Komisariat Mahbub Djunaidi';
    }
    
    public function getHeading(): string
    {
        return 'Portal PMII Komisariat Mahbub Djunaidi';
    }
    
    public function getSubheading(): ?string
    {
        return 'Sistem Administrasi & Generator Surat';
    }
}
