<?php

namespace App\Filament\Pages;

use App\Models\Anggota;
use App\Models\User;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $view = 'filament.pages.dashboard';
    
    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\AnggotaStatsWidget::class,
            \App\Filament\Widgets\AnggotaChartWidget::class,
        ];
    }
    
    public function getTitle(): string
    {
        return 'Dashboard Admin PMII';
    }
    
    public function getHeading(): string
    {
        return 'Dashboard Admin PMII';
    }
    
    public function getSubheading(): ?string
    {
        return 'Sistem Manajemen Data Anggota & Administrasi';
    }
}
