<?php

namespace App\Filament\Pmii\Widgets;

use App\Models\Anggota;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AnggotaStatsWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    
    protected function getStats(): array
    {
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count();
        $alumni = Anggota::where('status', 'Alumni')->count();

        return [
            Stat::make('Total Anggota', $totalAnggota)
                ->description('Total seluruh anggota')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
                
            Stat::make('Anggota Aktif', $anggotaAktif)
                ->description('Status aktif')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
                
            Stat::make('Alumni', $alumni)
                ->description('Status alumni')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),
        ];
    }
}
