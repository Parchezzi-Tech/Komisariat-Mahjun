<?php

namespace App\Filament\Widgets;

use App\Models\Anggota;
use Filament\Widgets\ChartWidget;

class AnggotaChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Anggota Per Angkatan';
    
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $angkatanData = Anggota::selectRaw('angkatan, count(*) as total')
            ->whereNotNull('angkatan')
            ->groupBy('angkatan')
            ->orderBy('angkatan')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Anggota',
                    'data' => $angkatanData->pluck('total')->toArray(),
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.5)',
                        'rgba(16, 185, 129, 0.5)',
                        'rgba(251, 191, 36, 0.5)',
                        'rgba(239, 68, 68, 0.5)',
                        'rgba(139, 92, 246, 0.5)',
                    ],
                    'borderColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(251, 191, 36)',
                        'rgb(239, 68, 68)',
                        'rgb(139, 92, 246)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $angkatanData->pluck('angkatan')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
