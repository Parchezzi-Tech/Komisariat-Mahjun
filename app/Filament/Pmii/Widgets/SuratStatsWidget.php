<?php

namespace App\Filament\Pmii\Widgets;

use App\Models\Surat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SuratStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalSurat = Surat::count();
        $draft = Surat::where('status', 'Draft')->count();
        $final = Surat::where('status', 'Final')->count();
        $terkirim = Surat::where('status', 'Terkirim')->count();
        
        // Surat bulan ini
        $suratBulanIni = Surat::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return [
            Stat::make('Total Surat', $totalSurat)
                ->description('Total seluruh surat')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->chart([3, 7, 12, 15, 18, 22, $totalSurat]),
                
            Stat::make('Draft', $draft)
                ->description('Surat draft')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color('gray'),
                
            Stat::make('Final', $final)
                ->description('Surat final')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
                
            Stat::make('Terkirim', $terkirim)
                ->description('Surat terkirim')
                ->descriptionIcon('heroicon-m-paper-airplane')
                ->color('info'),
                
            Stat::make('Bulan Ini', $suratBulanIni)
                ->description('Surat bulan ini')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning')
                ->chart([0, 2, 4, 6, 8, 10, $suratBulanIni]),
        ];
    }
}
