<?php

namespace App\Filament\Widgets;

use App\Models\Anggota;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AnggotaStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count();
        $anggotaNonAktif = Anggota::where('status', 'Non-Aktif')->count();
        $alumni = Anggota::where('status', 'Alumni')->count();
        
        // Anggota baru bulan ini
        $anggotaBaru = Anggota::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Gender distribution
        $lakiLaki = Anggota::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = Anggota::where('jenis_kelamin', 'Perempuan')->count();

        return [
            Stat::make('Total Anggota', $totalAnggota)
                ->description('Total seluruh anggota')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([7, 12, 18, 22, 25, 28, $totalAnggota]),
                
            Stat::make('Anggota Aktif', $anggotaAktif)
                ->description('Status aktif')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([5, 10, 15, 18, 20, 22, $anggotaAktif]),
                
            Stat::make('Anggota Baru', $anggotaBaru)
                ->description('Anggota bulan ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning')
                ->chart([0, 1, 2, 3, 4, 5, $anggotaBaru]),
                
            Stat::make('Alumni', $alumni)
                ->description('Status alumni')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),
                
            Stat::make('Laki-laki', $lakiLaki)
                ->description('Anggota laki-laki')
                ->descriptionIcon('heroicon-m-user')
                ->color('primary'),
                
            Stat::make('Perempuan', $perempuan)
                ->description('Anggota perempuan')
                ->descriptionIcon('heroicon-m-user')
                ->color('pink'),
        ];
    }
}
